<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
      <a class="sidebar-brand brand-logo" href="{{url('index')}}"><img src="{{asset('assets/images/logo.png')}}" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{url('index')}}"><img src="{{asset('assets/images/logo.png')}}" alt="logo" /></a>
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
        <a class="nav-link" data-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Products</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="product">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{url('product')}}">List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('product/create')}}">Add</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('inventory/create')}}">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Add Inventory</span>
        </a>
      </li>
      @endrole
      
      @role('super-admin')
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Users</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="user">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{url('user')}}">List</a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="{{url('user/create')}}">Add</a>
            </li> --}}
          </ul>
        </div>
      </li>
      @endrole
      @role('super-admin')
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Category</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="category">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{url('category')}}">List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('category/create')}}">Add</a>
            </li>
          </ul>
        </div>
      </li>
      @endrole
      @role('seller')
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#order" aria-expanded="false" aria-controls="order">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Orders</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="order">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{url('order')}}">List</a>
            </li>
          </ul>
        </div>
      </li>
      @endrole
      @role('super-admin')
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#topic" aria-expanded="false" aria-controls="topic">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Social Forum</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="topic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{url('topic')}}">List</a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="{{url('topic/create')}}">Add</a>
            </li> --}}
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#wall" aria-expanded="false" aria-controls="wall">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Wall</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="wall">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{url('wall')}}">List</a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="{{url('topic/create')}}">Add</a>
            </li> --}}
          </ul>
        </div>
      </li>
      @endrole
      @role('super-admin')
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#contest" aria-expanded="false" aria-controls="contest">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Contest</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="contest">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{url('contest')}}">List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('contest/create')}}">Add</a>
            </li>
          </ul>
        </div>
      </li>
      @endrole
      @role('super-admin')
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#transaction" aria-expanded="false" aria-controls="transaction">
          <i class="mdi mdi-content-cut menu-icon"></i>
          <span class="menu-title">Transaction</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="transaction">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{url('transaction')}}">List</a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="{{url('contest/create')}}">Add</a>
            </li> --}}
          </ul>
        </div>
      </li>
      @endrole
    </ul>
  </nav>