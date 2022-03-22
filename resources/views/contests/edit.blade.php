@extends('layouts.app')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">Add Contest</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Add Contest </li>
          </ol>
        </nav>
      </div>
      <div class="row ">
        <div class="col-12 grid-margin ">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" action="{{url('contest/update/'.$contest->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div id="profile-container">
                      <img class="" id="profileImage" src="{{asset('assets/images/contest/'.$contest->banner)}}" alt="Upload Banner" data-holder-rendered="true" max-height="10px;" max-width="100px;" style="height:100px;width:100px;">
                  </div>
                  <br>
                  <input id="imageUpload" type="file" name="banner" placeholder="Photo" capture="" value="">
                    @error('banner')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                  </div>
                <div class="form-group">
                  <label for="name">Title</label>
                  <input type="text" class="form-control" name="title" value="{{$contest->title}}" id="name" placeholder="Title" />
                  @error('title')
                  <div class="mt-1">
                    <span class="text-danger">{{$message}}</span>
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="price">Entry Fee</label>
                  <input type="number" class="form-control" min="1" value="{{$contest->entry_fee}}" name="entry_fee" id="price" placeholder="Entry Fee" />
                  @error('entry_fee')
                  <div class="mt-1">
                    <span class="text-danger">{{$message}}</span>
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{$contest->description}}</textarea>
                  @error('description')
                  <div class="mt-1">
                    <span class="text-danger">{{$message}}</span>
                  </div>
                  @enderror
              </div>
                <button type="submit" class="btn btn-primary mr-2"> Update </button>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="content_start_date">Contest Start Date</label>
                    <input type="date" class="form-control" value="{{$contest->contest_start_date}}" name="contest_start_date" id="content_start_date" placeholder="Contest Start Date" />
                    @error('contest_start_date')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="content_end_date">Contest End Date</label>
                    <input type="date" class="form-control" value="{{$contest->contest_end_date}}" name="contest_end_date" id="content_end_date" placeholder="Contest End Date" />
                    @error('contest_end_date')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="acceptance_date">Acceptance Date</label>
                    <input type="date" class="form-control" value="{{$contest->acceptance_date}}" name="acceptance_date" id="acceptance_date" placeholder="Acceptance Date" />
                    @error('acceptance_date')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="post_live_date">Post Live Date</label>
                    <input type="date" class="form-control" value="{{$contest->post_live_date}}" name="post_live_date" id="post_live_date" placeholder="Post Live Date" />
                    @error('post_live_date')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="announce_date">Announce Date</label>
                    <input type="date" class="form-control" value="{{$contest->announce_date}}" name="announce_date" id="announce_date" placeholder="Announce Date" />
                    @error('announce_date')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                      <label for="status">Status</label>
                      <select class="form-control" name="status" id="status" style="width: 100%;">
                          <option value="1" @if($contest->status == 1) selected @endif>Active</option>
                          <option value="0" @if($contest->status == 0) selected @endif>Unactive</option>
                        </select>
                  </div>
                </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection