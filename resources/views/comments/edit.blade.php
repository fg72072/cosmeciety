@extends('layouts.app')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">Edit Comment</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Comment </li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" enctype="multipart/form-data" method="POST" action="{{url('comment/update/'.$comment->id)}}">
                @csrf
                <div class="form-group">
                    <label for="description">Message</label>
                    <textarea name="message" id="description" class="form-control" cols="30" rows="10">{{$comment->message}}</textarea>
                    @error('message')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" name="status" id="status" style="width: 100%;">
                      <option value="1" @if($comment->status == 1) selected @endif>Active</option>
                      <option value="0" @if($comment->status == 0) selected @endif>Unactive</option>
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