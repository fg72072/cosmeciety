<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
      <a class="sidebar-brand brand-logo" href="{{url('/')}}"><img src="{{asset('assets/images/logo.png')}}" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{url('/')}}"><img src="{{asset('assets/images/logo.png')}}" alt="logo" /></a>
    </div>
    <ul class="nav">
      {{-- <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="assets/images/faces/face1.jpg" alt="profile" />
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column pr-3">
            <span class="font-weight-medium mb-2">Henry Klein</span>
            <span class="font-weight-normal">$8,753.00</span>
          </div>
          <span class="badge badge-danger text-white ml-3 rounded">3</span>
        </a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" href="{{url('/')}}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      @role('seller')
      <li class="nav-item">
        <a class="nav-link" href="{{url('product')}}">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Products</span>
        </a>
    
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('inventory/create')}}">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Inventory Section</span>
        </a>
      </li>
      @endrole
      
      @role('super-admin')
      <li class="nav-item">
        <a class="nav-link" href="{{url('user')}}">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('user/barber')}}">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Barbers</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('user/seller')}}">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Sellers</span>
          @if($v_seller_count)
          <span class="badge badge-danger text-white ml-3 rounded unseen-order-count">{{$v_seller_count}}</span>
          @endif
        </a>
      </li>
      @endrole
      @role('super-admin')
      <li class="nav-item">
        <a class="nav-link" href="{{url('category')}}">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Category</span>
        </a>
      </li>
      @endrole
      @role('seller')
      <li class="nav-item">
        <a class="nav-link" href="{{url('order')}}">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Orders</span>
          @if($v_order_count)
          <span class="badge badge-danger text-white ml-3 rounded unseen-order-count">{{$v_order_count}}</span>
          @endif
        </a>
      </li>
      @endrole
      @role('super-admin')
      <li class="nav-item">
        <a class="nav-link" href="{{url('topic')}}">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Community Forum</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('wall')}}">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Wall</span>
        </a>
      </li>
      @endrole
      @role('super-admin')
      <li class="nav-item">
        <a class="nav-link" href="{{url('contest')}}">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Contest</span>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="{{url('contest/upcoming')}}">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Upcoming Contest</span>
        </a>
      </li> -->
      @endrole
      @role('super-admin')
      <li class="nav-item">
        <a class="nav-link" href="{{url('transaction')}}">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Billing</span>
        </a>
      </li>
      @endrole
    </ul>
  </nav>