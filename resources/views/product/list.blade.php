@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">List Products</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Product</li>
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
                <table class="table table-hover datatable ">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Product</th>
                      <th>Category</th>
                      <th>Short Intro</th>
                      <th>Seller</th>
                      <th>Price</th>
                      <th>Stock</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                    <tr>
                      <td>{{$product->id}}</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="{{asset('assets/images/product/'.$product->img)}}" alt="image" />
                          <div class="table-user-name ml-3">
                            <p class="mb-0 font-weight-medium"> {{$product->title}} </p>
                          </div>
                        </div>
                      </td>
                      <td>{{$product->category->title}}</td>
                      <td>{{$product->description}}</td>
                      <td>{{$product->seller->name}}</td>
                      <td>${{$product->price}}</td>
                      <td>{{$product->stock}}</td>
                      <td>
                        @if ($product->status == 1)
                        <label class="badge badge-success">Active</label>
                        @else
                        <label class="badge badge-danger">Unactive</label>
                        @endif
                      </td>
                      <td>
                        <div class="btn-flex">
                            <a href="{{url('product/edit/'.$product->id)}}" class="btn text-white btn-success btn-icon-text">
                                <i class="mdi mdi-pencil-box-outline btn-icon-prepend"></i> Edit </a>
                            <form action="{{url('product/delete/'.$product->id)}}" method="post" class="delete-form">
                            @csrf
                                <button type="submit" class="btn btn-danger btn-icon-text">
                                    <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Delete </button>
                            </form>
                        
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
