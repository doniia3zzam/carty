@include('layouts.header')
@include('layouts.nav')
<div class="container-fluid">
<div class="content mt-3" >
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="border-radius: 10px;">
                                <div class="card-header" style="border-top-left-radius:10px;border-top-right-radius:10px">
                                    <strong class="card-title"> Profile </strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        @foreach ($customer as $cust )
                                        <div class="card-body">
                                            <div class="card-title">
                                                <div class="text-center">
                                                    <div class="row d-flex" style="align-items: center">
                                                        <div class="col-6">
                                                            <ul class="list-inline">
                                                            <h3 style="text-transform:capitalize" class="display-4" style="font-size: 3rem">{{$cust->first_name}} {{$cust->last_name}}</h3>
                                                            </ul>
                                                        </div>
                                                        <div class="col-6 ">
                                                            <div class="card text-white upImgP rounded-circle" id="upImgP" >
                                                                <img src="{{url('public/assets/images/customer/'.$cust->photo_name)}}" class="card-img upImg rounded-circle" style="height:100%" id="upImg" alt="profile">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                                <div class="form-group row">
                                                    <div class="col col-md-3">
                                                        <label for="supplier_name" class="control-label mb-1"> Email </label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <h6>{{$cust->email}}</h6>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col col-md-3">
                                                        <label for="supplier_name" class="control-label mb-1"> Credit card </label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <h6>{{$cust->credit_card}}</h6>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <div class="col col-md-3">
                                                        <label for="supplier_name" class="control-label mb-1"> Date </label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <h6>{{$cust->cust_reg_date}}</h6>
                                                    </div>
                                                </div>

                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

                <!--/.col-->

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-12">

                                @foreach ($address as $addr)

                                <div class="card" style="border-radius: 10px;">
                                <div class="card-header" style=" border-top-left-radius:10px;border-top-right-radius:10px">
                                    <div class="row">
                                        <strong class="card-title"> More Data</strong>
                                        <label class="ml-auto"># {{$addr->addressStatus}}</label>
                                    </div>
                                </div>
                                <div class="card-body card-block">
                                    <div class="form-group row">
                                        <div class="col col-md-3">
                                            <label for="supplier_name" class="control-label mb-1"> Phone </label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <h6>{{$addr->phone}}</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col col-md-3">
                                            <label for="supplier_name" class="control-label mb-1"> City </label>
                                        </div>
                                        @foreach ($city as $c )
                                            @if($c->city_id == $addr->city_id)
                                                <div class="col-12 col-md-9">
                                                    <h6>{{ $c->name }}</h6>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col col-md-3">
                                            <label for="supplier_name" class="control-label mb-1"> Address Type </label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <h6>{{$addr->addressType}}</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col col-md-3">
                                            <label for="supplier_name" class="control-label mb-1"> Address </label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <h6>{{$addr->customerAddress}}</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col col-md-3">
                                            <label for="supplier_name" class="control-label mb-1"> Area </label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <h6>{{$addr->area}}</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col col-md-3">
                                            <label for="supplier_name" class="control-label mb-1"> Building No </label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <h6>{{$addr->buildingNo}}</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col col-md-3">
                                            <label for="supplier_name" class="control-label mb-1"> Floor No </label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <h6>{{$addr->floorNo}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endforeach

                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>

@include('layouts.footer')


