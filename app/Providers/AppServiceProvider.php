<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Order;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        view()->share([
            'orderAllCount' => Order::all()->count(),
            'orderPendingCount' => Order::where('status', 'pending')->count(),
            'orderShippedCount' =>  Order::where('status', 'shipped')->count(),
            'orderDeliveredCount' => Order::where('status', 'delivered')->count(),
            'orderCanceledCount' => Order::where('status', 'cancelled')->count(),
        ]);
    }
}
