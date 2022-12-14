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
                   <div class="card">
                     <div class="card-body">
                       {{-- <p class="card-description">Basic form layout</p> --}}
                       <div class="text-center">
                           <img src="{{asset('assets/images/logo.png')}}"/>
                       </div>
                       <form class="forms-sample" method="POST" action="{{ route('login') }}">
                        @csrf
                         <div class="form-group">
                           <label for="exampleInputEmail1">Email address</label>
                           <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="exampleInputEmail1" required placeholder="Email" />
                           @error('email')
                           <span class="invalid-feedback">
                               <strong>{{ $message }}</strong>
                           </span>
                          @enderror 
                          @if(session('error'))
                          <span class="invalid-feedback">
                            <strong>{{session('error') }}</strong>
                          </span>
                          @endif
                        </div>
                         <div class="form-group">
                           <label for="exampleInputPassword1">Password</label>
                           <input type="password" class="form-control" id="exampleInputPassword1" name="password" required autocomplete="current-password" placeholder="Password" />
                           @error('password')
                               <span class="invalid-feedback">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                         </div>
                          <div class="mb-3 form-check form-check-flat form-check-primary">
                           <label class="form-check-label">
                             <input name="remember" id="remember" type="checkbox" class="form-check-input" /> Remember me </label>
                         </div>
                         <div class="form-group">
                           
                           
                           </div>
                           <button type="submit" class="btn btn-primary mr-2"> Login </button>
                           <a href="{{url('register')}}" class="btn btn-link mr-2"> Register </a>
                           @if (Route::has('password.request'))
                           <a class="btn btn-link" href="{{ route('password.request') }}">
                             {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                              
                       </form>
                     </div>
                   </div>
                 </div>
          </div>
      </div>
    @include('includes.footer')
</body>
</html>
