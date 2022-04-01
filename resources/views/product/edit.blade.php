@extends('layouts.app')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">Edit Poduct</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Product </li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" enctype="multipart/form-data" method="POST" action="{{url('product/update/'.$product->id)}}">
                @csrf
                <div class="form-group">
                    <div id="profile-container">
                      <img class="" id="profileImage" src="{{asset('assets/images/product/'.$product->img)}}" alt="Upload Icon" data-holder-rendered="true" max-height="10px;" max-width="100px;" style="height:100px;width:100px;">
                  </div>
                  <br>
                  <input id="imageUpload" type="file" name="image" placeholder="Photo" capture="" value="">
                    @error('image')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                  </div>
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" value="{{$product->title}}" name="title" id="title" placeholder="Title" />
                  @error('title')
                  <div class="mt-1">
                    <span class="text-danger">{{$message}}</span>
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" value="{{$product->price}}" min="1" name="price" id="price" placeholder="Price" />
                    @error('price')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="purchase_price">Purchase Price</label>
                    <input type="number" class="form-control" min="1"  value="{{$product->purchase_price}}" name="purchase_price" id="purchase_price" placeholder="Purchase Price" />
                    @error('purchase_price')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="js-example-basic-single" name="category" id="category" style="width: 100%;">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if($category->id == $product->id) selected @endif>{{$category->title}}</option>
                        @endforeach
                      </select>
                    @error('category')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
               
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{$product->description}}</textarea>
                    @error('description')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" name="status" id="status" style="width: 100%;">
                      <option value="1" @if($product->status == 1) selected @endif>Active</option>
                      <option value="0" @if($product->status == 0) selected @endif>Unactive</option>
                    </select>
              </div>
                <button type="submit" class="btn btn-primary mr-2"> Update </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection