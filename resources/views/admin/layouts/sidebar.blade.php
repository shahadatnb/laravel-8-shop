<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('/') }}" target="_blank" class="brand-link">
      <img src=""
           alt=""
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-1 d-flex">
            @if(Auth::user()->photo)
                @php $profilePhoto=Auth::user()->photo @endphp
            @else
                @php $profilePhoto='assets/admin/img/avatar.png' @endphp
            @endif
        <div class="image">
          <img src="{{ asset($profilePhoto) }}" class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
        <a href="{{route('profile')}}" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route("dashboard") }}" class="nav-link{{ (request()->routeIs('dashboard')) ? ' active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          {{-- @if(Auth::user()->hasAnyRole(['staff','admin','club']))
          <li class="nav-header">Setting</li>
          <li class="nav-item has-treeview {{ (request()->routeIs('createTeam','teamList','createUser','userList','club.*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->routeIs('createTeam','teamList','createUser','userList','club.*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>Manage Clubs & Teams <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              @if(Auth::user()->hasAnyRole(['staff','admin']))
              <li class="nav-item"><a href="{{ route('club.index') }}" class="nav-link{{ (request()->routeIs('club.*')) ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Requested Club</a>
              </li>
              @endif
            </ul>
          </li>
          @endif --}}
          @if(Auth::user()->hasAnyRole(['staff','admin']))
          <li class="nav-item has-treeview {{ (request()->routeIs('product.*','category.*','attribute.*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->routeIs('product.*','category.*','attribute.*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>Products <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{route('category.index')}}" class="nav-link{{ (request()->routeIs('category.index')) ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Categories</a>
              </li>
              <li class="nav-item"><a href="{{route('product.create')}}" class="nav-link{{ (request()->routeIs('product.create')) ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Add Products</a>
              </li>
              <li class="nav-item"><a href="{{route('product.index')}}" class="nav-link{{ (request()->routeIs('product.index')) ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i> View Products</a>
              </li>
              <li class="nav-item"><a href="{{route('product.inventory')}}" class="nav-link{{ (request()->routeIs('product.inventory')) ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Products Inventory</a>
              </li>
              <li class="nav-item"><a href="{{route('product.trashed')}}" class="nav-link{{ (request()->routeIs('product.trashed')) ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Trashed Products</a>
              </li>
            <li class="nav-item"><a href="{{route('attribute.index')}}" class="nav-link{{ (request()->routeIs('attribute.*','')) ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Attributes</a>
              </li>
            </ul>
          </li>
          @endif
          @if(Auth::user()->hasAnyRole(['staff','admin']))
          <li class="nav-item has-treeview{{ (request()->routeIs('order.*')) ? ' menu-open' : '' }}">
            <a href="#" class="nav-link{{ (request()->routeIs('order.*')) ? ' active' : '' }}">
              <i class="nav-icon fas fa-pallet"></i>
              <p>Order <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{route('order.index')}}" class="nav-link{{ (request()->routeIs('order.index')) ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Order</a>
              </li>
              <li class="nav-item"><a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i> Invoice</a>
              </li>
              <li class="nav-item"><a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i> Shipment</a>
              </li>
              <li class="nav-item"><a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i> Refund</a>
              </li>
              <li class="nav-item"><a href="{{route('order.product.view')}}" class="nav-link{{ (request()->routeIs('order.product.view')) ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Product sales report</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('homepage.index') }}" class="nav-link{{ (request()->routeIs('homepage.*')) ? ' active' : '' }}">
              <i class="nav-icon fas fa-ad"></i>
              <p>Homepage Settings</p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="{{ route('coupon.index') }}" class="nav-link{{ (request()->routeIs('coupon.*')) ? ' active' : '' }}">
              <i class="nav-icon fas fa-ad"></i>
              <p>Manage Promotion</p>
            </a>
          </li> --}}
        <li class="nav-item">
            <a href="{{route('admin.customer')}}" class="nav-link{{ (request()->routeIs('admin.customer')) ? ' active' : '' }}">
                <i class="nav-icon fas fa-store"></i>
                <p>Customers</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('review.index')}}" class="nav-link{{ (request()->routeIs('review.*')) ? ' active' : '' }}">
                <i class="nav-icon fas fa-store"></i>
                <p>Reviews</p>
            </a>
        </li>
          @endif
          @if(Auth::user()->hasAnyRole(['admin']))
          <li class="nav-header">CMS</li>
          @foreach($postType as $key=>$item)
          <li class="nav-item has-treeview {{ (request()->get('type') == $item['postType']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->get('type') == $item['postType']) ? 'active' : '' }}">
              <i class="nav-icon fas {{$item['icon']}}"></i>
              <p>
                {{$item['title']}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ route('posts.index') }}?type={{$item['postType']}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i> All {{$item['title']}}</a>
              </li>
              <li class="nav-item"><a href="{{ route('posts.create') }}?type={{$item['postType']}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i> New {{$item['title']}}</a>
              </li>
              @if($item['taxonomy']==true)
              <li class="nav-item"><a href="{{ route('taxonomy.index') }}?type={{$item['postType']}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i> Category</a>
              </li>
              @endif
            </ul>
          </li>
          @endforeach
          <li class="nav-item">
            <a href="{{ route('menus.index') }}" class="nav-link{{ (request()->routeIs('menus.*')) ? ' active' : '' }}">
              <i class="nav-icon fas fa-bars"></i>
              <p>Menus</p>
            </a>
          </li>

          <li class="nav-header">Super Admin</li>
          <li class="nav-item has-treeview{{ (request()->routeIs('settings','taxrate.*')) ? ' menu-open' : '' }}">
            <a href="#" class="nav-link{{ (request()->routeIs('settings','taxrate.*')) ? ' active' : '' }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                App Setings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i> Users</a>
              </li>
              <li class="nav-item"><a href="{{ route('roles.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i> User Role</a>
              </li>
              <li class="nav-item"><a href="{{ route('settings') }}" class="nav-link{{ (request()->routeIs('settings')) ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Basic Settings</a>
              </li>
              <li class="nav-item"><a href="{{ route('taxrate.index') }}" class="nav-link{{ (request()->routeIs('taxrate.*')) ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i> Tax Settings</a>
              </li>
            </ul>
          </li>
          @endif

          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>{{ __('Logout') }}</p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
