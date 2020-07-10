@include('layouts.header') @include('layouts.nav')

<div class="content mt-3">
    <div class="animated fadeIn">
        <form method="POST" action="{{url('supp_profile')}}">
        @csrf
        <div class="row">
            <!--/.col-->

            <div class="col-lg-7">
                <div class="row">

                    <div class="col-12">
                        <div class="card">

                            <div class="card-header"><strong>Suppliers</strong><small> Adresses</small>
                            </div>
                            <div class="card-body card-block">
                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="select" class=" form-control-label"> City </label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <select name="city_id" id="select" class="form-control @error('city_id') is-invalid @enderror">
                                            @foreach($cities as $city)
                                            <option value="{{$city->city_id}}" {{ Session::has('faliedNo') ? Session::get('faliedNo')['city_id'] == $city->city_id ? 'selected' : ' '  : old('city_id') }}>{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col col-md-1">
                                        <label for="select" class=" form-control-label"> Phone </label>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text"  class="form-control @error('supplier_phone') is-invalid @enderror {{Session::has('faliedNo') ? 'is-invalid' : '' }}" id="vat" name="supplier_phone" value="{{Session::has('faliedNo') ? Session::get('faliedNo')['supplier_phone'] : old('supplier_phone') }}" placeholder=" Enter phone number">
                                        @if($errors->has('supplier_phone'))
                                            <p class='text-danger'>{{$errors->first('supplier_phone')}}</p>
                                         @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                <div class="col col-md-2">
                                    <label for="street" class=" form-control-label"> Street</label>
                                </div>
                                <div class="col-12 col-md-10">
                                    <input type="text"  class="form-control @error('supplier_street') is-invalid @enderror" id="street" name="supplier_street" value="{{Session::has('faliedNo') ? Session::get('faliedNo')['supplier_street'] : old('supplier_street') }}" placeholder=" Enter street name">
                                    @if($errors->has('supplier_street'))
                                        <p class='text-danger'>{{$errors->first('supplier_street')}}</p>
                                    @endif
                                </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-2">
                                        <label for="city" class=" form-control-label"> Area </label>
                                    </div>
                                    <div class="col-10">
                                        <input type="text"  class="form-control @error('supplier_area') is-invalid @enderror" name="supplier_area" id="city"  value="{{Session::has('faliedNo') ? Session::get('faliedNo')['supplier_area'] : old('supplier_area') }}" placeholder=" Enter Supplier Area">
                                        @if($errors->has('supplier_area'))
                                            <p class='text-danger'>{{$errors->first('supplier_area')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-2">
                                        <label for="city" class=" form-control-label">Bulding No</label>
                                    </div>
                                    <div class="col-10">
                                        <input type="num" class="form-control @error('supplier_bulding_no') is-invalid @enderror" id="city" name="supplier_bulding_no" value="{{Session::has('faliedNo') ? Session::get('faliedNo')['supplier_bulding_no'] : old('supplier_bulding_no') }}" placeholder=" Enter Supplier Area" >
                                        @if($errors->has('supplier_bulding_no'))
                                            <p class='text-danger'>{{$errors->first('supplier_bulding_no')}}</p>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            
                        </div>

                    </div>
                </div>
                <div class="col-2">
                    <input type="submit" class="btn btn-success" value="Add Adress">
                </div>
            </div>
            @if(Session::has('success'))
            <div class="col-lg-5">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p>{{Session::get('success')}}, this important To know , You must adhere to the terms and conditions and add at least 200 products to each of your branches and not to reach the minimum level of product evaluation.</p>
                    <hr>
                    <h6 class="mb-0">With Regards from the CARTY administration.</h6>
                </div>
            </div>
            @php
                Session::forget('success');
            @endphp
            @endif

            @if(Session::has('faliedNo'))
            <div class="col-lg-5">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">The phone Number is Already Exist</h4>
                    <hr>
                    <h6 class="mb-0">Please check the phone number you entered.</h6>
                </div>
            </div>
            @php
                Session::forget('faliedNo');
            @endphp
            @endif

        </div>

    </div>
    </form>
</div>
</div>

@include('layouts.footer')


