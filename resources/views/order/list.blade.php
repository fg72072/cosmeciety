@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">List Order</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Order</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-lg-12 col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              {{-- <h4 class="card-title">Hoverable Table</h4> --}}
              </p>
              <div class="table-responsive">
                <table class="table table-hover datatable">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Product</th>
                      <th>Seller</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" />
                          <div class="table-user-name ml-3">
                            <p class="mb-0 font-weight-medium"> Test </p>
                          </div>
                        </div>
                      </td>
                      <td class="text-danger"> 28.76% <i class="mdi mdi-arrow-down"></i>
                      </td>
                      <td>
                        <label class="badge badge-danger">Pending</label>
                      </td>
                    </tr>
                    <tr>
                      <td>Messsy</td>
                      <td>Flash</td>
                      <td class="text-danger"> 21.06% <i class="mdi mdi-arrow-down"></i>
                      </td>
                      <td>
                        <label class="badge badge-warning">In progress</label>
                      </td>
                    </tr>
                    <tr>
                      <td>John</td>
                      <td>Premier</td>
                      <td class="text-danger"> 35.00% <i class="mdi mdi-arrow-down"></i>
                      </td>
                      <td>
                        <label class="badge badge-info">Fixed</label>
                      </td>
                    </tr>
                    <tr>
                      <td>Peter</td>
                      <td>After effects</td>
                      <td class="text-success"> 82.00% <i class="mdi mdi-arrow-up"></i>
                      </td>
                      <td>
                        <label class="badge badge-success">Completed</label>
                      </td>
                    </tr>
                    <tr>
                      <td>Dave</td>
                      <td>53275535</td>
                      <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i>
                      </td>
                      <td>
                        <label class="badge badge-warning">In progress</label>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
