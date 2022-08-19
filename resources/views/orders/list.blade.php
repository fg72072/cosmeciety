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
                      <th>Order #</th>
                      <th>User</th>
                      <th>Total</th>
                      <!-- <th>SubTotal</th> -->
                      <!-- <th>Tax</th>
                      <th>GrandTotal</th> -->
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($orders as $order)
                  <tr class="{{$order->orderItems[0]->is_seen == '0' ? 'bg-light-danger' : ''}}">
                    <td>{{$order->id}}</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{$order->user->img ? asset('assets/images/user/'.$order->user->img) : asset('assets/images/faces/face1.jpg')}}" alt="image" />
                        <div class="table-user-name ml-3">
                          <p class="mb-0 font-weight-medium"> {{$order->user->name}} </p>
                        </div>
                      </div>
                    </td>
                    <td>
                    ${{$order->orderItems->sum('total')}}
                    </td>
                    <!-- <td>
                      ${{$order->tax}}
                    </td>
                    <td>
                      ${{$order->grand_total}}
                    </td> -->
                    <td>
                    @if ($order->orderItems[0]->status == 1 || $order->orderItems[0]->status == 3)
                      <label class="badge badge-danger">{{$order->orderItems[0]->status == 1 ? 'Pending' : 'Cancel'}}</label>
                      @elseif ($order->orderItems[0]->status == 2 || $order->orderItems[0]->status == 4)
                      <label class="badge badge-success">{{$order->orderItems[0]->status == 2 ? 'Confirm' : 'Delivered'}}</label>
                      @endif
                    <td>
                      <div class="btn-flex">
                          <a href="{{url('order/edit/'.$order->id)}}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn view-order text-white btn-success btn-icon-text">
                              <i class="mdi mdi-eye btn-icon-prepend"></i> View </a>
                          {{-- <form action="{{url('order/delete/'.$order->id)}}" method="post" class="delete-form">
                          @csrf
                              <button type="submit" class="btn btn-danger btn-icon-text">
                                  <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Delete </button>
                          </form> --}}
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content view-order-data">
    
    </div>

    </div>
  </div>
</div>
@endsection
