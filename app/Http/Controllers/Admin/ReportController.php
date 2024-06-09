<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\CustomerAddress;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function viewUsersChart()
    {
        $current_month_user = User::where('role', '!=', 1)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $before_1_month_user = User::where('role', '!=', 1)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $before_2_month_user = User::where('role', '!=', 1)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        $before_3_month_user = User::where('role', '!=', 1)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(3))->count();

        $usersCount = array($current_month_user, $before_1_month_user, $before_2_month_user, $before_3_month_user);

        return view('admin.report.user-chart', compact('usersCount'));
    }

    public function fetchDataUser(Request $request)
    {
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        $usersCount = [];

        while ($start->lte($end)) {
            $usersCount[] = [
                'y' => User::where('role', '!=', 1)->whereDate('created_at', $start)->count(),
                'label' => $start->format('M d, Y')
            ];
            $start->addDay();
        }

        return response()->json($usersCount);
    }
    public function viewOrdersChart()
    {
        $current_month_order = Order::where('status', '!=', 'cancelled')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $before_1_month_order = Order::where('status', '!=', 'cancelled')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $before_2_month_order = Order::where('status', '!=', 'cancelled')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        $before_3_month_order = Order::where('status', '!=', 'cancelled')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(3))->count();

        $ordersCount = array($current_month_order, $before_1_month_order, $before_2_month_order, $before_3_month_order);
        return view('admin.report.order-chart', compact('ordersCount'));
    }

    public function fetchDataOrder(Request $request)
    {
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        $ordersCount = [];

        while ($start->lte($end)) {
            $ordersCount[] = [
                'y' => Order::where('status', '!=', 'cancelled')->whereDate('created_at', $start)->count(),
                'label' => $start->format('M d, Y')
            ];
            $start->addDay();
        }

        return response()->json($ordersCount);
    }

    public function viewCountriesChart()
    {
        $getCountry = CustomerAddress::select('countries.name as country', DB::raw('count(customer_addresses.id) as count'))->leftJoin('countries', 'countries.id', 'customer_addresses.country_id')->groupBy('customer_addresses.country_id', 'countries.name')->get()->toArray();
        // dd($getCountry);

        return view('admin.report.country-chart')->with(compact('getCountry'));
    }

    public function fetchDataCountry(Request $request)
    {
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end)->endOfDay();

        $getCountry = CustomerAddress::select('countries.name as country', DB::raw('count(customer_addresses.id) as count'))
            ->leftJoin('countries', 'countries.id', 'customer_addresses.country_id')
            ->whereBetween('customer_addresses.created_at', [$start, $end])
            ->groupBy('customer_addresses.country_id', 'countries.name')
            ->get()
            ->toArray();

        $dataPoints = [];
        foreach ($getCountry as $key => $val) {
            $dataPoints[$key]['label'] = $val['country'];
            $dataPoints[$key]['y'] = $val['count'];
        }

        return response()->json(['dataPoints' => $dataPoints]);
    }

    public function viewRevenueChart()
    {
        $current_month_revenue = Order::where('status', '!=', 'cancelled')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('grand_total');
        $before_1_month_revenue = Order::where('status', '!=', 'cancelled')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->sum('grand_total');
        $before_2_month_revenue = Order::where('status', '!=', 'cancelled')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->sum('grand_total');
        $before_3_month_revenue = Order::where('status', '!=', 'cancelled')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(3))->sum('grand_total');

        $revenueSum = array($current_month_revenue, $before_1_month_revenue, $before_2_month_revenue, $before_3_month_revenue);

        // dd($revenueSum);
        return view('admin.report.revenue-chart')->with(compact('revenueSum'));
    }

    public function fetchDataRevenue(Request $request)
    {
        $start = Carbon::parse($request->start)->startOfMonth();
        $end = Carbon::parse($request->end)->endOfMonth();

        $revenueSum = [];

        while ($start->lte($end)) {
            $monthlyRevenue = Order::where('status', '!=', 'cancelled')
                ->whereYear('created_at', $start->year)
                ->whereMonth('created_at', $start->month)
                ->sum('grand_total');

            $revenueSum[] = [
                'y' => $monthlyRevenue,
                'label' => $start->format('M Y')
            ];

            $start->addMonth();
        }

        return response()->json($revenueSum);
    }

    public function viewProductsChart()
    {

        $start = Carbon::now()->subDays(30)->startOfDay();
        $end = Carbon::now()->endOfDay();

        $bestSellingProducts = DB::table('order_items')
            ->select('name', DB::raw('SUM(qty) as total_qty'), DB::raw('SUM(total) as total_price'))
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('name')
            ->orderBy('total_qty', 'desc')
            ->get();

        return view('admin.report.product-chart', compact('bestSellingProducts'));
    }

    public function fetchDataProduct(Request $request)
    {
        $start = Carbon::parse($request->start)->startOfDay();
        $end = Carbon::parse($request->end)->endOfDay();

        $bestSellingProducts = DB::table('order_items')
            ->select('name', DB::raw('SUM(qty) as total_qty'), DB::raw('SUM(total) as total_price'))
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('name')
            ->orderBy('total_qty', 'desc')
            ->get();

        return response()->json($bestSellingProducts);
    }
}
