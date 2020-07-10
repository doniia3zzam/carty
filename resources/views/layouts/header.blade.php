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
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    {{-- country select button  --}}
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{url('public/assets/build/css/countrySelect.css')}}">
    <script src="{{url('public/assets/build/js/countrySelect.js')}}"></script>


    {{-- text area Js  --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>

        tinymce.init({
            selector:'textarea',

            // menubar:false
        });

    </script>
    {{-- screenshot invoice --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>

    <link rel="stylesheet" href="{{url('public/assets/css/galal.css')}}">

</head>


<body>




    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                @if(!Auth::check())
                <a class="navbar-brand" href="{{url('dash')}}"><img src="{{url('public/assets/images/logo/5.png')}}" alt="Logo"></a>
                <a class="navbar-brand hidden" href="{{url('dash')}}"><img src="{{url('public/assets/images/logo/5.png')}}" alt="Logo"></a>
                @endif
                @if(Auth::check())
                <a class="navbar-brand" href="{{url('home')}}"><img src="{{url('public/assets/images/logo/5.png')}}" alt="Logo"></a>
                <a class="navbar-brand hidden" href="{{url('home')}}"><img src="{{url('public/assets/images/logo/5.png')}}" alt="Logo"></a>
                @endif
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                {{-- @if(!(Session::has('supplier')))    --}}
                    <h3 class="menu-title">Elements</h3><!-- /.menu-title -->
                    <li>
                        <a href="{{url('customer')}}"> <i class="menu-icon ti-user"></i> All Customers </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Products</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-building-o"></i><a href="{{url('/product')}}">All Products</a></li>
                        </ul>
                    </li>
                    {{-- <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Products</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-building-o"></i><a href="ui-buttons.html">All Products</a></li>
                            <li><i class="fa fa-plus"></i><a href="ui-badges.html">Add New Product</a></li>
                        </ul>
                    </li> --}}
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Suppliers</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-user"></i><a href="{{url('supplier')}}">All Suppliers</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{url('supplier/create')}}">Add New Supplier</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Offers</a>
                        <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-building-o"></i><a href="{{url('offer')}}">All offers</a></li>
                        <li><i class="fa fa-plus"></i><a href="{{url('offer/create')}}">Add New offer</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Orders</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-location-arrow"></i><a href="{{url('/order')}}">Pending Orders</a></li>
                            <li><i class="fa fa-check"></i><a href="{{url('order/create')}}">Sent Orders</a></li>
                        </ul>
                    </li>

                    <h3 class="menu-title">Elements</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Categories</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-building-o"></i><a href="{{url('category')}}">All Categories</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{url('category/create')}}">Add New Category</a></li>
                        </ul>
                    </li>


                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Sub Categories</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-building-o"></i><a href="{{url('sub_category')}}">>All Sub Cate</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{url('sub_category/create')}}">Add New Sub Cate</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Brands</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-building-o"></i><a href="{{url('brand')}}">All Brands</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{url('brand/create')}}">Add New Brand</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Models</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-building-o"></i><a href="{{url('model')}}">All Models</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{url('model/create')}}">Add New Model</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Cities</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-building-o"></i><a href="{{url('city')}}">All Cities</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{url('city/create')}}">Add New City</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Payments</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-money"></i><a href="{{url('payment')}}">All Payments</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{url('payment/create')}}">Add New Payment</a></li>
                        </ul>
                    </li>
                    <h3 class="menu-title">Elements</h3><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Admins</a>
                        <ul class="sub-menu children dropdown-menu">
                            {{-- <li><i class="ti-user"></i><a href="{{url('adminProfile/'.Auth::user()->id)}}">My profile</a></li> --}}
                            <li><i class="fa fa-user"></i><a href="{{url('admon')}}">All Admins</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{ route('register') }}">Add New admin</a></li>
                        </ul>
                    </li>
                    {{-- <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i>Permissions</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-building-o"></i><a href="ui-buttons.html">All Permissions</a></li>
                            <li><i class="fa fa-plus"></i><a href="ui-badges.html">Add New Permission</a></li>
                        </ul>
                    </li> --}}
                @endif
                {{-- @endif --}}
                @if(!Auth::check())
                    <h3 class="menu-title">Supplier Admin</h3><!-- /.menu-title -->
                    {{-- <li>
                        <a href="{{url('supp_profile/1/edit')}}"> <i class="menu-icon ti-user"></i> My Profile </a>
                    </li> --}}
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bars"></i> My Products</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-building-o"></i><a href="{{url('supp_product/'.Session::get('supplier')['supplier_id'])}}">All products</a></li>
                            <li><i class="fa fa-plus"></i><a href="{{url('supp_product')}}">Add New product</a></li>
                            <!-- <li><i class="fa-location-arrow"></i><a href="ui-buttons.html">All Orders</a></li> -->
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon  ti-email"></i> My Orders </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-calendar-o"></i><a href="{{url('Porders/'.Session::get('supplier')['supplier_id'])}}">Pending Orders</a></li>
                            <li><i class="fa fa-location-arrow"></i><a href="{{url('Dorders/'.Session::get('supplier')['supplier_id'])}}">Delivered Orders</a></li>
                            <li><i class="fa fa-minus-circle"></i><a href="{{url('ACorders/'.Session::get('supplier')['supplier_id'])}}">Cancelled Orders</a></li>
                        </ul>
                    </li>
                @endif



                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

     <!-- Right Panel -->
<div id="right-panel" class="right-panel">



