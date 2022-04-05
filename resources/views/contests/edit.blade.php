@extends('layouts.app')
<link rel="stylesheet" href="{{asset('assets/css/jquery.datetimepicker.css')}}" />
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">Edit Contest</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit Contest </li>
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
                    <div class="mt-3">
                    <span class="text-danger">Recommended size 60 x 55</span>
                    </div>
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
                    <label for="entries_acceptance_date">Entries Acceptance Date</label>
                    <input type="text" class="form-control date" name="entries_acceptance_date" autocomplete="off" readonly value="{{$contest->entries_acceptance_date}}" id="entries_acceptance_date" placeholder="Entries Acceptance Date" />
                    @error('entries_acceptance_date')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="entries_close_date">Entries Close Date</label>
                    <input type="text" class="form-control date" name="entries_close_date" autocomplete="off" readonly value="{{$contest->entries_close_date}}" id="entries_close_date" placeholder="Entries Close Date" />
                    @error('entries_close_date')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="contest_live_date">Contest Live Date</label>
                    <input type="text" class="form-control date" name="contest_live_date" autocomplete="off" readonly value="{{$contest->contest_live_date}}" id="contest_live_date" placeholder="Contest Live Date" />
                    @error('contest_live_date')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="contest_close_date">Contest Close Date</label>
                    <input type="text" class="form-control date" id="contest_close_date" autocomplete="off" readonly name="contest_close_date" value="{{$contest->contest_close_date}}"  placeholder="Contest Close Date" />
                    @error('contest_close_date')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                  </div>
                
                  <div class="form-group">
                    <label for="result_announce_date">Result Announce Date</label>
                    <input type="text" class="form-control date" name="result_announce_date" autocomplete="off" readonly value="{{$contest->result_announce_date}}" id="result_announce_date" placeholder="Result Announce Date" />
                    @error('result_announce_date')
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