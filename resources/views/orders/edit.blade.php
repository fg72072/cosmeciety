@extends('layouts.app')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Add Order</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Add Order </li>
                    </ol>
                </nav>
            </div>
            <div class="row ">
                <div class="col-12 grid-margin ">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" action="{{ url('order/update/'.$order->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" value="{{$order->first_name}}" name="first_name" id="first_name"
                                                placeholder="First Name" />
                                            @error('first_name')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" value="{{$order->last_name}}" name="last_name" id="last_name"
                                                placeholder="Last Name" />
                                            @error('last_name')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="mobile" class="form-control" value="{{$order->mobile}}" name="mobile" id="mobile"
                                                placeholder="Mobile" />
                                            @error('mobile')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="postal_code">Postal Code</label>
                                            <input type="postal_code" class="form-control" value="{{$order->postal_code}}" name="postal_code" id="postal_code"
                                                placeholder="Postal Code" />
                                            @error('postal_code')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2"> Update </button>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <select class="js-example-basic-single" name="country" id="country" style="width: 100%;">
                                                @foreach ($countries as $country)
                                                <option value="{{$country->id}}" @if($order->country_id == $country->id) selected @endif>{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <select class="js-example-basic-single" name="city" id="city" style="width: 100%;">
                                                @foreach ($cities as $city)
                                                <option value="{{$city->id}}" @if($order->city_id == $city->id) selected @endif>{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status" style="width: 100%;">
                                                @foreach ($statuses as $status)
                                                <option value="{{$status->id}}" @if($order->status == $status->id) selected @endif>{{$status->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Order Items</h4>
                      </p>
                      <div class="table-responsive">
                        <table class="table table-hover datatable ">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Product</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($order->orderItems as $item)
                            <tr>
                              <td>{{$item->id}}</td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <img src="{{$item->product->img ? asset('assets/images/product/'.$item->product->img) : asset('assets/images/faces/face1.jpg')}}" alt="image" />
                                  <div class="table-user-name ml-3">
                                    <p class="mb-0 font-weight-medium"> {{$item->product->title}} </p>
                                  </div>
                                </div>
                              </td>
                              <td>${{$item->price}}</td>
                              <td>{{$item->qty}}</td>
                              <td>${{$item->total}}</td>
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
