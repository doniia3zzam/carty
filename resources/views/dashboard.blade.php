@include('layouts.header')
@include('layouts.nav')


    @if(Auth::check())
    <div class="col-6 my-5">




        <div class="col-xl-6 col-lg-6">
            <section class="card">
                <div class="twt-feed blue-bg">
                    <div class="corner-ribon black-ribon">
                        <i class="fa fa-twitter"></i>
                    </div>
                    <div class="fa fa-twitter wtt-mark"></div>

                    <div class="media">
                        <a href="#">
                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{$getMostSupp->supplier_photo}}">
                        </a>
                        <div class="media-body">
                            <h2 class="text-white display-6">{{$getMostSupp->supplier_name}}</h2>
                            <p class="text-light">Most effective Seller</p>
                        <p>{{$countofsaled}}</p>
                        </div>
                    </div>
                </div>
                <div class="weather-category twt-category">
                    <ul>
                        <li class="active">
                            <h5>750</h5>
                            Tweets
                        </li>
                        <li>
                            <h5>865</h5>
                            Following
                        </li>
                        <li>
                            <h5>3645</h5>
                            Followers
                        </li>
                    </ul>
                </div>
                <div class="twt-write col-sm-12">
                    <textarea placeholder="Write your Tweet and Enter" rows="1" class="form-control t-text-area"></textarea>
                </div>
                <footer class="twt-footer">
                    <a href="#"><i class="fa fa-camera"></i></a>
                    <a href="#"><i class="fa fa-map-marker"></i></a>
                    New Castle, UK
                    <span class="pull-right">
                        32
                    </span>
                </footer>
            </section>
        </div>



        <div class="col-xl-6 col-lg-6">
            <section class="card">
                <div class="twt-feed blue-bg">
                    <div class="corner-ribon black-ribon">
                        <i class="fa fa-twitter"></i>
                    </div>
                    <div class="fa fa-twitter wtt-mark"></div>

                    <div class="media">
                        <a href="#">
                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{$getSecondSupp->supplier_photo}}">
                        </a>
                        <div class="media-body">
                            <h2 class="text-white display-6">{{$getSecondSupp->supplier_name}}</h2>
                            <p class="text-light"> Second effective Seller</p>
                            <p>{{$countofSecondsaled}}</p>
                        </div>
                    </div>
                </div>
                <div class="weather-category twt-category">
                    <ul>
                        <li class="active">
                            <h5>750</h5>
                            Tweets
                        </li>
                        <li>
                            <h5>865</h5>
                            Following
                        </li>
                        <li>
                            <h5>3645</h5>
                            Followers
                        </li>
                    </ul>
                </div>
                <div class="twt-write col-sm-12">
                    <textarea placeholder="Write your Tweet and Enter" rows="1" class="form-control t-text-area"></textarea>
                </div>
                <footer class="twt-footer">
                    <a href="#"><i class="fa fa-camera"></i></a>
                    <a href="#"><i class="fa fa-map-marker"></i></a>
                    New Castle, UK
                    <span class="pull-right">
                        32
                    </span>
                </footer>
            </section>
        </div>








    </div>
    <div class="col-6 my-5">

        <div class="col-6 mb-2">
            <div class="card text-white bg-flat-color-1">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">

                    </div>
                    <h4 class="mb-0">
                        <span class="count">{{$products}}</span>
                    </h4>
                    <p class="text-light">Products</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart1"></canvas>
                    </div>

                </div>

            </div>
        </div>
        <!--/.col-->

        <div class="col-6  mb-2">
            <div class="card text-white bg-flat-color-2">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">

                    </div>
                    <h4 class="mb-0">
                        <span class="count">{{$orders}}</span>
                    </h4>
                    <p class="text-light">Orders</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <!--/.col-->


        <div class="col-xl-6 col-lg-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-user text-warning border-warning"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Suppliers</div>
                            <div class="stat-digit">{{$suppliers}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Customers</div>
                            <div class="stat-digit">{{$customers}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>






        <div class="col-6 my-2">
            <div class="card text-white bg-flat-color-3">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">

                    </div>
                    <h4 class="mb-0">
                        <span class="count">{{$ordered_products}}</span>
                    </h4>
                    <p class="text-light">High-demand products</p>

                </div>

                <div class="chart-wrapper px-0" style="height:70px;" height="70">
                    <canvas id="widgetChart3"></canvas>
                </div>
            </div>
        </div>
        <!--/.col-->


        <div class="col-6 mt-2">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">

                    </div>
                    <h4 class="mb-0">
                        <span class="count">{{$offers}}</span>
                    </h4>
                    <p class="text-light">Offers</p>

                    <div class="chart-wrapper px-3" style="height:70px;" height="70">
                        <canvas id="widgetChart4"></canvas>
                    </div>

                </div>
            </div>
        </div>




        {{-- SELECT  count(product_id) , product_id
FROM  ordered_products WHERE supplier_id = 1
GROUP BY product_id   --}}



    </div>
    @endif
    @if(!Auth::check())

    <div class="col-12 text-center display-4 my-5"> Most demand Porducts </div>

    @foreach ($mostDemandPro as $pro)
    <div class="col-3 ">
        <div class="card  text-white bg-dark mb-3">
            {{-- <img src="{{url('public/assets/images/products/default.png')}}" class="card-img-top" alt="..."> --}}
            <div class="card-body">
                <p class="card-text text-white"><b> Product ID : </b> {{$pro->product_id}}   </p>
              <p class="card-title text-white"><b>Product: </b> {{$pro->name}}</p>

              <p class="card-text text-white"><b>Details : </b> {!!$pro->detials!!}</p>
              <p class="card-text text-white"><b>Number Of Sales : {{$pro->count_pro}}</b></p>
              {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
        </div>
    </div>
    @endforeach

    @endif



<!--/.col-->





@include('layouts.footer')
