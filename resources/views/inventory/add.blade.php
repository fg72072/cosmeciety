@extends('layouts.app')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">Inventory Section</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Inventory Section </li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" enctype="multipart/form-data" method="POST" action="{{route('inventory.store')}}">
                @csrf
                <div class="form-group">
                    <label for="product">Product</label>
                    <select class="js-example-basic-single" name="product" id="product" style="width: 100%;">
                        @foreach ($products as $product)
                        <option value="{{$product->id}}">{{$product->title}}</option>
                        @endforeach
                      </select>
                    @error('product')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" min="1" name="stock" id="stock" placeholder="Stock" />
                    @error('stock')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Purchase Price</label>
                    <input type="number" class="form-control" min="1" name="purchase_price" id="price" placeholder="Purchase Price" />
                    @error('purchase_price')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control" name="type" id="type" style="width: 100%;">
                        <option value="in" selected>Addition</option>
                        <option value="out">Subtraction</option>
                      </select>
                </div>
                
                {{-- <div class="form-group d-flex justify-content-between">
                    <label >Current Stock : <span class="current-stock">54</span></label>
                    <label >Total Purchase Price : <span class="purchase_price">54</span></label>
                </div> --}}
               
                <button type="submit" class="btn btn-primary mr-2"> Publish </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection