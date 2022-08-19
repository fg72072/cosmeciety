
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
    <link rel="stylesheet" href="{{asset('assets/css/phoneinput.css')}}" />
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
                       <form class="forms-sample" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div id="profile-container">
                                <img class="radius-50" id="profileImage" src="{{asset('assets/images/avatar.png')}}" alt="Upload Image"
                                    data-holder-rendered="true" max-height="10px;" max-width="100px;"
                                    style="height:100px;width:100px;">
                            </div>
                            <br>
                            <input id="imageUpload" required type="file" name="avatar"  placeholder="Photo" capture=""
                                value="">
                            @error('avatar')
                                <div class="mt-1">
                                <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{-- <label for="name">Name</label> --}}
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required id="name" placeholder="Name" />
                            @error('name')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror 
                         </div>
                         <div class="form-group">
                           {{-- <label for="exampleInputEmail1">Email address</label> --}}
                           <input type="email" class="form-control" name="email" value="{{ old('email') }}" required id="exampleInputEmail1" placeholder="Email" />
                           @error('email')
                           <span class="invalid-feedback">
                               <strong>{{ $message }}</strong>
                           </span>
                        @enderror 
                        </div>
                        <div class="form-group">
                            {{-- <label for="phone">Phone</label> --}}
                            <input type="text" class="form-control phone-number w-100" name="phone" value="{{ old('phone') ?? '+92' }}" required id="myphone"/>
                            @error('phone')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror 
                         <span id="valid-msg" class="hide"></span>
                         <!-- <span id="valid-msg" class="hide">✓ Valid</span> -->
                        <span id="error-msg" class="hide invalid-feedback"></span>
                         </div>
                         <div class="form-group">
                           {{-- <label for="exampleInputPassword1">Password</label> --}}
                           <input type="password" class="form-control" id="exampleInputPassword1" name="password" required  autocomplete="current-password" placeholder="Password" />
                           @error('password')
                               <span class="invalid-feedback">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                         </div>
                         <div class="form-group">
                            {{-- <label for="password_confirmation">Confirm Password</label> --}}
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="password_confirmation" placeholder="Confirm Password" />
                          </div>
                         {{-- <div class="form-check form-check-flat form-check-primary">
                           <label class="form-check-label">
                             <input type="checkbox" class="form-check-input" /> Remember me </label>
                         </div> --}}
                         <button type="submit" class="btn btn-primary mr-2"> Register </button>
                                    <a class="btn btn-link" href="{{ url('login') }}">
                                        Already have an account?
                                    </a>
                       </form>
                     </div>
                   </div>
                 </div>
          </div>
      </div>
      <div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Success</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="msg_success">
                {!! session('msg_success') !!}
                </h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
            </div>
        </div>
        </div>
    @include('includes.footer')
    <script src="{{asset('assets/js/phoneinput.js')}}"></script>
    <script>
        $(document).ready(function(){
        var utilscript = "{{asset('assets/js/utils.js')}}",
        errorMsg = document.querySelector("#error-msg"),
        validMsg = document.querySelector("#valid-msg");
        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
        var input = document.querySelector("#myphone");
        var iti = window.intlTelInput(input, {
            utilsScript: utilscript
        });
            var reset = function() {
                input.classList.remove("error");
                errorMsg.innerHTML = "";
                errorMsg.classList.add("hide");
                validMsg.classList.add("hide");
            };

            // on blur: validate
            input.addEventListener('blur', function() {
            reset();
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                validMsg.classList.remove("hide");
                } else {
                input.classList.add("error");
                var errorCode = iti.getValidationError() == '-99' ? 2 : iti.getValidationError();
                console.log(errorCode)
                errorMsg.innerHTML = errorMap[errorCode];
                errorMsg.classList.remove("hide");
                }
            }
            });

            // on keyup / change flag: reset
            input.addEventListener('change', reset);
            input.addEventListener('keyup', reset);
        })
    </script>
    @if(session('msg_success'))
    <script>
        $(document).ready(function(){
            $("#success").modal("show")
        })
    </script>
    @endif
</body>
</html>
