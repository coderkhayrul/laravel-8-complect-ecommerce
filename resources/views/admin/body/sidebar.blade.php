@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('admin.dashboard') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend') }}/images/logo-dark.png" alt="">
                        <h3><b>Easy</b> Cpanel</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ ($route == 'admin.dashboard') ? 'active' : '' }}">

                <a href="{{ route('admin.dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>

            </li>

            @php
                $brand = (auth()->guard('admin')->user()->brand == 1);
                $category = (auth()->guard('admin')->user()->category == 1);
                $product = (auth()->guard('admin')->user()->product == 1);
                $slider = (auth()->guard('admin')->user()->slider == 1);
                $coupon = (auth()->guard('admin')->user()->coupon == 1);
                $shipping = (auth()->guard('admin')->user()->shipping == 1);
                $blog = (auth()->guard('admin')->user()->blog == 1);
                $setting = (auth()->guard('admin')->user()->setting == 1);
                $returnorder = (auth()->guard('admin')->user()->returnorder == 1);
                $review = (auth()->guard('admin')->user()->review == 1);
                $orders = (auth()->guard('admin')->user()->orders == 1);
                $stock = (auth()->guard('admin')->user()->stock == 1);
                $reports = (auth()->guard('admin')->user()->reports == 1);
                $alluser = (auth()->guard('admin')->user()->alluser == 1);
                $adminuserrole = (auth()->guard('admin')->user()->adminuserrole == 1);
            @endphp
            @if ($brand == true)
            {{-- Brand --}}
            <li class="treeview {{ ($prefix == '/brand')? 'active' : '' }}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Brand</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.brand')? 'active' : '' }}">
                        <a href="{{ route('all.brand') }}"><i class="ti-more"></i>All Brand</a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($category == true)
            {{-- Category --}}
            <li class="treeview {{ ($prefix == '/category')? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.category')? 'active' : '' }}">
                        <a href="{{ route('all.category') }}"><i class="ti-more"></i>All Category</a>
                    </li>

                    <li class="{{ ($route == 'all.subcategory')? 'active' : '' }}">
                        <a href="{{ route('all.subcategory') }}"><i class="ti-more"></i>All Sub Category</a>
                    </li>

                    <li class="{{ ($route == 'all.subsubcategory')? 'active' : '' }}">
                        <a href="{{ route('all.subsubcategory') }}"><i class="ti-more"></i>All Sub SubCategory</a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($product == true)

            {{-- Product --}}
            <li class="treeview {{ ($prefix == '/product')? 'active' : '' }}">
                <a href="#">
                    {{-- <i class="fa fa-list"></i> --}}
                    <i class="fas fa-coins"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'add-product')? 'active' : '' }}">
                        <a href="{{ route('add-product') }}"><i class="ti-more"></i>Add Product</a>
                    </li>
                    <li class="{{ ($route == 'manage-product')? 'active' : '' }}">
                        <a href="{{ route('manage-product') }}"><i class="ti-more"></i>Manage Products</a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($coupon == true)
            {{-- Coupon --}}
            <li class="treeview {{ ($prefix == '/coupons')? 'active' : '' }}">
                <a href="#">
                    {{-- <i class="fa fa-list"></i> --}}
                    <i class="fa fa-percent"></i>
                    <span>Coupons</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage-coupon')? 'active' : '' }}">
                        <a href="{{ route('manage-coupon') }}"><i class="ti-more"></i>Manage Coupon</a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($shipping == true)
            {{-- Shipping --}}
            <li class="treeview {{ ($prefix == '/shipping')? 'active' : '' }}">
                <a href="#">
                    {{-- <i class="fa fa-list"></i> --}}
                    <i class="fa fa-location-arrow"></i>
                    <span>Shipping Area</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage-division')? 'active' : '' }}">
                        <a href="{{ route('manage-division') }}"><i class="ti-more"></i>Ship Division</a>
                    </li>
                    <li class="{{ ($route == 'manage-district')? 'active' : '' }}">
                        <a href="{{ route('manage-district') }}"><i class="ti-more"></i>Ship District</a>
                    </li>
                    <li class="{{ ($route == 'manage-state')? 'active' : '' }}">
                        <a href="{{ route('manage-state') }}"><i class="ti-more"></i>Ship State</a>
                    </li>
                </ul>
            </li>

            @endif

            <li class="header nav-small-cap">User Interface</li>

            @if ($orders == true)
            {{-- Order --}}
            <li class="treeview {{ ($prefix == '/orders')? 'active' : '' }}">
                <a href="#">
                    {{-- <i class="fa fa-list"></i> --}}
                    <i class="fa fa-location-arrow"></i>
                    <span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'pending-orders')? 'active' : '' }}">
                        <a href="{{ route('pending-orders') }}"><i class="ti-more"></i>Pending Order</a>
                    </li>
                    <li class="{{ ($route == 'confirmed.order')? 'active' : '' }}">
                        <a href="{{ route('confirmed.order') }}"><i class="ti-more"></i>Confirmed Order</a>
                    </li>
                    <li class="{{ ($route == 'processing.order')? 'active' : '' }}">
                        <a href="{{ route('processing.order') }}"><i class="ti-more"></i>Processing Order</a>
                    </li>
                    <li class="{{ ($route == 'picked.order')? 'active' : '' }}">
                        <a href="{{ route('picked.order') }}"><i class="ti-more"></i>Picked Order</a>
                    </li>
                    <li class="{{ ($route == 'shipped.order')? 'active' : '' }}">
                        <a href="{{ route('shipped.order') }}"><i class="ti-more"></i>Shipped Order</a>
                    </li>
                    <li class="{{ ($route == 'delivered.order')? 'active' : '' }}">
                        <a href="{{ route('delivered.order') }}"><i class="ti-more"></i>Delivered Order</a>
                    </li>
                    <li class="{{ ($route == 'cancel.order')? 'active' : '' }}">
                        <a href="{{ route('cancel.order') }}"><i class="ti-more"></i>Cancel Order</a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($stock == true)
            {{-- Manage Stock --}}
            <li class="treeview {{ ($prefix == '/stock')? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-box"></i>
                    <span>Manage Stock</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'product.stock')? 'active' : '' }}">
                        <a href="{{ route('product.stock') }}"><i class="ti-more"></i>Product Stock</a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($reports == true)
            {{-- Reports --}}
            <li class="treeview {{ ($prefix == '/reports')? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-file-alt"></i>
                    <span>All Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all-reports')? 'active' : '' }}">
                        <a href="{{ route('all-reports') }}"><i class="ti-more"></i>All Reports</a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($alluser == true)
            {{-- User --}}
            <li class="treeview {{ ($prefix == '/alluser')? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>All Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all-users')? 'active' : '' }}">
                        <a href="{{ route('all-users') }}"><i class="ti-more"></i>All Users</a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($adminuserrole == true)
             {{-- Admin User Role --}}
             <li class="treeview {{ ($prefix == '/adminuserrole')? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-user-shield"></i>
                    <span>Admin Users Role</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.admin.user')? 'active' : '' }}">
                        <a href="{{ route('all.admin.user') }}"><i class="ti-more"></i>All Admin User</a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($blog == true)
             {{-- Manage Blog --}}
             <li class="treeview {{ ($prefix == '/blog')? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-blog"></i>
                    <span>Manage Blog</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'blog.category')? 'active' : '' }}">
                        <a href="{{ route('blog.category') }}"><i class="ti-more"></i>Blog Category</a>
                    </li>
                    <li class="{{ ($route == 'view.blog.post')? 'active' : '' }}">
                        <a href="{{ route('view.blog.post') }}"><i class="ti-more"></i>View Blog Post</a>
                    </li>
                    <li class="{{ ($route == 'blog.post.add')? 'active' : '' }}">
                        <a href="{{ route('blog.post.add') }}"><i class="ti-more"></i>Add Blog Post</a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($setting == true)
            {{-- Setting --}}
            <li class="treeview {{ ($prefix == '/setting')? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Manage Setting</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'site.setting')? 'active' : '' }}">
                        <a href="{{ route('site.setting') }}"><i class="ti-more"></i>Site Setting</a>
                    </li>
                    <li class="{{ ($route == 'seo.setting')? 'active' : '' }}">
                        <a href="{{ route('seo.setting') }}"><i class="ti-more"></i>Seo Setting</a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($returnorder == true)
            {{-- Return Ordre --}}
            <li class="treeview {{ ($prefix == '/return')? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-retweet"></i>
                    <span>Return Order</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'return.request')? 'active' : '' }}">
                        <a href="{{ route('return.request') }}"><i class="ti-more"></i>Return Request</a>
                    </li>
                    <li class="{{ ($route == 'all.request')? 'active' : '' }}">
                        <a href="{{ route('all.request') }}"><i class="ti-more"></i>All Request</a>
                    </li>
                </ul>
            </li>
            @endif

            @if ($review == true)
            {{-- Review Manage --}}
            <li class="treeview {{ ($prefix == '/review')? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-quote-right"></i>
                    <span>Manage Review</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'pending.review')? 'active' : '' }}">
                        <a href="{{ route('pending.review') }}"><i class="ti-more"></i>Pending Review</a>
                    </li>
                    <li class="{{ ($route == 'published.review')? 'active' : '' }}">
                        <a href="{{ route('published.review') }}"><i class="ti-more"></i>Published Review</a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
            aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
                class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
                class="ti-lock"></i></a>
    </div>
</aside>
