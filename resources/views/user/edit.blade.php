@extends('layouts.app')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">Edit User</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Edit User </li>
          </ol>
        </nav>
      </div>
      <div class="row ">
        <div class="col-12 grid-margin ">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample" action="{{url('user/update/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div id="profile-container">
                      <img class="" id="profileImage" src="{{asset('assets/images/user/'.$user->img)}}" alt="Upload Image" data-holder-rendered="true" max-height="10px;" max-width="100px;" style="height:100px;width:100px;">
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
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" value="{{$user->name}}" id="name" placeholder="Name" />
                  @error('name')
                  <div class="mt-1">
                    <span class="text-danger">{{$message}}</span>
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" value="{{$user->email}}" name="email" id="email" placeholder="Email" />
                    @error('email')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="phone" class="form-control" name="phone" value="{{$user->phone}}" id="phone" placeholder="Phone" />
                  @error('phone')
                  <div class="mt-1">
                    <span class="text-danger">{{$message}}</span>
                  </div>
                  @enderror
               </div>
               <div class="form-group">
                <label for="location">Location</label>
                <input type="location" class="form-control" value="{{$user->location}}" name="location" id="location" placeholder="Location" />
                @error('location')
                <div class="mt-1">
                  <span class="text-danger">{{$message}}</span>
                </div>
                @enderror
              </div>
              @if (Auth::user()->id != $user->id)
              <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status" style="width: 100%;">
                    <option value="1" @if($user->status == 1) selected @endif>Active</option>
                    <option value="0" @if($user->status == 0) selected @endif>Unactive</option>
                  </select>
              </div>
              @endif
                <button type="submit" class="btn btn-primary mr-2"> Update </button>
                
                </div>
                <div class="col-md-6">
                  {{-- <div class="form-group">
                    <label for="operational_hours">Operational hours</label>
                    <input type="operational_hours" class="form-control" value="{{$user->operational_hours}}" name="operational_hours" id="operational_hours" placeholder="Operational hours" />
                    @error('operational_hours')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                </div> --}}
                {{-- <div class="form-group">
                  <label for="location">Location</label>
                  <input type="location" class="form-control" value="{{$user->location}}" name="location" id="location" placeholder="Location" />
                  @error('location')
                  <div class="mt-1">
                    <span class="text-danger">{{$message}}</span>
                  </div>
                  @enderror
                </div>
                @if (Auth::user()->id != $user->id)
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" name="status" id="status" style="width: 100%;">
                      <option value="1" @if($user->status == 1) selected @endif>Active</option>
                      <option value="0" @if($user->status == 0) selected @endif>Unactive</option>
                    </select>
                </div>
                @endif --}}
                  {{-- <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" name="role" id="role" style="width: 100%;">
                        @foreach ($roles as $role)
                        <option value="{{$role}}">{{$role}}</option>
                        @endforeach
                      </select>
                      @error('role')
                  <div class="mt-1">
                    <span class="text-danger">{{$message}}</span>
                  </div>
                  @enderror
                </div> --}}
                </div>
                </div>
              </form>
              @if (Auth::user()->id == $user->id)
              <form action="{{url('user/update/'.$user->id)}}" method="post">
                @csrf
              <div class="row">
                <div class="col-md-6 mt-5">
                  <h3 class="mb-3">Change Password</h3>
                  <input type="hidden" name="change_pass" value="yes"/>
                  <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" required class="form-control" name="current_password"  id="current_password" placeholder="Current Password" />
                    @error('current_password')
                    <div class="mt-1">
                      <span class="text-danger">{{$message}}</span>
                    </div>
                    @enderror
                        @if(session('error'))
                      <div class="mt-1">
                        <span class="text-danger">{{session('error')}}</span>
                      </div>
                      @endif
                    </div>
                  <div class="form-group">
                  <label for="password">New Password</label>
                  <input type="password" class="form-control" name="password" id="password" required placeholder="New Password" />
                  @error('password')
                  <div class="mt-1">
                    <span class="text-danger">{{$message}}</span>
                  </div>
                  @enderror
           
                  </div>
                  <div class="form-group">
                  <label for="password_confirmation">Confirm New Password</label>
                  <input type="password" class="form-control" name="password_confirmation" required id="password_confirmation" placeholder="Confirm New Password" />
                  @if (session('success'))
                  <div class="mt-1">
                    <span class="text-success">{{session('success')}}</span>
                  </div>
                  @endif
                </div>
                <button type="submit" class="btn btn-primary mr-2"> Update </button>
              </div>
            </div>
          </form>
            @endif
            </div>
            
          </div>
          
        </div>
      </div>
    </div>
  </div>
@endsection