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
                      <th>User</th>
                      <th>SubTotal</th>
                      <th>Tax</th>
                      <th>GrandTotal</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($orders as $order)
                  <tr>
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
                    ${{$order->subtotal}}
                    </td>
                    <td>
                      ${{$order->tax}}
                    </td>
                    <td>
                      ${{$order->grand_total}}
                    </td>
                    <td>
                      @if ($order->deliveryStatus->title == "Pending" || $order->deliveryStatus->title == "Cancel")
                      <label class="badge badge-danger">{{$order->deliveryStatus->title}}</label>
                      @elseif ($order->deliveryStatus->title == "Confirm" || $order->deliveryStatus->title == "Delivered")
                      <label class="badge badge-danger">{{$order->deliveryStatus->title}}</label>
                      @endif
                    </td>
                    <td>
                      <div class="btn-flex">
                          <a href="{{url('order/edit/'.$order->id)}}" class="btn text-white btn-success btn-icon-text">
                              <i class="mdi mdi-pencil-box-outline btn-icon-prepend"></i> Edit </a>
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
@endsection
