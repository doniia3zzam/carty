@include('layouts.header')
@include('layouts.nav')
<div class="row ">
    <div class="content mt-3 ">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-10 offset-1 " basic>
                    <div class="card">
                        <div class="card-header">
                            <strong>ADD NEW OFFER</strong>
                        </div>
                        <div class="card-body card-block">
                        @php
                        $flag=0;
                        if(isset($offer)){
                            $flag=1;
                        }
                        @endphp

                            <form action="{{$flag ? url('offer/'.$offer->offer_id) : url('offer')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                {{csrf_field()}}
                                @if($flag)
                                    @method('PUT')
                                @endif
                                <!-- hwa fen percentage  -->
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Offer Title </label></div>
                                    <div class="col-12 col-md-9"><input type="text" id="text-input" name="offer_title" value="{{$flag ? $offer->offer_title :''}}" placeholder="{{$flag ? '' :'write offer title'}}" class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="email-input" class=" form-control-label">Short Description</label></div>
                                    <div class="col-12 col-md-9"><input type="text" id="short-input" name="offer_short_desc" value="{{$flag ? $offer->offer_short_desc :''}}" placeholder="{{$flag ? '' :'write short description'}}" class="form-control"></div>
                                </div>

                                <div class="row form-group">
                              <?php
                                if($flag){
                                $temp = explode(' ',$offer->start_date);
                                }
                                ?>

                                    <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Start-Date</label></div>
                                    <div class="col-12 col-md-9"><input type="date" id="disabled-input" name="start_date"  value="{{$flag ? $temp[0] :''}}" class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <?php
                                if($flag){
                                $tem = explode(' ',$offer->end_date);
                                }
                                ?>
                                    <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">End-Date</label></div>
                                    <div class="col-12 col-md-9"><input type="date" id="disabled-input" name="end_date" value="{{$flag ? $tem[0] :''}}" class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                        <div class="col col-md-3"><label for="file-input" class=" form-control-label">Offer photo</label></div>
                                          <div style="width:100%; height:617px;overflow:hidden">
                                            <div class="col-12 col-md-9"><input id="inputUploads" style="display: none;" type="file"
                                                accept=".jpg,.jpeg,.png" name="offer_photo_name" onchange="showPhoto1()" />
                                                    <img src="{{$flag ? url('public/assets/images/offered/'.$offer->offer_photo_name) : url('public/assets/images/products/default.png')}}" id="imgs"  style="cursor: pointer;">

                                            </div>
                                        </div>

                                </div>

                                <script>
                                    $('#imgs').click(function () {
                                        $('#inputUploads').click();
                                    });


                                    function showPhoto1() {
                                        var file = document.getElementById('inputUploads').files[0];
                                        console.log(file);
                                        reader = new FileReader();
                                        // console.log(reader);
                                        reader.onloadend = function () {
                                            $('#imgs').attr('src',reader.result);
                                            // console.log(reader.result);
                                        };

                                        reader.readAsDataURL(file);
                                    }
                                </script>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Description</label></div>
                                    <div class="col-12 col-md-9"><textarea name="description" id="textarea-input" rows="9" placeholder="{{$flag ? '' :'Content...'}}"class="form-control">{{$flag ? $offer->description :''}}</textarea></div>
                                </div>
                                <div class="row form-group">
                                        <div class="col col-md-3"><label class=" form-control-label">Offer Status</label></div>
                                        <div class="col col-md-9">
                                            <div class="form-check">
                                                <div class="radio">
                                                    <label for="radio1" class="form-check-label ">
                                                        <input type="radio" id="radio1"{{$flag ? $offer->offer_status==1 ?'checked' :"" :''  }} name="offer_status" value="1" class="form-check-input">activate
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label for="radio2" class="form-check-label ">
                                                        <input type="radio" id="radio2"{{$flag ? $offer->offer_status==0 ?'checked' :"" :''  }} name="offer_status" value="0" class="form-check-input">deactivate
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @if($flag)
                                        <div class="content mt-3 ">
                                            <div class="animated fadeIn">
                                                <div class="row ">
                                                    <div class="col">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <strong class="card-title">Data Table</strong>
                                                            </div>
                                                            <div class="card-body row">

                                                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Product ID</th>
                                                                            <th>Supplier ID</th>
                                                                            <th>Product Name</th>
                                                                            <th>Price</th>
                                                                            <th>detailes</th>
                                                                            <th>discount</th>
                                                                            <th>Action</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach( $offproduct as $offpro )
                                                                        <tr>
                                                                               <td> {{$offpro->product_id}}</td>
                                                                               <td> {{$offpro->supp_id}}</td>
                                                                               <td> {{$offpro->name}}</td>
                                                                               <td> {{$offpro->price}} EGP</td>
                                                                               <td> {!! $offpro->detials !!}</td>
                                                                               <td> {{$offpro->percentage}} </td>
                                                                               <td> <a href="{{url('storeproduct/'.$offpro->product_id.'/'.$offpro->supp_id.'/'.$offpro->offer_id)}}" class="btn "><i class='fa fa-trash-o'></i></a> </td>
                                                                           </tr>
                                                                @endforeach
                                                                    </tbody>
                                                                    </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endif
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary btn-sm" value="save"/>

                            @if($flag)
                            <a href="{{ url('kh/'.$offer->offer_id.'/add') }}"  class="btn btn-success btn-sm ">add product</a>
                            @endif
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@include('layouts.footer')



















