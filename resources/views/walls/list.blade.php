@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">List Wall</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List Wall</li>
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
                      <th>Creater</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Likes</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($walls as $wall)
                    <tr>
                      <td>{{$wall->id}}</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="{{$wall->user->img ? asset('assets/images/user/'.$wall->user->img) : asset('assets/images/faces/face1.jpg')}}" alt="image" />
                          <div class="table-user-name ml-3">
                            <p class="mb-0 font-weight-medium"> {{$wall->user->name}} </p>
                          </div>
                        </div>
                      </td>
                      <td>{{$wall->title}}</td>
                      <td>{{$wall->description}}</td>
                      <td>{{$wall->like->count()}}</td>
                      <td>
                        @if ($wall->status == 1)
                        <label class="badge badge-success">Active</label>
                        @else
                        <label class="badge badge-danger">Unactive</label>
                        @endif
                      </td>
                      <td>
                        <div class="btn-flex">
                            <a href="{{url('wall/edit/'.$wall->id)}}" class="btn text-white btn-success btn-icon-text">
                                <i class="mdi mdi-pencil-box-outline btn-icon-prepend"></i> Edit </a>
                            <form action="{{url('wall/delete/'.$wall->id)}}" method="post" class="delete-form">
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
