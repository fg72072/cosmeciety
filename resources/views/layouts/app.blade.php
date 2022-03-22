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
    <div class="container-scroller main-container-div">
        @include('includes.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('includes.header')
        @yield('content')
      </div>

    </div>
    @include('includes.footer')
</body>
</html>
