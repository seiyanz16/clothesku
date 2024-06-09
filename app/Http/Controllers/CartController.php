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
    private $user;
    private $cartInstance;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if ($this->user) {
                $this->cartInstance = Cart::instance('cart_' . $this->user->id);
            }
            return $next($request);
        });
    }
    public function addToCart(Request $request)
    {
        $product = Product::with('product_images')->find($request->id);

        if ($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found.'
            ]);
        }

        if ($this->cartInstance->count() > 0) {

            $cartContent = $this->cartInstance->content();
            $productAlreadyExist = false;

            foreach ($cartContent as $item) {
                if ($item->id == $product->id) {
                    if ($item->options->size == $request->size && $item->options->color == $request->color) {
                        $productAlreadyExist = true;
                        break;
                    }
                }
            }

            if ($productAlreadyExist == false) {
                $this->cartInstance->add($product->id, $product->title, 1, $product->price, [
                    'user_id' => $this->user->id,
                    'productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '',
                    'size' => $request->size,
                    'color' => $request->color,
                ]);
                $status = true;
                $message = '<strong>' . $product->title . '</strong> added to cart successfully.';
                session()->flash('success', $message);
            } else {
                $status = false;
                $message = $product->title . ' already added in cart';
            }

        } else {
            $this->cartInstance->add($product->id, $product->title, 1, $product->price, [
                'user_id' => $this->user->id,
                'productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '',
                'size' => $request->size,
                'color' => $request->color
            ]);
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
        $cartContent = $this->cartInstance->content();
        $cartSubtotal = $this->cartInstance->subtotal();
        $data['cartContent'] = $cartContent;
        $data['cartSubtotal'] = $cartSubtotal;

        return view('front.cart', $data);
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = $this->cartInstance->get($rowId);
        $product = Product::find($itemInfo->id);

        //check qty available in stock`
        if ($product->track_qty == 'yes') {
            if ($qty <= $product->qty) {
                $this->cartInstance->update($rowId, $qty);
                $message = 'Cart updated successfully.';
                $status = true;
                session()->flash('success', $message);

            } else {
                $message = 'Request qty(' . $qty . ') not available in stock.';
                $status = false;
                session()->flash('error', $message);

            }
        } else {
            $this->cartInstance->update($rowId, $qty);
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
        $itemInfo = $this->cartInstance->get($request->rowId);

        if ($itemInfo == null) {
            $errorMessage = 'Item not found.';
            session()->flash('error', $errorMessage);
            return response()->json([
                'status' => false,
                'message' => $errorMessage
            ]);
        }

        $this->cartInstance->remove($request->rowId);

        $message = 'Item removed successfully.';
        session()->flash('success', $message);
        return response()->json([
            'status' => false,
            'message' => $message
        ]);
    }

    public function checkout()
    {
        $cartItems = $this->cartInstance->content();
        $discount = 0;
        // kalo cart kosong redirect ke cart page 
        if ($this->cartInstance->count() == 0) {
            return redirect()->route('front.cart');
        }

        $customerAddress = CustomerAddress::where('user_id', $this->user->id)->first();

        $countries = Country::orderBy('name', 'ASC')->get();

        $subTotal = $this->cartInstance->subtotal(2, '.', '');

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
            foreach ($this->cartInstance->content() as $item) {
                $totalQty += $item->qty;
            }

            $totalShippingCharge = $shippingInfo->amount;

            $grandTotal = ($subTotal - $discount) + $totalShippingCharge;
        } else {
            $grandTotal = $subTotal - $discount;
            $totalShippingCharge = 0;
        }

        return view('front.checkout', [
            'countries' => $countries,
            'customerAddress' => $customerAddress,
            'cartItems' => $cartItems,
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
        CustomerAddress::updateOrCreate(
            ['user_id' => $this->user->id],
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

        // if ($request->payment_method == 'cod') {

        $couponCodeId = null;
        $code = null;
        $shipping = 0;
        $discount = 0;
        $subTotal = $this->cartInstance->subtotal(2, '.', '');


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
        foreach ($this->cartInstance->content() as $item) {
            $totalQty += $item->qty;
        }

        if ($shippingInfo != null) {
            $shipping = $shippingInfo->amount;
            $grandTotal = ($subTotal - $discount) + $shipping;

        } else {
            $shippingInfo = ShippingCharge::where('country_id', 'rest_of_world')->first();

            $shipping = $totalQty * $shippingInfo->amount;
            $grandTotal = ($subTotal - $discount) + $shipping;
        }

        $lastOrder = Order::latest()->first();
        $LastOrderNo = $lastOrder ? intval(substr($lastOrder->order_no, 5)) : 0;
        $nextOrder = $LastOrderNo + 1;
        $formatOrder = '#ORD-' . str_pad($nextOrder, 5, 0, STR_PAD_LEFT);

        $order = new Order;
        $order->order_no = $formatOrder;
        $order->subtotal = $subTotal;
        $order->shipping = $shipping;
        $order->grand_total = $grandTotal;
        $order->discount = $discount;
        $order->coupon_code_id = $couponCodeId;
        $order->coupon_code = $code;
        $order->payment_status = 'not_paid';
        $order->payment_method = $request->payment_method;
        if ($request->payment_method == 'transfer') {
            $order->payment_status = 'paid';
            $order->card_number = $request->card_number;
        }
        $order->status = 'pending';

        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->user_id = $this->user->id;
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

        foreach ($this->cartInstance->content() as $item) {

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
            if ($productData->track_qty == 'yes') {
                $currentQty = $productData->qty;
                $updatedQty = $currentQty - $item->qty;
                $productData->qty = $updatedQty;
                $productData->save();
            }
        }

        // send email
        // OrderEmail($order->id);

        session()->flash('success', 'Ordered Successfully.');

        $this->cartInstance->destroy();

        session()->forget('code');

        return response()->json([
            'message' => 'Order saved successfully.',
            'orderId' => $order->id,
            'status' => true,
        ]);


        // } else {

        // }
    }

    public function getOrderSummary(Request $request)
    {
        $subTotal = $this->cartInstance->subtotal(2, '.', '');
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
            foreach ($this->cartInstance->content() as $item) {
                $totalQty += $item->qty;
            }

            if ($shippingInfo != null) {
                $shippingCharge = $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal, 2),
                    'discount' => number_format($discount, 2),
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
                    'discount' => number_format($discount, 2),
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($shippingCharge, 2)
                ]);
            }
        } else {
            return response()->json([
                'status' => true,
                'grandTotal' => number_format(($subTotal - $discount), 2),
                'discount' => number_format($discount, 2),
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

        $subTotal = $this->cartInstance->subtotal(2, '.', '');
        // cek kondisi minimal belanja
        if ($code->min_amount > 0) {
            if ($subTotal < $code->min_amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'Your min amount must be $' . $code->min_amount . '.',
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

    public function thankYou($id)
    {
        $order = Order::where('id', $id)->first();

        return view('front.thanks', [
            'id' => $id,
            'orderNo' => $order->order_no,
        ]);
    }
}
