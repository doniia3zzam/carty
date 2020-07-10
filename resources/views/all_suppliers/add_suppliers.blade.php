
@include('layouts.header')
@include('layouts.nav')

@if(Session::has('success'))
<div class="alert alert-success h6 text-center">
{{ Session::get('success') }}
</div>
@php
session::forget('success') ;
@endphp
@endif

<form action="{{url('supplier')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
    @csrf

    <div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Supplier Form</strong>
        </div>
        <div class="card-body">

            <div id="pay-invoice">
                <div class="card-body">
                    <div class="container" id="clik">
                        <img src="{{url('public/assets/images/suppliers/default.jpg') }}" alt="Profile" id="img" class="image imgphoto @error('supplier_photo') is-invalid  @enderror">
                        <div class="overlay d-flex">
                          <div class="text divicon">
                              <hr>
                              <i class="fa fa-camera icon" ></i>
                              <input class="file" type="file" name="supplier_photo" id="imgin" style="display:none" onchange="showPhoto()">
                              @error('supplier_photo')
                                    <p class="text-danger">{{ $errors->first('supplier_photo') }}</p>
                                 @enderror
                            </div>
                        </div>
                      </div>
                      <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input name="supplier_name"  type="text"
                                class="form-control @error('supplier_name') is-invalid  @enderror" placeholder="Name"
                                value="{{old('supplier_name')}}">
                                    @error('supplier_name')
                                    <p class="text-danger">{{ $errors->first('supplier_name') }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="control-label mb-1">Email</label>
                                    <input name="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="email"
                                value="{{old('email')}}">
                                    @error('email')
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label mb-1">Password</label>
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                    @error('password')
                                    <p class="text-danger">{{$errors->first('password')}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label mb-1">Confirm Password</label>
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                    @error('password')
                                <p class="text-danger">{{$errors->first('password')}}</p>
                                @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="control-label mb-1">Shop Name</label>
                                    <input name="shop_name" type="text"
                                class="form-control @error('shop_name') is-invalid @enderror" placeholder="Shop Name"
                                value="{{old('shop_name')}}">
                                @error('shop_name')
                                <p class="text-danger">{{$errors->first('shop_name')}}</p>
                                @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Open Time</label>
                                    <input  name="open_time" type="time" class="form-control @error('open_time') is-invalid @enderror" data-val="true" data-val-required="Please enter the open time"
                                value="{{old('open_time')}}">
                                @error('open_time')
                                <p class="text-danger">{{$errors->first('open_time')}}</p>
                                @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label  class="control-label mb-1">Close Time</label>
                                    <input  name="close_time" type="time" class="form-control @error('close_time') is-invalid @enderror" data-val="true" data-val-required="Please enter the close time"
                                value="{{old('close_time')}}">
                                @error('close_time')
                                <p class="text-danger">{{$errors->first('close_time')}}</p>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="" id="add_more">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input name="supplier_phone" type="tel" class="form-control @error('supplier_phone') is-invalid @enderror" placeholder="Phone"
                                    value="{{old('supplier_phone')}}">
                                    @error('supplier_phone')
                                    <p class="text-danger">{{$errors->first('supplier_phone')}}</p>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Street</label>
                                        <input  name="supplier_street" type="text" class="form-control @error('supplier_street') is-invalid @enderror"  placeholder="Street"
                                    value="{{old('supplier_street')}}">
                                    @error('supplier_street')
                                    <p class="text-danger">{{$errors->first('supplier_street')}}</p>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="control-label mb-1">City</label>
                                            <select name="city_id" class="form-control @error('city_id') is-invalid @enderror">
                                                {{-- <option value="">Select City</option> --}}
                                                @foreach ($city as $c )
                                                <option value="{{$c->city_id}}" {{old('city_id') == $c->city_id ? 'selected' : ''}} >{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                            <p class="text-danger">{{$errors->first('city_id')}}</p>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Area</label>
                                        <input name="supplier_area" type="text" class="form-control @error('supplier_area') is-invalid @enderror" placeholder="area"
                                    value="{{old('supplier_area')}}">
                                    @error('supplier_area')
                                            <p class="text-danger">{{$errors->first('supplier_area')}}</p>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Building No</label>
                                        <input name="supplier_bulding_no" type="number" class="form-control @error('supplier_bulding_no') is-invalid @enderror" placeholder="Building No"
                                    value="{{old('supplier_bulding_no')}}">
                                    @error('supplier_bulding_no')
                                    <p class="text-danger">{{$errors->first('supplier_bulding_no')}}</p>
                                    @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label  class="control-label mb-1">Details</label>
                                    <textarea name="details"  cols="85" rows="4" class="@error('details') is-invalid @enderror">{{old('details')}}</textarea>
                                    @error('details')
                                    <p class="text-danger">{{$errors->first('details')}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                            <div>
                                <button type="submit" class="btn btn-lg btn-primary btn-block">
                                    Submit
                                </button>
                            </div>

                </div>
            </div>

        </div>
    </div> <!-- .card -->
</form>
</div>

@include('layouts.footer')


    <script>

         // supplier upload photo function
    document.getElementById("clik").addEventListener("click", function(){
        document.getElementById("imgin").click();
      });
      function showPhoto() {
        var file = document.getElementById('imgin').files[0];
        console.log(file);
        reader = new FileReader();
        // console.log(reader);
        reader.onloadend = function () {
            document.getElementById('img').setAttribute("src",reader.result);
            // console.log(reader.result);
        };
        reader.readAsDataURL(file);
    }

    </script>

