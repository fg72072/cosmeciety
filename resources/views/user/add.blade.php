@extends('layouts.app')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Add User</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Add User </li>
                    </ol>
                </nav>
            </div>
            <div class="row ">
                <div class="col-12 grid-margin ">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" action="{{ route('user.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div id="profile-container">
                                                <img class="" id="profileImage" src="" alt="Upload Image"
                                                    data-holder-rendered="true" max-height="10px;" max-width="100px;"
                                                    style="height:100px;width:100px;">
                                            </div>
                                            <br>
                                            <input id="imageUpload" type="file" name="image" placeholder="Photo" capture=""
                                                value="">
                                            @error('image')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Name" />
                                            @error('name')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" />
                                            @error('email')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="phone" class="form-control" name="phone" id="phone"
                                                placeholder="Phone" />
                                            @error('phone')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password" />
                                            @error('password')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="password_confirmation" placeholder="Confirm Password" />
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2"> Publish </button>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- <div class="form-group">
                                            <label for="operational_hours">Operational hours</label>
                                            <input type="operational_hours" class="form-control" min="1" name="operational_hours" id="operational_hours" placeholder="Operational hours" />
                                            @error('operational_hours')
                                            <div class="mt-1">
                                              <span class="text-danger">{{$message}}</span>
                                            </div>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <input type="location" class="form-control" min="1" name="location"
                                                id="location" placeholder="Location" />
                                            @error('location')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select class="form-control" name="role" id="role" style="width: 100%;">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role }}">{{ $role }}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <div class="mt-1">
                                                    <span class="text-danger">{{ $message }}</span>
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
