@extends('layouts.app')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">Add Category</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Add Category </li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title" />
                  @error('title')
                  <div class="mt-1">
                    <span class="text-danger">{{$message}}</span>
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" name="status" id="status" style="width: 100%;">
                      <option value="1">Active</option>
                      <option value="0">Unactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mr-2"> Publish </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection