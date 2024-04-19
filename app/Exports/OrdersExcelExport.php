<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExcelExport implements FromView, ShouldAutoSize
{
    use Exportable;
    private $orders;
    public function __construct() {
        $this->orders = Order::latest('orders.created_at')
            ->select('orders.*', 'users.name', 'users.email')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->with('items')
            ->paginate(10);
    }

    public function view() : View
    {
        return view('admin.orders.index',[
            'orders' => $this->orders
        ]);
    }
}
