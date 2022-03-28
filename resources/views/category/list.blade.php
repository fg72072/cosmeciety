@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">List Category</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Category</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-lg-12 col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="add-btn-section">
                <a class="btn btn-primary" href="{{url('category/create')}}">Add Category</a>
              </div>
              </p>
              <div class="table-responsive">
                <table class="table table-hover datatable ">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category)
                    <tr>
                      <td>{{$category->id}}</td>
                      <td>{{$category->title}}</td>
                      <td>
                        @if ($category->status == 1)
                        <label class="badge badge-success">Active</label>
                        @else
                        <label class="badge badge-danger">Unctive</label>
                        @endif
                      </td>
                      <td>
                        @role('super-admin')
                        <div class="btn-flex">
                          @if ($category->id != 1)
                          <a href="{{url('category/edit/'.$category->id)}}" class="btn text-white btn-success btn-icon-text">
                              <i class="mdi mdi-pencil-box-outline btn-icon-prepend"></i> Edit </a>
                              
                            <form action="{{url('category/delete/'.$category->id)}}" method="post" class="delete-form">
                              @csrf
                              <button type="submit" class="btn btn-danger btn-icon-text">
                                <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Delete </button>
                              </form>
                            @endif
                      
                      </div>
                        @endrole
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
