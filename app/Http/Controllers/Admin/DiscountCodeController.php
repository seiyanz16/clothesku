<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class DiscountCodeController extends Controller
{
    public function index(Request $request)
    {
        $discountCoupons = DiscountCoupon::latest();

        if (!empty($request->get('keyword'))) {
            $discountCoupons = $discountCoupons->where('name', 'like', '%' . $request->get('keyword') . '%');
            $discountCoupons = $discountCoupons->orWhere('code', 'like', '%' . $request->get('keyword') . '%');
        }
        $discountCoupons = $discountCoupons->paginate(10);
        return view('admin.coupon.index', compact('discountCoupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:discount_coupons',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            // starting date must be greator than current date

            if (!empty($request->start)) {
                $now = Carbon::now();

                $start = Carbon::createFromFormat('Y-m-d H:i:s', $request->start);

                if ($start->lte($now) == true) {
                    return response()->json([
                        'status' => false,
                        'errors' => ['start' => 'Start date can not be less than current date time.']
                    ]);
                }
            }

            // expired date must be greator than start date
            if (!empty($request->start) && !empty($request->end)) {
                $end = Carbon::createFromFormat('Y-m-d H:i:s', $request->end);
                $start = Carbon::createFromFormat('Y-m-d H:i:s', $request->start);

                if ($end->gt($start) == false) {
                    return response()->json([
                        'status' => false,
                        'errors' => ['end' => 'End date must be greater than start date.']
                    ]);
                }
            }

            $discountCode = new DiscountCoupon();
            $discountCode->code = $request->code;
            $discountCode->name = $request->name;
            $discountCode->max_uses = $request->max_uses;
            $discountCode->max_user = $request->max_user;
            $discountCode->type = $request->type;
            $discountCode->discount_amount = $request->discount_amount;
            $discountCode->min_amount = $request->min_amount;
            $discountCode->status = $request->status;
            $discountCode->start = $request->start;
            $discountCode->end = $request->end;
            $discountCode->save();

            $message = "Discount Coupon added successfully.";

            session()->flash('success', $message);

            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(Request $request, string $id)
    {
        $discountCode = DiscountCoupon::find($id);
        if ($discountCode == null) {
            session()->flash('error', 'Record not found.');
            return redirect()->route('coupon.index');
        }
        $data['discountCode'] = $discountCode;
        return view('admin.coupon.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $discountCode = DiscountCoupon::find($id);

        if ($discountCode == null) {
            session()->flash('error', "Record not found.");
            return response()->json([
                'status' => true,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:discount_coupons,code,' . $discountCode->id . ',id',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            // expired date must be greator than start date
            if (!empty($request->start) && !empty($request->end)) {
                $end = Carbon::createFromFormat('Y-m-d H:i:s', $request->end);
                $start = Carbon::createFromFormat('Y-m-d H:i:s', $request->start);

                if ($end->gt($start) == false) {
                    return response()->json([
                        'status' => false,
                        'errors' => ['end' => 'End date must be greater than start date.']
                    ]);
                }
            }

            $discountCode->code = $request->code;
            $discountCode->name = $request->name;
            $discountCode->max_uses = $request->max_uses;
            $discountCode->max_user = $request->max_user;
            $discountCode->type = $request->type;
            $discountCode->discount_amount = $request->discount_amount;
            $discountCode->min_amount = $request->min_amount;
            $discountCode->status = $request->status;
            $discountCode->start = $request->start;
            $discountCode->end = $request->end;
            $discountCode->save();

            $message = "Discount Coupon updated successfully.";

            session()->flash('success', $message);

            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy(string $id)
    {
        $discountCode = DiscountCoupon::find($id);

        if ($discountCode == null) {
            session()->flash('error', "Record not found.");
            return response()->json([
                'status' => true,
            ]);
        }

        $discountCode->delete();

        session()->flash('success', "Discount deleted successfully.");
        return response()->json([
            'status' => true,
        ]);
    }


}
