<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Carty Admin</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('public/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('public/vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url('public/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{url('public/vendors/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{url('public/vendors/jqvmap/dist/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{url('public/assets/css/userSide.css')}}">
    <link rel="stylesheet" href="{{url('public/assets/css/style.css')}}">
    <!-- our style file  -->

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->

    {{-- country select button --}}
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{url('public/assets/build/css/countrySelect.css')}}">
    <script src="{{url('public/assets/build/js/countrySelect.js')}}"></script>

    {{-- text area Js --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',

            // menubar:false
        });
    </script>

    <link rel="stylesheet" href="{{url('public/assets/css/galal.css')}}">

</head>

<body class="bg-dark">
    <div id="right-panel" class="right-panel">

        <div class="sufee-login d-flex align-content-center flex-wrap">
            <div class="container">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="index.html">
                            <img class="align-content" src="{{url('public/assets/images/logo/5.png')}}" alt="">
                        </a>
                    </div>
                    <div class="login-form">
                    <form method="POST" action="{{url('updatepass')}}" id='login' style="{{Session::has('noMail') ? 'display:none' : ''}} @error('emailforget') display:none  @enderror">
                        @method('PUT')
                        @csrf
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control  @error('password') is-invalid  @enderror  {{Session::has('noUser') ? 'is-invalid' : '' }}"  name="password" value="{{Session::has('noUser') ? Session::get('noUser')['password'] : old('password') }}">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control  @error('password') is-invalid  @enderror  {{Session::has('noUser') ? 'is-invalid' : '' }}"  name="password_confirmation" value="{{Session::has('noUser') ? Session::get('noUser')['password'] : old('password') }}">
                            </div>
                            @if($errors->has('password'))
                                <p class='text-danger'>{{$errors->first('password')}}</p>
                            @endif
                            <input type="hidden" name="supplier_id" value="{{$supplier_id}}">
                            <button type="submit" class="btn btn-warning btn-flat m-b-30 m-t-30">Change</button>
                    </form>

                    <script>

                    </script>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
