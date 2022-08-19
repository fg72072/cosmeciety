@extends('layouts.app')

@section('content')

    <div class="main-panel">
      <div class="content-wrapper pb-0">
        <div class="page-header flex-wrap">
          <h3 class="mb-0"> Hi, welcome back! 
          </h3>
          {{-- <div class="d-flex">
            <button type="button" class="btn btn-sm bg-white btn-icon-text border">
              <i class="mdi mdi-email btn-icon-prepend"></i> Email </button>
            <button type="button" class="btn btn-sm bg-white btn-icon-text border ml-3">
              <i class="mdi mdi-printer btn-icon-prepend"></i> Print </button>
            <button type="button" class="btn btn-sm ml-3 btn-success"> Add User </button>
          </div> --}}
        </div>
        <div class="row">
          <div class="col-xl-12 col-lg-12  grid-margin">
            <div class="row">
              @role('super-admin')
              <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                <div class="card bg-warning">
                  <div class="card-body px-3 py-4">
                  <a href="{{url('user')}}" class="normal-anchor">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Users</p>
                        <h2 class="text-white"> {{$user}}</span>
                        </h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-account-circle bg-inverse-icon-warning"></i>
                    </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                <div class="card bg-warning">
                  <div class="card-body px-3 py-4">
                  <a href="{{url('user/barber')}}" class="normal-anchor">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Barbers</p>
                        <h2 class="text-white"> {{$barber}}</span>
                        </h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-account-circle bg-inverse-icon-warning"></i>
                    </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                <div class="card bg-warning">
                  <div class="card-body px-3 py-4">
                  <a href="{{url('user/seller')}}" class="normal-anchor">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Sellers</p>
                        <h2 class="text-white"> {{$seller}}</span>
                        </h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-account-circle bg-inverse-icon-warning"></i>
                    </div>
                    </a>
                  </div>
                </div>
              </div>
              @endrole
              @role('seller')
              <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                <div class="card bg-danger">
                  <div class="card-body px-3 py-4">
                  <a href="{{url('product')}}" class="normal-anchor">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Products</p>
                        <h2 class="text-white"> {{$product}}</span>
                        </h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-cube-outline bg-inverse-icon-danger"></i>
                    </div>
                    </a>

                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                <div class="card bg-danger">
                  <div class="card-body px-3 py-4">
                  <a href="{{url('product')}}" class="normal-anchor">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Top Product</p>
                        <h2 class="text-white"> {{$top_product}}</span>
                        </h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-cube-outline bg-inverse-icon-danger"></i>
                    </div>
                  </a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                <div class="card bg-danger">
                  <div class="card-body px-3 py-4">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Total Sales</p>
                        <h2 class="text-white"> ${{$total_sales}}</span>
                        </h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-cube-outline bg-inverse-icon-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                <div class="card bg-primary">
                  <div class="card-body px-3 py-4">
                  <a href="{{url('order')}}" class="normal-anchor">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Orders</p>
                        <h2 class="text-white"> {{$order}}</span>
                        </h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i>
                    </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                <div class="card bg-primary">
                  <div class="card-body px-3 py-4">
                  <a href="{{url('order?type=pending')}}" class="normal-anchor">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Pending Orders</p>
                        <h2 class="text-white"> {{$pending_order}}</span>
                        </h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i>
                    </div>
                  </a>
                  </div>
                </div>
              </div>
              @endrole              
              @role('super-admin')
              <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                <div class="card bg-success">
                  <div class="card-body px-3 py-4">
                  <a href="{{url('contest')}}" class="normal-anchor">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Contests</p>
                        <h2 class="text-white">{{$contest}}</h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-basket bg-inverse-icon-success"></i>
                    </div>
                  </a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                <div class="card bg-success">
                  <div class="card-body px-3 py-4">
                  <a href="{{url('contest/upcoming')}}" class="normal-anchor">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Upcoming Contest</p>
                        <h2 class="text-white">{{$upcoming_contest}}</h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-basket bg-inverse-icon-success"></i>
                    </div>
                  </a>
                  </div>
                </div>
              </div>
              @endrole
            </div>
          </div>
        </div>
        {{-- <div class="row">
          @role('super-admin')
          <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body px-0 overflow-auto">
                <h4 class="card-title pl-4">Recent Users</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="bg-light">
                      <tr>
                        <th>Profile</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" />
                            <div class="table-user-name ml-3">
                              <p class="mb-0 font-weight-medium"> Cecelia Cooper </p>
                            </div>
                          </div>
                        </td>
                        <td>cecelia@gmail.com</td>
                        <td>Barber</td>
                        <td>
                            <div class="badge badge-inverse-success"> Active </div>
                          </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" />
                            <div class="table-user-name ml-3">
                              <p class="mb-0 font-weight-medium"> Cecelia Cooper </p>
                            </div>
                          </div>
                        </td>
                        <td>cecelia@gmail.com</td>
                        <td>Barber</td>
                        <td>
                            <div class="badge badge-inverse-success"> Active </div>
                          </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" />
                            <div class="table-user-name ml-3">
                              <p class="mb-0 font-weight-medium"> Cecelia Cooper </p>
                            </div>
                          </div>
                        </td>
                        <td>cecelia@gmail.com</td>
                        <td>Seller</td>
                        <td>
                            <div class="badge badge-inverse-danger"> Unactive </div>
                          </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" />
                            <div class="table-user-name ml-3">
                              <p class="mb-0 font-weight-medium"> Cecelia Cooper </p>
                            </div>
                          </div>
                        </td>
                        <td>cecelia@gmail.com</td>
                        <td>Barber</td>
                        <td>
                            <div class="badge badge-inverse-success"> Active </div>
                          </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" />
                            <div class="table-user-name ml-3">
                              <p class="mb-0 font-weight-medium"> Cecelia Cooper </p>
                            </div>
                          </div>
                        </td>
                        <td>cecelia@gmail.com</td>
                        <td>Barber</td>
                        <td>
                            <div class="badge badge-inverse-success"> Active </div>
                          </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" />
                            <div class="table-user-name ml-3">
                              <p class="mb-0 font-weight-medium"> Cecelia Cooper </p>
                            </div>
                          </div>
                        </td>
                        <td>cecelia@gmail.com</td>
                        <td>Seller</td>
                        <td>
                            <div class="badge badge-inverse-danger"> Unactive </div>
                          </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <a class="text-black mt-3 d-block pl-4" href="#">
                  <span class="font-weight-medium h6">View all Users</span>
                  <i class="mdi mdi-chevron-right"></i></a>
              </div>
            </div>
          </div>
          @endrole
          <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body px-0 overflow-auto">
                <h4 class="card-title pl-4">Recent Orders</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="bg-light">
                      <tr>
                        <th>Profile</th>
                        <th>Invoice</th>
                        <th>Status</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" />
                            <div class="table-user-name ml-3">
                              <p class="mb-0 font-weight-medium"> Cecelia Cooper </p>
                              <small>Paid</small>
                            </div>
                          </div>
                        </td>
                        <td>12345678</td>
                        <td>
                          <div class="badge badge-inverse-danger"> Cancel </div>
                        </td>
                        <td>$ 77.99</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" />
                            <div class="table-user-name ml-3">
                              <p class="mb-0 font-weight-medium"> Cecelia Cooper </p>
                              <small>Paid</small>
                            </div>
                          </div>
                        </td>
                        <td>12345678</td>
                        <td>
                          <div class="badge badge-inverse-success"> Completed </div>
                        </td>
                        <td>$ 77.99</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" />
                            <div class="table-user-name ml-3">
                              <p class="mb-0 font-weight-medium"> Cecelia Cooper </p>
                              <small>Unpaid</small>
                            </div>
                          </div>
                        </td>
                        <td>12345678</td>
                        <td>
                          <div class="badge badge-inverse-success"> Completed </div>
                        </td>
                        <td>$ 77.99</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" />
                            <div class="table-user-name ml-3">
                              <p class="mb-0 font-weight-medium"> Cecelia Cooper </p>
                              <small>Paid</small>
                            </div>
                          </div>
                        </td>
                        <td>12345678</td>
                        <td>
                          <div class="badge badge-inverse-danger"> Cancel </div>
                        </td>
                        <td>$ 77.99</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" />
                            <div class="table-user-name ml-3">
                              <p class="mb-0 font-weight-medium"> Cecelia Cooper </p>
                              <small>Unpaid</small>
                            </div>
                          </div>
                        </td>
                        <td>12345678</td>
                        <td>
                          <div class="badge badge-inverse-success"> Completed </div>
                        </td>
                        <td>$ 77.99</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" />
                            <div class="table-user-name ml-3">
                              <p class="mb-0 font-weight-medium"> Cecelia Cooper </p>
                              <small>Unpaid</small>
                            </div>
                          </div>
                        </td>
                        <td>12345678</td>
                        <td>
                          <div class="badge badge-inverse-success"> Completed </div>
                        </td>
                        <td>$ 77.99</td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
                <a class="text-black mt-3 d-block pl-4" href="#">
                  <span class="font-weight-medium h6">View all order history</span>
                  <i class="mdi mdi-chevron-right"></i></a>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
    <!-- main-panel ends -->
@endsection
