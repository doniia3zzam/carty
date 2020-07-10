    @include('layouts.header') @include('layouts.nav')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title"> Profile </strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <div class="text-center">
                                                    
                                                    @if(count($errors) > 0)
                                                    <ul class="text-left d-block alert alert-danger">
                                                    @foreach ($errors->all() as $err)
                                                        <li class='text-dark'>{{$err}}</li>
                                                    @endforeach
                                                    </ul>
                                                    @endif
                                                    
                                                    @if(Session::has('ChangePass'))
                                                    <div class="alert alert-success ">{{Session::get('ChangePass')}}</div>
                                                    @php Session::forget('ChangePass'); @endphp @endif

                                                    @if(Session::has('WrongPass'))
                                                    <div class="alert alert-danger text-center ">{{Session::get('WrongPass')}}</div>
                                                    @php Session::forget('WrongPass'); @endphp @endif

                                                    <hr class="col-11">
                                                    <div class="row d-flex" style="align-items: center">
                                                        
                                                        <div class="col-4">
                                                            <ul class="list-inline">
                                                                <br>
                                                                <h6><p id="changePassword">Change password ?</p></h6>
                                                            </ul>
                                                        </div>
                                                       
                                                        <br class="changePass">
                                                        
                                                        <br class="changePass">
                                                        <div class="col-8 changePass" id="passwordInputsCont">
                                                            <form action="{{url('changePass')}}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="password" name="password" class="form-control my-2 @error('password') is-invalid @enderror" id="oldPass" placeholder="Old Password" autofocus>
                                                                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="newPass" placeholder="New Password">
                                                                <input type="password" name="password_confirmation" class="form-control  my-2  @error('password_confirmation') is-invalid @enderror" id="confPass" placeholder="Confirm Password">
                                                                <input type="hidden" name="supplier_id" value="{{$profile->supplier_id}}">
                                                                <button type="submit" class="btn btn-primary rounded  my-2"> <i class=" fa fa-lock"></i>&nbsp; Change </button>
                                                                <script>
                                                                    @if($errors->has('password_confirmation'))
                                                                     $('.changePass').fadeIn(function() {
                                                                        $('#passwordInputsCont').animate({
                                                                        });
                                                                    });
                                                                    @elseif($errors->has('new_password'))
                                                                     $('.changePass').fadeIn(function() {
                                                                        $('#passwordInputsCont').animate({
                                                                        });
                                                                    });
                                                                    @elseif($errors->has('password'))
                                                                     $('.changePass').fadeIn(function() {
                                                                        $('#passwordInputsCont').animate({
                                                                        });
                                                                    });
                                                                    @elseif(Session::has('WrongPass'))
                                                                    $('.changePass').fadeIn(function() {
                                                                        $('#passwordInputsCont').animate({
                                                                        });
                                                                    });
                                                                    @php Session::forget('WrongPass'); @endphp
                                                                    @endif


                                                                    $(document).ready(function() {
                                                                        var i = 0;
                                                                        $('#changePassword').click(function() {
                                                                            if ( i % 2 == 0 ){
                                                                            $('.changePass').fadeIn(function() {
                                                                                $('#passwordInputsCont').animate({
                                                                                    // left: '100px'
                                                                                });
                                                                            });
                                                                        }else{
                                                                                $('#passwordInputsCont').animate({
                                                                                    // left: '0px'
                                                                                },400,function () { 
                                                                                    $('.changePass').fadeOut();
                                                                                });
                                                                            
                                                                        }
                                                                        i++;
                                                                        });
                                                                        
                                                                    });
                                                                    



                                                                </script>  
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <form method="POST" action="{{url('supp_profile/'.Session::get('supplier')['supplier_id'])}}" enctype="multipart/form-data">
                                                @method('PUT') @csrf
                                                <div class="form-group text-center">
                                                    @if(Session::has('success'))
                                                    <div class="alert alert-success">{{Session::get('success')}}</div>
                                                    @php Session::forget('success'); @endphp @endif
                                                    
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <h3 style="text-transform:capitalize" class="display-4" style="font-size: 3rem">{{$profile->supplier_name}}</h3>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="card bg-dark text-white upImgP" id="upImgP" style="position: relative">
                                                                <img src="{{url($profile->supplier_photo)}}" class="card-img upImg" id="upImg" alt="...">
                                                                <div class="card-img-overlay d-flex " style="border-bottom-left-radius: 190px;border-bottom-right-radius: 190px;height: 85px;position: absolute;top: 85px;">
                                                                    <i class="fa fa-camera upImgCa"></i>
                                                                    <input type="file" name="supplier_photo" id="upImgIn" onchange="showPhoto()" style="display:none;" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="supplier_name" class="control-label mb-1"> Supplier </label>
                                                    <input name="supplier_name" id="supplier_name" type="text" value="{{$profile->supplier_name}}" class="form-control" aria-required="true" aria-invalid="false" value="" disabled> 
                                                    @if($errors->has('supplier_name'))
                                                    <p class='text-danger'>{{$errors->first('supplier_name')}}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="shop_name" class="control-label mb-1"> Shop Name </label>
                                                    <input name="shop_name" id="shop_name" type="text" value="{{$profile->shop_name}}" class="form-control" aria-required="true" aria-invalid="false" value="" disabled> 
                                                    @if($errors->has('shop_name'))
                                                    <p class='text-danger'>{{$errors->first('shop_name')}}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group has-success">
                                                    <label for="email" class="control-label mb-1"> Email </label>
                                                    <input name="email" id="email" type="email" value="{{$profile->email}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" disabled>
                                                    <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span> 
                                                    @if($errors->has('email'))
                                                    <p class='text-danger'>{{$errors->first('email')}}</p>
                                                    @endif
                                                </div>
                                                <div class=" form-group">
                                                    <textarea name="details" id="details" rows="6" placeholder="Content..." class="form-control" disabled>{{$profile->details}}</textarea>
                                                    @if($errors->has('details'))
                                                    <p class='text-danger'>{{$errors->first('details')}}</p>
                                                    @endif
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-2">
                                                        <label for="file-input" class=" form-control-label">Open Time</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="time" id="close_time" class="time" name="close_time" value="{{$profile->open_time}}" disabled/> @if($errors->has('close_time'))
                                                        <p class='text-danger'>{{$errors->first('close_time')}}</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="file-input" class=" form-control-label">Close Time</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="time" id="open_time" class="time" name="open_time" value="{{$profile->open_time}}" disabled/> @if($errors->has('open_time'))
                                                        <p class='text-danger'>{{$errors->first('open_time')}}</p>
                                                        @endif
                                                    </div>

                                                </div>
                                                <br>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div id="updateInfoEdit" class="btn btn-success rounded"> <i class="fa fa-edit fa-lg"> </i> </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button id="updateInfoSave" type="submit" class="btn btn-primary rounded form-control" style="display:none"> <i class="fa fa-check fa-lg"> </i> Save </button>
                                                    </div>
                                                    <div class="col-md-3 offset-4">
                                                        <div id="updateInfoCancel" class="btn btn-danger rounded form-control" style="display:none"> <i class="fa fa-close fa-lg"> </i> Cancel </div>
                                                    </div>
                                                    <script>
                                                        // updage Basic info buttons
                                                        $('#updateInfoEdit').click(function() {
                                                            $('#updateInfoSave,#updateInfoCancel').show();
                                                            $('#upImgIn,#supplier_name,#shop_name,#email,#details,#close_time,#open_time').removeAttr('disabled');
                                                        });
                                                        $('#updateInfoCancel').click(function() {
                                                            $('#updateInfoSave,#updateInfoCancel').hide();
                                                            $('#upImgIn,#supplier_name,#shop_name,#email,#details,#close_time,#open_time').attr('disabled', 'disabled');
                                                        });
                                                    </script>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-5">

                        </div>

                    </div>

                    <!-- .card -->
                
            </div>

            <!--/.col-->

            <div class="col-lg-6">
                <div class="row">

                    @foreach($adresses as $address)

                    <div class="col-12">
                        <form method="POST" action="{{url('address/'.$address->supplier_lives_id)}}">
                            @method('PUT') @csrf
                            <div class="card">

                                <div class="card-header">
                                    <a href="{{url('address/'.$address->supplier_lives_id.'/'.$address->supplier_address_status)}}" class="switch switch-3d switch-success mr-3" {{$address->supplier_address_status == 1 ? 'title=Deativate' : 'title=Activate' }} >
                                        <input type="checkbox" class="switch-input" {{$address->supplier_address_status == 1 ? 'checked="true"' : '' }}> 
                                        <span class="switch-label"></span><span class="switch-handle"></span>
                                    </a>

                                    <a href="#" id="link{{$loop->index}}" class="close" aria-label="Close" data-toggle="modal" data-target="#exampleModalCenter{{$loop->index}}">
                                        <span id="link{{$loop->index}}" aria-hidden="true" style="color:red;font-size: 25px;"><i class="fa fa-trash-o"></i></span>
                                    </a>
                                </div>
                                <div class="card-body card-block">
                                    <div class="row form-group">
                                        <div class="col col-md-2">
                                            <label for="select" class=" form-control-label"> City </label>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <select name="city_id" id="city_id{{$loop->index}}" class="form-control" disabled>
                                                @foreach($cities as $city)
                                                <option value="{{$city->city_id}}" {{ $city->city_id == $address->city_id ? 'selected' : '' }}>{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('city_id'))
                                            <p class='text-danger'>{{$errors->first('city_id')}}</p>
                                            @endif
                                        </div>
                                        <div class="col col-md-1">
                                            <label for="select" class=" form-control-label"> Phone </label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="supplier_phone" id="supplier_phone{{$loop->index}}" placeholder="+2011 4489 5434" value="{{$address->supplier_phone}}" class="form-control" disabled> @if($errors->has('supplier_phone'))
                                            <p class='text-danger'>{{$errors->first('supplier_phone')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row  form-group">
                                        <div class="col-md-2">
                                            <label for="street" class=" form-control-label"> Street</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="supplier_street" id="supplier_street{{$loop->index}}" placeholder="Enter street name" value="{{$address->supplier_street}}" class="form-control" disabled> @if($errors->has('supplier_street'))
                                            <p class='text-danger'>{{$errors->first('supplier_street')}}</p>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="row form-group">
                                        <div class="col-2">
                                            <label for="city" class=" form-control-label"> Area </label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" name="supplier_area" id="supplier_area{{$loop->index}}" placeholder=" Enter Supplier Area" value="{{$address->supplier_area}}" class="form-control" disabled> @if($errors->has('supplier_area'))
                                            <p class='text-danger'>{{$errors->first('supplier_area')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-2">
                                            <label for="city" class=" form-control-label">Bulding No</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="num" name="supplier_bulding_no" id="supplier_bulding_no{{$loop->index}}" placeholder=" Enter Supplier Area" value="{{$address->supplier_bulding_no}}" class="form-control" disabled> @if($errors->has('supplier_bulding_no'))
                                            <p class='text-danger'>{{$errors->first('supplier_bulding_no')}}</p>
                                            @endif
                                        </div>

                                        <input type="hidden" id="hidd{{$loop->index}}" value="{{$address->supplier_lives_id}}">

                                    </div>

                                    <div class="row form-group">
                                        <div class="col-2">
                                            <div id="edit{{$loop->index}}" class=" btn btn-success rounded"><i class="fa fa-edit fa-lg"></i></div>

                                        </div>

                                        <div class="col-3">
                                            <button type="submit" id="updateAdd{{$loop->index}}" class="btn btn-primary form-control rounded" style="display:none;"><i class="fa fa-check fa-lg"></i> Save </button>
                                        </div>
                                        <div class="col-3 offset-4">
                                            <div id="cancelUpdate{{$loop->index}}" class="btn btn-danger rounded form-control" style="display:none;"><i class="fa fa-close fa-lg"></i> Cancel</div>
                                        </div>
                                        <script>
                                            $('#edit{{$loop->index}}').click(function() {
                                                $('#city_id{{$loop->index}},#supplier_phone{{$loop->index}},#supplier_street{{$loop->index}},#supplier_area{{$loop->index}},#supplier_bulding_no{{$loop->index}}').removeAttr('disabled');
                                                $('#updateAdd{{$loop->index}},#cancelUpdate{{$loop->index}}').show();

                                            });
                                            $('#cancelUpdate{{$loop->index}}').click(function() {
                                                $('#city_id{{$loop->index}},#supplier_phone{{$loop->index}},#supplier_street{{$loop->index}},#supplier_area{{$loop->index}},#supplier_bulding_no{{$loop->index}}').attr('disabled', 'disabled');
                                                $('#updateAdd{{$loop->index}},#cancelUpdate{{$loop->index}}').hide();
                                            });
                                        </script>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>

                    <!-- Modal -->
                    @if($loop->count) {{Session::put('count',$loop->count)}} @endif @endforeach
                    <div class="col-5 mb-5">
                        <a href="{{url('supp_profile')}}" class="btn btn-lg btn-success d-block rounded"> <i class="ti-plus"> </i>&nbsp; Add New Adress </a>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
@for ($i = 0; $i< Session::get('count'); $i++) <!-- start delete modal -->
    <div class="modal fade" id="exampleModalCenter{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalCenterTitle">Delete Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you Sure you want to delete this address ?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm{{$i}}" method="POST" action="{{url('supp_profile/'.Session::get('supplier')['supplier_id'])}}">
                        @csrf
                        @method('DELETE') 
                        <input type="hidden" name="supplier_lives_id" id="hiddenModal{{$i}}">
                        <input type="submit" class="btn btn-danger form-control" value="Delete">
                        <!-- <button type="button" class="btn btn-primary" data-dismiss="modal"> Cancel </button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        pass = document.getElementById("hidd{{$i}}").value;
        document.getElementById("hiddenModal{{$i}}").value = pass;
    </script>
    <!-- end delete modal  -->
    @endfor

    <!-- start Error duplicate phone Modal -->
    @if(Session::has('faliedNo'))

    <script>
        $(document).ready(function() {
            $('#dublicatePhone').modal('show');
        });
    </script>

    <div class="modal fade" id="dublicatePhone" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class=" alert alert-danger">
                <div class="text-right">
                    <!-- <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5> -->
                    <button type="button" class="close px-2 py-1" data-dismiss="modal" aria-label="Close" style="cursor: pointer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="" role="alert">
                            <h4 class="alert-heading">The phone Number is Already Exist</h4>
                            <hr>
                            <h6 class="mb-0">Please check the phone number you entered.</h6>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
    </div>

    @php Session::forget('faliedNo'); @endphp @endif
    <!-- end Error duplicate phone Modal -->

    @include('layouts.footer')