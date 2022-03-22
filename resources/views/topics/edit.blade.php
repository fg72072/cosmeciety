@extends('layouts.app')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">Edit Topic</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Topic </li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" enctype="multipart/form-data" method="POST" action="{{url('topic/update/'.$topic->id)}}">
                @csrf
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" value="{{$topic->title}}" id="title" placeholder="Title" />
                  @error('title')
                  <div class="mt-1">
                    <span class="text-danger">{{$message}}</span>
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{$topic->description}}</textarea>
                    @error('description')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" name="status" id="status" style="width: 100%;">
                      <option value="1" @if($topic->status == 1) selected @endif>Active</option>
                      <option value="0" @if($topic->status == 0) selected @endif>Unactive</option>
                    </select>
              </div>
                <button type="submit" class="btn btn-primary mr-2"> Update </button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Comments</h4>
              </p>
              <div class="table-responsive">
                <table class="table table-hover datatable ">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User</th>
                      <th>Message</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($topic->comments as $comment)
                    <tr>
                      <td>{{$comment->id}}</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="{{$comment->user->img ? asset('assets/images/user/'.$comment->user->img) : asset('assets/images/faces/face1.jpg')}}" alt="image" />
                          <div class="table-user-name ml-3">
                            <p class="mb-0 font-weight-medium"> {{$comment->user->email}} </p>
                          </div>
                        </div>
                      </td>
                      <td>{{$comment->message}}</td>
                      <td>
                        @if ($comment->status == 1)
                        <label class="badge badge-success">Active</label>
                        @else
                        <label class="badge badge-danger">Unactive</label>
                        @endif
                      </td>
                      <td>
                        <div class="btn-flex">
                            <a href="{{url('comment/edit/'.$comment->id)}}" class="btn text-white btn-success btn-icon-text">
                                <i class="mdi mdi-pencil-box-outline btn-icon-prepend"></i> Edit </a>
                            {{-- <form action="{{url('comment/delete/'.$comment->id)}}" method="post" class="delete-form">
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