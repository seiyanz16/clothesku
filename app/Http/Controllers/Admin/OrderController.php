<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExcelExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index(Request $request, $status = null)
    {
        $orders = Order::latest('orders.created_at')->select('orders.*', 'users.name', 'users.email');
        $orders = $orders->leftJoin('users', 'users.id', 'orders.user_id');

        if ($request->get('keyword') != '') {
            $orders = $orders->where('users.name', 'like', '%' . $request->keyword . '%');
            $orders = $orders->orWhere('users.email', 'like', '%' . $request->keyword . '%');
            $orders = $orders->orWhere('orders.id', 'like', '%' . $request->keyword . '%');
        }

        if (!empty($status)) {
            $orders = $orders->where('orders.status', $status);
        }

        $orders = $orders->with('items')->paginate(10);

        return view('admin.orders.index', [
            'orders' => $orders
        ]);
    }

    public function detail(string $orderId)
    {
        $order = Order::select('orders.*', 'countries.name as countryName')
            ->where('orders.id', $orderId)
            ->leftJoin('countries', 'countries.id', 'orders.country_id')
            ->first();

        $orderItems = OrderItem::where('order_id', $orderId)->get();

        return view('admin.orders.detail', [
            'order' => $order,
            'orderItems' => $orderItems,
        ]);
    }

    public function changeOrderStatus(Request $request, string $id)
    {
        $order = Order::find($id);
        $order->status = $request->status;
        $order->shipped_date = $request->shipped_date;
        $order->payment_status = $request->payment_status;
        $order->save();

        $message = 'Order status updated successfully.';

        session()->flash('success', $message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    // public function sendInvoiceEmail(Request $request, string $id)
    // {
    //     orderEmail($id, $request->userType);

    //     $message = 'Order email sent successfully.';

    //     session()->flash('success', $message);

    //     return response()->json([
    //         'status' => true,
    //         'message' => $message
    //     ]);
    // }

    // public function exportExcel()
    // {
    //     return Excel::download(new OrdersExcelExport, 'OrdersData.xlsx');
    // }
}
