@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">List User</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List User</li>
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
                      <th>User</th>
                      <th>Role</th>
                      <th>Email</th>
                      <th>Phone</th>
                      {{-- <th>Operational Hours</th> --}}
                      <th>Location</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach ($users as $user)
                   <tr>
                    <td>{{$user->id}}</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{$user->img ? asset('assets/images/user/'.$user->img) : asset('assets/images/faces/face1.jpg')}}" alt="image" />
                        <div class="table-user-name ml-3">
                          <p class="mb-0 font-weight-medium"> {{$user->name}} </p>
                        </div>
                      </div>
                    </td>
                    <td>{{$user->roles[0]->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone ?? '-' }}</td>
                    {{-- <td>{{$user->operational_hours ?? '-' }}</td> --}}
                    <td>{{$user->location ?? '-' }}</td>
                    <td>
                      @if ($user->status == 1)  
                      <label class="badge badge-success">Active</label>
                      @else
                      <label class="badge badge-danger">Unactive</label>
                      @endif
                    </td>
                    <td>
                      <div class="btn-flex">
                          <a href="{{url('user/edit/'.$user->id)}}" class="btn text-white btn-success btn-icon-text">
                              <i class="mdi mdi-pencil-box-outline btn-icon-prepend"></i> Edit </a>
                          <form action="{{url('user/delete/'.$user->id)}}" method="post" class="delete-form">
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
