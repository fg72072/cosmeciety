{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

 --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Cosmeciety</title>
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendors/select2/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/datatable.css')}}" />
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />
</head>

<body>
      <div class="custom-form-layout">
        <div class="row w-100">
            <div class="custom-form-width m-auto grid-margin stretch-card">
                   <div class="card card-height-custom">
                     <div class="card-body">
                       {{-- <p class="card-description">Basic form layout</p> --}}
                       <div class="text-center">
                           <img src="{{asset('assets/images/logo.png')}}"/>
                       </div>
                       <form class="forms-sample" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                         <div class="form-group">
                           <label for="exampleInputEmail1">Email address</label>
                           <input type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" id="exampleInputEmail1" placeholder="Email" />
                           @error('email')
                           <span class="invalid-feedback">
                               <strong>{{ $message }}</strong>
                           </span>
                            @enderror 
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password"  id="password" placeholder="Password" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                         </div>
                         <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation"  id="password-confirm" placeholder="Confirm Password" />
                         </div>
                         <button type="submit" class="btn btn-primary mr-2"> Reset Password </button>
                       </form>
                     </div>
                   </div>
                 </div>
          </div>
      </div>
    @include('includes.footer')
</body>
</html>
