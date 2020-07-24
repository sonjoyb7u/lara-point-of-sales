@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
{{-- @dd($route); --}}

<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ !empty(Auth::user()->image) ? asset('uploads/users/profile/' . Auth::user()->image) : asset('uploads/users/default_no_image.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
{{--      USER SECTION...--}}
          @if(auth()->user()->user_type == 'super_admin')
          <li class="nav-item has-treeview {{ request()->is('home/user', 'home/user/create', 'home/user/edit') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('home/user', 'home/user/create', 'home/user/edit') ? 'active' : ''}}">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                User Section
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user.create') }}" class="nav-link {{ request()->is('home/user/create') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('home/user') ? 'active' : ''}} {{ request()->is('home/user/edit') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Manage User's</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
{{--      USER PROFILE SECTION...--}}
          <li class="nav-item has-treeview {{ $prefix == 'home/user/profile' ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ $route == 'user.profile.index' ? 'active' : ''}} {{ $route == 'user.profile.edit' ? 'active' : ''}} {{ $route == 'user.profile.password.edit' ? 'active' : ''}}">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                User Profile Section
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user.profile.index') }}" class="nav-link {{ $route == 'user.profile.index' ? 'active' : ''}} {{ $route == 'user.profile.edit' ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Manage User Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.profile.password.edit') }}" class="nav-link {{ $route == 'user.profile.password.edit' ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            </ul>
          </li>
{{--      SUPPLIER SECTION...--}}
          <li class="nav-item has-treeview {{ request()->is('home/suppliers', 'home/suppliers*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('home/suppliers', 'home/suppliers/*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Supplier Section
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('supplier.create') }}" class="nav-link {{ request()->is('home/suppliers/create') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Add Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('supplier.index') }}" class="nav-link {{ request()->is('home/suppliers') ? 'active' : ''}} {{ request()->is('home/suppliers/edit*') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Manage Supplier's</p>
                </a>
              </li>
            </ul>
          </li>
{{--      CUSTOMER SECTION...--}}
          <li class="nav-item has-treeview {{ request()->is('home/customers', 'home/customers*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('home/customers', 'home/customers/*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Customer Section
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('customer.create') }}" class="nav-link {{ request()->is('home/customers/create') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Add Customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('customer.index') }}" class="nav-link {{ request()->is('home/customers') ? 'active' : ''}} {{ request()->is('home/customers/edit*') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Manage Customer's</p>
                </a>
              </li>
            </ul>
          </li>
{{--      UNIT SECTION...--}}
          <li class="nav-item has-treeview {{ request()->is('home/units', 'home/units*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('home/units', 'home/units/*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Unit Section
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('unit.create') }}" class="nav-link {{ request()->is('home/units/create') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Add Unit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('unit.index') }}" class="nav-link {{ request()->is('home/units') ? 'active' : ''}} {{ request()->is('home/units/edit*') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Manage Unit's</p>
                </a>
              </li>
            </ul>
          </li>
{{--      CATEGORY SECTION...--}}
          <li class="nav-item has-treeview {{ request()->is('home/categories', 'home/categories*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('home/categories', 'home/categories/*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Category Section
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('category.create') }}" class="nav-link {{ request()->is('home/categories/create') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link {{ request()->is('home/categories') ? 'active' : ''}} {{ request()->is('home/categories/edit*') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Manage categories</p>
                </a>
              </li>
            </ul>
          </li>
{{--      SUB CATEGORY SECTION...--}}
          <li class="nav-item has-treeview {{ request()->is('home/sub-categories', 'home/sub-categories*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('home/sub-categories', 'home/sub-categories/*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Sub Category Section
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('sub-category.create') }}" class="nav-link {{ request()->is('home/sub-categories/create') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Add Sub Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('sub-category.index') }}" class="nav-link {{ request()->is('home/sub-categories') ? 'active' : ''}} {{ request()->is('home/sub-categories/edit*') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Manage Sub Categories</p>
                </a>
              </li>
            </ul>
          </li>
{{--      PRODUCT SECTION... --}}
          <li class="nav-item has-treeview {{ request()->is('home/products', 'home/products*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('home/products', 'home/products/*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Product Section
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('product.create') }}" class="nav-link {{ request()->is('home/products/create') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('product.index') }}" class="nav-link {{ request()->is('home/products') ? 'active' : ''}} {{ request()->is('home/products/edit*') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Manage Products</p>
                </a>
              </li>
            </ul>
          </li>
{{--      PURCHASE SECTION... --}}
          <li class="nav-item has-treeview {{ request()->is('home/purchases', 'home/purchases*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('home/purchases', 'home/purchases/*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Purchases Section
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('purchase.create') }}" class="nav-link {{ request()->is('home/purchases/create') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Add Purchase</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('purchase.index') }}" class="nav-link {{ request()->is('home/purchases') ? 'active' : ''}} {{ request()->is('home/purchases/edit*') ? 'active' : ''}}">
                  <i class="fas fa-puzzle-piece nav-icon"></i>
                  <p>Manage Purchases</p>
                </a>
              </li>
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
