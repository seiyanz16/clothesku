<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CustomerAddress;
use App\Models\Country;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingCharge;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::with('product_images')->find($request->id);

        if ($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found.'
            ]);
        }

        if (Cart::count() > 0) {
            // echo "product already in!";
            // product found in cart
            // check if this product already in the cart
            // return as message that product already in 
            // if product not found, then add product in cart

            $cartContent = Cart::content();
            $productAlreadyExist = false;

            foreach ($cartContent as $item) {
                if ($item->id == $product->id) {
                    $productAlreadyExist = true;
                }
            }

            if ($productAlreadyExist == false) {
                Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '',
                    'size' => $request->size,
                    'color' => $request->color]);

                $status = true;
                $message = '<strong>' . $product->title . '</strong> added to cart successfully.';
                session()->flash('success', $message);
            } else {
                $status = false;
                $message = $product->title . ' already added in cart';
            }

        } else {
            Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '',
                'size' => $request->size,
                'color' => $request->color,]);
            $status = true;
            $message = '<strong>' . $product->title . '</strong> added to cart successfully.';
            session()->flash('success', $message);

        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);

    }

    public function cart()
    {
        $cartContent = Cart::content();
        // dd($cartContent);
        $data['cartContent'] = $cartContent;
        return view('front.cart', $data);
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);
        $product = Product::find($itemInfo->id);

        //check qty available in stock
        if ($product->track_qty == 'yes') {
            if ($qty <= $product->qty) {
                Cart::update($rowId, $qty);
                $message = 'Cart updated successfully.';
                $status = true;
                session()->flash('success', $message);

            } else {
                $message = 'Request qty(' . $qty . ') not available in stock.';
                $status = false;
                session()->flash('error', $message);

            }
        } else {
            Cart::update($rowId, $qty);
            $message = 'Cart updated successfully.';
            $status = true;
            session()->flash('success', $message);

        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function deleteItem(Request $request)
    {

        $itemInfo = Cart::get($request->rowId);

        if ($itemInfo == null) {
            $errorMessage = 'Item not found.';
            session()->flash('error', $errorMessage);
            return response()->json([
                'status' => false,
                'message' => $errorMessage
            ]);
        }

        Cart::remove($request->rowId);

        $message = 'Item removed successfully.';
        session()->flash('success', $message);
        return response()->json([
            'status' => false,
            'message' => $message
        ]);
    }

    public function checkout()
    {
        $discount = 0;
        // kalo cart kosong redirect ke cart page 
        if (Cart::count() == 0) {
            return redirect()->route('front.cart');
        }

        // kalo user gak login redirect ke login page
        if (Auth::check() == false) {

            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }
            return redirect()->route('account.login');
        }

        $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();

        session()->forget('url.intended');

        $countries = Country::orderBy('name', 'ASC')->get();

        $subTotal = Cart::subtotal(2, '.', '');

        // itung diskon

        if (session()->has('code')) {
            $code = session()->get('code');
            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subTotal;
            } else {
                $discount = $code->discount_amount;
            }
        }

        // itung ongkir 
        if ($customerAddress != '') {
            $userCountry = $customerAddress->country_id;
            $shippingInfo = ShippingCharge::where('country_id', $userCountry)->first();

            $totalQty = 0;
            $totalShippingCharge = 0;
            $grandTotal = 0;
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }

            $totalShippingCharge = $totalQty * $shippingInfo->amount;

            $grandTotal = ($subTotal - $discount) + $totalShippingCharge;
        } else {
            $grandTotal = $subTotal - $discount;
            $totalShippingCharge = 0;
        }

        return view('front.checkout', [
            'countries' => $countries,
            'customerAddress' => $customerAddress,
            'totalShippingCharge' => $totalShippingCharge,
            'discount' => $discount,
            'grandTotal' => $grandTotal
        ]);
    }

    public function processCheckout(Request $request)
    {
        // step - 1 validasi

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'address' => 'required|max:255',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please fix the errors',
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // step - 2 simpen alamat
        $user = Auth::user();
        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country_id' => $request->country,
                'address' => $request->address,
                'apartement' => $request->apartement,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
            ],
        );

        // step - 3 store data di table orders

        if ($request->payment_method == 'cod') {

            $couponCodeId = null;
            $code = null;
            $shipping = 0;
            $discount = 0;
            $subTotal = Cart::subtotal(2, '.', '');


            // apply discount here

            if (session()->has('code')) {
                $code = session()->get('code');
                if ($code->type == 'percent') {
                    $discount = ($code->discount_amount / 100) * $subTotal;
                } else {
                    $discount = $code->discount_amount;
                }

                $couponCodeId = $code->id;
                $code = $code->code;
            }

            //itung ongkir
            $shippingInfo = ShippingCharge::where('country_id', $request->country)->first();
            $totalQty = 0;
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }

            if ($shippingInfo != null) {
                $shipping = $totalQty * $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $shipping;

            } else {
                $shippingInfo = ShippingCharge::where('country_id', 'rest_of_world')->first();

                $shipping = $totalQty * $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $shipping;
            }

            $order = new Order;
            $order->subtotal = $subTotal;
            $order->shipping = $shipping;
            $order->grand_total = $grandTotal;
            $order->discount = $discount;
            $order->coupon_code_id = $couponCodeId;
            $order->coupon_code = $code;
            $order->payment_status = 'not paid';
            $order->status = 'pending';

            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->user_id = $user->id;
            $order->mobile = $request->mobile;
            $order->country_id = $request->country;
            $order->address = $request->address;
            $order->apartement = $request->apartement;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->zip = $request->zip;
            $order->notes = $request->order_notes;
            $order->save();

            //step -4 store order items

            foreach (Cart::content() as $item) {

                $orderItem = new OrderItem;
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->size = $item->options->size;
                $orderItem->color = $item->options->color;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->qty * $item->price;
                $orderItem->save();

                // update stok produk

                $productData = Product::find($item->id);
                if($productData->track_qty == 'yes'){
                    $currentQty = $productData->qty;
                    $updatedQty = $currentQty - $item->qty;
                    $productData->qty = $updatedQty;
                    $productData->save();
                }
            }
            
            // send email
            // OrderEmail($order->id);

            session()->flash('success', 'Ordered Successfully.');

            Cart::destroy();

            session()->forget('code');

            return response()->json([
                'message' => 'Order saved successfully.',
                'orderId' => $order->id,
                'status' => true,
            ]);


        } else {

        }
    }

    public function thankYou($id)
    {
        return view('front.thanks', [
            'id' => $id
        ]);
    }

    public function getOrderSummary(Request $request)
    {
        $subTotal = Cart::subtotal(2, '.', '');
        $discount = 0;
        $discountString = '';

        // apply discount here

        if (session()->has('code')) {
            $code = session()->get('code');
            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subTotal;
            } else {
                $discount = $code->discount_amount;
            }

            $discountString = '<div class="mt-4" id="discount-row">
                                <strong>' . session()->get('code')->code . '</strong>
                                <a class="btn btn-sm btn-danger" id="removeDiscount"><i class="fa fa-times"></i></a>
                            </div>';
        }

        if ($request->country_id > 0) {

            $shippingInfo = ShippingCharge::where('country_id', $request->country_id)->first();

            $totalQty = 0;
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }

            if ($shippingInfo != null) {
                $shippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal, 2),
                    'discount' => number_format($discount,2),
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($shippingCharge, 2)
                ]);
            } else {
                $shippingInfo = ShippingCharge::where('country_id', 'rest_of_world')->first();

                $shippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal, 2),
                    'discount' => number_format($discount,2),
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($shippingCharge, 2)
                ]);
            }
        } else {
            return response()->json([
                'status' => true,
                'grandTotal' => number_format(($subTotal - $discount), 2),
                'discount' => number_format($discount,2),
                'discountString' => $discountString,
                'shippingCharge' => number_format(0, 2)
            ]);
        }
    }

    public function applyDiscount(Request $request)
    {
        // dd($request->code);
        $code = DiscountCoupon::where('code', $request->code)->first();

        if ($code == null) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or Expired Discount Code.'
            ]);
        }

        // check if coupon start date is valid or not

        $now = Carbon::now();

        // echo $now->format('Y-m-d H:i:s');

        if ($code->start != "") {
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $code->start);

            if ($now->lt($startDate)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid or Expired Discount Code.'
                ]);
            }
        }

        if ($code->end != "") {
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $code->end);

            if ($now->gt($endDate)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid or Expired Discount Code.'
                ]);
            }
        }

        // cek maksimal pakai
        if ($code->max_uses > 0) {

            $couponUsed = Order::where('coupon_code_id', $code->id)->count();

            if ($couponUsed >= $code->max_uses) {
                return response()->json([
                    'status' => false,
                    'message' => 'Coupon has exceeded the maximum used limit.'
                ]);
            }
        }

        // cek maksimal pakai user

        if ($code->max_user > 0) {
            $couponUsedByUser = Order::where(['coupon_code_id' => $code->id, 'user_id' => Auth::user()->id])->count();

            if ($couponUsedByUser >= $code->max_user) {
                return response()->json([
                    'status' => false,
                    'message' => 'You already used this coupon.'
                ]);
            }
        }

        $subTotal = Cart::subtotal(2, '.', '');
        // cek kondisi minimal belanja
        if ($code->min_amount > 0) {
            if ($subTotal < $code->min_amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'Your min amount must be $'. $code->min_amount . '.',
                ]);
            }
        }

        session()->put('code', $code);

        return $this->getOrderSummary($request);
    }

    public function removeDiscount(Request $request)
    {
        session()->forget('code');

        return $this->getOrderSummary($request);

    }
}
