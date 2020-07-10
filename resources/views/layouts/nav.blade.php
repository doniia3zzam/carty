<!-- Header-->

<header id="header" class="header">

    <div class="header-menu ">

        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left" style="background-color: #f1c40f"> <i class="fa fa fa-tasks"></i></a>
            <div class="header-left">
                <button class="search-trigger"><i class="fa fa-search"></i></button>
                <div class="form-inline">
                    <form class="search-form">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                        <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                    </form>
                </div>

                @if(!Auth::check())

                <div class="dropdown for-notification notior">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        {{-- Session::get('supplier')['supplier_id'] --}}
                        <span> {{\App\Http\Controllers\controller::noti()->count}}</span>
                    </button>

                    <div class="dropdown-menu showNotior"  style="background-color:#ecf0f1;min-width:13rem" aria-labelledby="notification">
                        <p class="red d-block">You have {{\App\Http\Controllers\controller::noti()->count}} Notification</p>
                        @foreach (\App\Http\Controllers\controller::noti()->new_order as $newor)
                        <a class="dropdown-item media bg-flat-color-3" href="{{url('markor/'.$newor->id)}}">
                            <i class="fa fa-check"></i>
                            <p> You Have A new Order  {{ $newor->name }} With Quantity {{ $newor->quantity }} </p>

                        </a>
                        @endforeach

                    </div>

                    <script>
                         $(".notior").click(function () {
                            $('.showNotior').fadeIn();
                            $(".showNotior").on('blur',function () {
                             $('.showNotior').fadeOut();
                            });
                         });
                    </script>
                </div>
                @endif

                @if(Auth::check())
                <div class="dropdown for-notification noti">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>

                        <span class="count bg-primary">{{ auth()->user()->noti()->count }}</span>
                    </button>
                    <div class="dropdown-menu showNoti"  style="background-color:#ecf0f1;min-width:13rem" aria-labelledby="notification">
                        <p class="red d-block">You have {{ count(auth()->user()->noti()->new_supplier) }} Notification</p>
                        @foreach (auth()->user()->noti()->new_supplier as $new)
                        <a class="dropdown-item media bg-flat-color-3" href="{{url('mark/'.$new->id)}}">
                            <i class="fa fa-check"></i>
                            <p>there are new supplier {{ $new->supplier_name }}</p>

                        </a>
                        @endforeach

                    </div>
                </div>
                <script>
                    $(".noti").click(function () {
                        $('.showNoti').fadeIn();
                        $(".showNoti").on('blur',function () {
                         $('.showNoti').fadeOut();
                        });
                     });


                </script>

                @endif

                <div class="dropdown for-message">
                    {{-- @foreach ($new_order as $for)
                        {{$for->order_id}}
                    @endforeach --}}

                </div>
            </div>
        </div>

        <div class="col-sm-5">
            @if(!Auth::check())
            <div class="row align-items-center justify-content-end">
                <div class="col-2  text-right ">
                    <div class="user-area dropdown ">
                        <a href="{{url('supp_profile/'.Session::get('supplier')['supplier_id'].'/edit')}}">
                            <img class="user-avatar rounded-circle" src="{{url(Session::get('supplier')['supplier_photo'])}}" alt="{{Session::get('supplier')['supplier_name']}}">
                        </a>
                    </div>
                </div>
                <div class="col-5 ">
                    <div class="dropdownG">

                        <a class="dropbtnG" href="{{url('supp_profile/'.Session::get('supplier')['supplier_id'].'/edit')}}">
                                {{Session::get('supplier')['supplier_name']}} <span class="fa fa-angle-down"></span>
                            </a>
                        <div class="dropdown-contentG">
                            <a href="{{url('out')}}"> Logout </a>
                        </div>
                    </div>
                </div>

            </div>

            @endif

            <div>

                @if(Auth::check())

                <div class="row align-items-center justify-content-end">
                    <div class="col-2  text-right ">
                        <div class="user-area dropdown ">
                            <a href="{{url('adminProfile/'.Auth::user()->id)}}">
                                    <img class="user-avatar rounded-circle" src="{{url(Auth::user()->admin_photo)}}" alt="{{ Auth::user()->name }}">
                                </a>
                        </div>
                    </div>
                    <div class="col-5 ">
                        <div class="dropdownG">

                            <a class="dropbtnG" href="{{url('adminProfile/'.Auth::user()->id)}}">
                                    {{ Auth::user()->name }} <span class="fa fa-angle-down"></span>
                                </a>
                            <div class="dropdown-contentG">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     {{ __('Logout') }}
                                 </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>

                    @endif
                </div>

            </div>
        </div>

</header>
<!-- /header -->
<!-- Header-->

{{-- <div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div> --}}
