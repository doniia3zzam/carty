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
                                            @foreach ($suppliers as $s )
                                            <div class="card-body">
                                                <div class="card-title">
                                                    <div class="text-center">
                                                        <div class="row d-flex" style="align-items: center">
                                                            <div class="col-7">
                                                                <ul class="list-inline">
                                                                <h3 style="text-transform:capitalize" class="display-4" style="font-size: 3rem">{{ $s->supplier_name }}</h3>
                                                                </ul>
                                                            </div>
                                                            <div class="col-5 ">
                                                                <div class="card text-white upImgP rounded-circle" id="upImgP" >
                                                                    <img src="{{ url('public/assets/images/suppliers/'.$s->supplier_photo) }}" class="card-img upImg rounded-circle" style="height:100%" id="upImg" alt="profile">
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
                                                            <h6>{{ $s->email }}</h6>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group row">
                                                        <div class="col col-md-3">
                                                            <label for="supplier_name" class="control-label mb-1"> Shop Name </label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <h6>{{ $s->shop_name }}</h6>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group row">
                                                        <div class="col col-md-3">
                                                            <label for="supplier_name" class="control-label mb-1"> Open Time </label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <h6>{{ $s->open_time }}</h6>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group row">
                                                        <div class="col col-md-3">
                                                            <label for="supplier_name" class="control-label mb-1"> Close Time </label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <h6>{{ $s->close_time }}</h6>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group row">
                                                        <div class="col col-md-3">
                                                            <label for="supplier_name" class="control-label mb-1"> Details </label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <h6>{!! $s->details !!}</h6>
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

            {{-- address --}}
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            @foreach ($supp_live as $l )
                            <div class="card" style="border-radius: 10px;">
                                <div class="card-header" style=" border-top-left-radius:10px;border-top-right-radius:10px">
                                    <strong class="card-title"> Address</strong>
                                </div>
                                <div class="card-body card-block">
                                    <div class="form-group row">
                                        <div class="col col-md-3">
                                            <label for="supplier_name" class="control-label mb-1"> Phone </label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <h6>{{ $l->supplier_phone }}</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col col-md-3">
                                            <label for="supplier_name" class="control-label mb-1"> City </label>
                                        </div>
                                        @foreach ($city as $c )
                                            @if($c->city_id == $l->city_id)
                                                <div class="col-12 col-md-9">
                                                    <h6>{{ $c->name }}</h6>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>

                                    <div class="form-group row">
                                        <div class="col col-md-3">
                                            <label for="supplier_name" class="control-label mb-1"> Street </label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <h6>{{ $l->supplier_street }}</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col col-md-3">
                                            <label for="supplier_name" class="control-label mb-1"> Area </label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <h6>{{ $l->supplier_area }}</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col col-md-3">
                                            <label for="supplier_name" class="control-label mb-1"> Building No </label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <h6>{{ $l->supplier_bulding_no }}</h6>
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

{{-- ................... --}}
            {{-- <div class="col-lg-6">
                <div class="row">
                @foreach ($supp_live as $l )
                <div class="col-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <strong class="card-title text-light">Addresses</strong>
                    </div>
                    <div class="card-body">

                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered" id="myTable">
                            @foreach($city as $c)
                                @if($c->city_id == $l->city_id)
                                <tr>
                                    <th>City</th>
                                    <td>{{ $c->name }}</td>
                                </tr>
                                @endif
                            @endforeach


                            <tr>
                                <th>Phone</th>
                                <td>{{ $l->supplier_phone }}</td>
                            </tr>
                            <tr>
                                <th>Area</th>
                                <td>{{ $l->supplier_area }}</td>
                            </tr>
                            <tr>
                                <th>Street</th>
                                <td>{{ $l->supplier_street }}</td>
                            </tr>
                            <tr>
                                <th>Building No</th>
                                <td>{{ $l->supplier_bulding_no }}</td>
                            </tr>
                        </table>
                    </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div> --}}

        {{-- </div>
    </div>
</div>
</div> --}}
@include('layouts.footer')
