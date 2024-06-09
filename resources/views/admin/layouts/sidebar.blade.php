<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dasboard') }}"
                        class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">REPORTS</li>
                <li class="nav-item {{ request()->is('admin/report*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ request()->is('admin/report*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-file"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        style="{{ request()->is('admin/report/users*') || request()->is('admin/report/orders*') || request()->is('admin/report/countries*') || request()->is('admin/report/revenue*') || request()->is('admin/report/products*') ? 'display: block;' : 'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{ route('users.charts') }}"
                                class="nav-link {{ request()->is('admin/report/users*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Registered Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.charts') }}"
                                class="nav-link {{ request()->is('admin/report/orders*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('countries.charts') }}"
                                class="nav-link {{ request()->is('admin/report/countries*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Registered Countries</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('revenue.charts') }}"
                                class="nav-link {{ request()->is('admin/report/revenue*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Revenue</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.charts') }}"
                                class="nav-link {{ request()->is('admin/report/products*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product Best Seller</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">ORDER SETTINGS</li>
                <li class="nav-item {{ request()->is('admin/orders*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="{{ route('orders.index') }}"
                        class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Orders
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        style="{{ request()->is('admin/orders*') ? 'display: block;' : 'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}"
                                class="nav-link {{ request()->is('admin/orders') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All
                                    <span class="badge bg-secondary ml-2">{{ $orderAllCount }}</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.index', ['status' => 'pending']) }}"
                                class="nav-link {{ request()->is('admin/orders/pending') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-warning"></i>
                                <p>Pending
                                    <span class="badge bg-secondary ml-2">{{ $orderPendingCount }}</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.index', ['status' => 'shipped']) }}"
                                class="nav-link {{ request()->is('admin/orders/shipped') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Shipped
                                    <span class="badge bg-secondary ml-2">{{ $orderShippedCount }}</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.index', ['status' => 'delivered']) }}"
                                class="nav-link {{ request()->is('admin/orders/delivered') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-success"></i>
                                <p>Delivered
                                    <span class="badge bg-secondary ml-2">{{ $orderDeliveredCount }}</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.index', ['status' => 'cancelled']) }}"
                                class="nav-link {{ request()->is('admin/orders/cancelled') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon text-danger"></i>
                                <p>Canceled
                                    <span class="badge bg-secondary ml-2">{{ $orderCanceledCount }}</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (Auth::guard('admin')->user()->role == 1)
                    <li class="nav-header">PRODUCT SETTINGS</li>
                    <li
                        class="nav-item {{ request()->is('admin/categories*') || request()->is('admin/sub-categories*') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('admin/categories*') || request()->is('admin/sub-categories*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p>
                                Category
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview"
                            style="{{ request()->is('admin/categories*') || request()->is('admin/sub-categories*') ? 'display: block;' : 'display: none;' }}">
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}"
                                    class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sub-categories.index') }}"
                                    class="nav-link {{ request()->is('admin/sub-categories*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sub Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('brands.index') }}"
                            class="nav-link {{ request()->is('admin/brands*') ? 'active' : '' }}">
                            <svg class="h-6 nav-icon w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p>Brands</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}"
                            class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tag"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li class="nav-header">ADDITIONAL COST</li>

                    <li class="nav-item">
                        <a href="{{ route('shipping.create') }}"
                            class="nav-link {{ request()->is('admin/shipping*') ? 'active' : '' }}">
                            <!-- <i class="nav-icon fas fa-tag"></i> -->
                            <i class="fas fa-truck nav-icon"></i>
                            <p>Shipping</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('coupons.index') }}"
                            class="nav-link {{ request()->is('admin/coupons*') ? 'active' : '' }}">
                            <i class="nav-icon  fa fa-percent" aria-hidden="true"></i>
                            <p>Discount</p>
                        </a>
                    </li>
                    <li class="nav-header">USER SETTINGS</li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                            <i class="nav-icon  fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-header">PAGE SETTINGS</li>
                    <li class="nav-item">
                        <a href="{{ route('pages.index') }}"
                            class="nav-link {{ request()->is('admin/pages*') ? 'active' : '' }}">
                            <i class="nav-icon  far fa-file-alt"></i>
                            <p>Pages</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
