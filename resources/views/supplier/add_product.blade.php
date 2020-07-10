@include('layouts.header')
@include('layouts.nav')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <form method="POST" action="{{url('supp_product')}}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                <strong class="card-title"> Add Product </strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <div class="text-center">
                                                    <div class="row d-flex" style="align-items: center">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        
                                                <div class="form-group text-center">
                                                    <ul class="list-inline">
                                                        <h6></h6>
                                                    </ul>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="control-label mb-1"> Product Name </label>
                                                <input placeholder=""  name="name" id="name" type="text"  class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{@Session::has('errorExtension') ? @Session::get('errorExtension')['name'] : old('name')}}"   >
                                                    @if($errors->has('name'))
                                                        <p class='text-danger'>{{$errors->first('name')}}</p>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-4">
                                                        <label for="price" class="control-label mb-1"> Price (<strong>EGP</strong>) </label>
                                                        <input  name="price" id="price" type="text" min="1"  class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{@Session::has('errorExtension') ? @Session::get('errorExtension')['price'] : old('price')}}"   >
                                                        @if($errors->has('price'))
                                                            <p class='text-danger'>{{$errors->first('price')}}</p>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label for="discount" class="control-label mb-1"> Discount </label>
                                                        <input  name="discount" id="discount" type="text" min="0" step="0.01" max="0.99" class="form-control @error('discount') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{@Session::has('errorExtension') ? @Session::get('errorExtension')['discount'] : old('discount')}}"   >
                                                        @if($errors->has('discount'))
                                                            <p class='text-danger'>{{$errors->first('discount')}}</p>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label for="stock_quantity" class="control-label mb-1"> Stock Quantity </label>
                                                        <input  name="stock_quantity" id="stock_quantity" type="text" min="1"  class="form-control @error('stock_quantity') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{@Session::has('errorExtension') ? @Session::get('errorExtension')['stock_quantity'] : old('stock_quantity')}}"   >
                                                        @if($errors->has('stock_quantity'))
                                                            <p class='text-danger'>{{$errors->first('stock_quantity')}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                        <div class="form-group col-6">
                                                            <label for="country_selector" class="control-label mb-1"> Country </label>
                                                            <input id="country_selector" class="form-control @error('country') is-invalid @enderror" type="text" name="country"  value="{{old('country')}}">
                                                            {{-- <label for="country_selector" >Select a country here...</label> --}}
                                                            <div class="form-item" style="display:none;">
                                                            <input type="text" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" placeholder="Selected country code will appear here"/>
                                                                <label for="country_selector_code">...and the selected country code will be updated here</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-2">
                                                            <label for="select_example" class="control-label mb-1"> Colors </label>
                                                            <select id="select_example" class="form-control @error('color') is-invalid @enderror" name="color" value="{{@Session::has('errorExtension') ? @Session::get('errorExtension')['color'] : old('color')}}">
                                                                <option count="0" value="White "></option>
                                                                <option count="1" value="Brown"></option>
                                                                <option count="2" value="Green"></option>
                                                                <option count="3" value="Red"></option>
                                                                <option count="4" value="Orange"></option>
                                                                <option count="5" value="Black"></option>
                                                                <option count="6" value="blue"></option>
                                                                <option count="7" value="yellow"></option>
                                                                <option count="8" value="purple"></option>
                                                                <option count="9" value="navy"></option>
                                                                <option count="10" value="gray"></option>
                                                            </select>
                                                            @if($errors->has('color'))
                                                                <p class='text-danger'>{{$errors->first('color')}}</p>
                                                            @endif
                                                            <script type="text/javascript">
                                                                $('select[id=select_example]').children().each(function (){    
                                                                    colors = ['white','brown', 'green', 'red', 'orange', 'black', 'blue', 'yellow', 'purple', 'navy', 'gray']
                                                                    $(this).attr('style', 'background-color:' + colors[$(this).attr('count')] + ';');
                                                                });
                                                                $('select[id=select_example]').change(function (){
                                                                $(this).attr('style', $(this).find('option:selected').attr('style'));
                                                                // alert($(this).val());
                                                                }).change();
                                                            </script>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-6">
                                                        <label for="model_id" class="control-label mb-1">Car Model </label>
                                                        <select id="model_id" class="form-control @error('model_id') is-invalid @enderror" name="model_id">
                                                            @foreach ($models as $model)
                                                                <option value="{{$model->model_id}}" {{old('model_id') == $model->model_id ? 'selected' : '' }}> {{$model->model_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('model_id'))
                                                            <p class='text-danger'>{{$errors->first('model_id')}}</p>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="sub_cate_id" class="control-label mb-1"> Sub Category </label>
                                                        <select id="sub_cate_id" class="form-control @error('sub_cate_id') is-invalid @enderror" name="sub_cate_id">
                                                            @foreach ($sub_cats as $sub)
                                                                <option value="{{$sub->sub_cate_id}}" {{old('sub_cate_id') == $sub->sub_cate_id ? 'selected' : '' }}> {{$sub->sub_cate_name}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                        @if($errors->has('sub_cate_id'))
                                                            <p class='text-danger'>{{$errors->first('sub_cate_id')}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class=" form-group">
                                                    <textarea name="detials" id="detials" rows="6" placeholder="Details..." class="form-control @error('detials') is-invalid @enderror">{{@Session::has('errorExtension') ? @Session::get('errorExtension')['detials'] : old('detials')}}</textarea>
                                                    @if($errors->has('detials'))
                                                        <p class='text-danger'>{{$errors->first('detials')}}</p>
                                                    @endif
                                                    
                                                </div>
                                                
                                                <div class="row">
                                                    <div class=" d-inline col-4">
                                                        <span id='addSpec' class="d-inline"> Add Specifications ? </span> &nbsp;&nbsp;&nbsp;
                                                    </div>
                                                    <div class=" col-12 " id="noOfSpecCont" style="display:none">
                                                        <p class="d-inline"> Type Number of Specifications </p> &nbsp; &nbsp;  
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <input type="number" value="1" min="1" max = "10" class="form-control col-6 " id="noOfSpec">
                                                            <button type="button" class="btn btn-secondary rounded" id="okSpec">Ok</button>
                                                          </div>
                                                        

                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row ">
                                                    <div class="col-12">
                                                        <button type="button" class="close" id="colseTable" style="margin-left:auto;font-size: 25px;display:none" aria-label="Close">
                                                            <span aria-hidden="true" style="color:red">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-12" id="specTable" style="display:none;">
                                                        
                                                    </div>
                                                    <div class="col-12">
                                                        @if($errors->has('specification'))
                                                            <p class='text-danger'>{{$errors->first('specification')}}</p>
                                                        @endif
                                                        @if($errors->has('specification_value'))
                                                            <p class='text-danger'>{{$errors->first('specification_value')}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <script>
                                                    $('#addSpec').click(function () { 
                                                        $('#noOfSpecCont').fadeIn();
                                                        
                                                    });
                                                    $('#okSpec').click(function () {
                                                        rows = $('#noOfSpec').val();
                                                        // close = '<button type="button" class="close" id="colseTable" style="margin-left:auto;font-size: 25;background: red;border-radius: 50% 50%;width: 25px;height: 25px;" aria-label="Close">'+
                                                        //             '<span aria-hidden="true" style="color:white;line-height:105%">&times;</span>'
                                                        //         '</button>';
                                                        table = '<table border=1 class="table border text-center">'+
                                                        '<thead class="thead-dark">'+
                                                          '<tr>'+
                                                            '<th scope="col">#</th>'+
                                                            '<th scope="col">Specification</th>'+
                                                            '<th scope="col">Value</th>'+
                                                          '</tr>'+
                                                        '</thead>'+
                                                        '<tbody>';
                                                        for (let index = 0; index < rows ; index++) {
                                                             table +=   '<tr>'+
                                                                            '<th class="align-middle">'+index+'</th>'+
                                                                            '<td class="align-middle"><input type="text" name="specification[]" id="" class="form-control" placeholder="Ex: Color" required></td>'+
                                                                            '<td><textarea name="specification_value[]" id="" style="overflow-y: scroll;resize: none" class="form-control" placeholder="Ex: Red" required></textarea></td>'+
                                                                        '</tr>';
                                                        }
                                                        table += '</tbody>'+'</table>';
                                                        $('#specTable').html("");
                                                        $('#specTable').append(table);
                                                        $('#specTable').fadeIn();
                                                        $('#colseTable').fadeIn();
                                                        
                                                    });
                                                    $('#colseTable').on('click',function () { 
                                                        $('#specTable,#colseTable').fadeOut(500,function(){
                                                            $('#specTable').html("");
                                                        });
                                                     });
                                                    
                                                </script>
                                               
                                                
                                                <hr>
                                                
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div id="addPhotos" class="btn btn-success rounded"> <i class="ti-plus"> </i>&nbsp; Add Photos </div>
                                                    </div>
                                                    <script>
                                                        $('#addPhotos').click(function(){
                                                            $('#photosForm').fadeIn();
                                                            // $('#alertSuccess').fadeOut();
                                                            $("html, body").animate({
                                                                scrollTop: 0
                                                            }, 700);
                                                        });
                                                    </script>
                                                    
                                                </div>

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

                        
                        
                        <div class="col-12">
                            @if(Session::has('productAdded'))
                            <div class="alert alert-success text-center h5" id="alertSuccess">
                                You Have Successfully Added a New Product With {{Session::get('productAdded')}} Photos
                            </div>
                            @php
                                Session::forget('productAdded');
                            @endphp
                            @endif

                            @if(Session::has('errorExtension'))
                            <div class="text-center text-danger h5" id="alertSuccess">
                                You Must Upload Png Photos only 
                            </div>
                            @php
                                Session::forget('errorExtension');
                            @endphp
                            @endif

                            @if($errors->has('image_name'))
                                <p class='text-danger h5' >{{$errors->first('image_name')}}</p>
                            @endif

                            <div class="card"  id="photosForm" style="display:none">

                                <div class="card-header">
                                    <strong>Product</strong> <small>Photos</small>
                                </div>
                                <div class="card-body card-block">
                                    <div class="alert alert-warning" role="alert">
                                        <h4 class="alert-heading"><strong>Before Uploading,We Accept</strong></h4>
                                        <hr>
                                        <br>
                                        <ul style="text-indent:20px">
                                            <li>Maximum Number Of Photos <strong> 5 </strong> Photos </li>
                                            <li>Photo Extensition  <strong> .png </strong> only</li>
                                            <li>Maximum Width <strong> 1920  <small>px</small> </strong> </li>
                                            <li>Maximum Height <strong> 1080 <small>px</small> </strong> </li>
                                        </ul>
                                    </div>
                                    <div class="row my-5">
                                        <?php for($i=0 ;$i<5;$i++){ ?>
                                            <div class="col-md-6 bot<?php echo($i) ?>" style="<?php if($i != 0) echo('display:none;') ?>">
                                                <a type="button" class="close" aria-label="Close" id="close<?php echo($i) ?>" style="display:none">
                                                    <span aria-hidden="true" style="color:red">&times;</span>
                                                </a>
                                                <div class="photocont">
                                                <img src="{{url('public/assets/images/products/default.png')}}" alt="" class="proImg<?php echo($i) ?> img-fluid rounded my-1" style=" cursor: pointer;height: 290px;">
                                                    <input type="file" name="image_name[]" id="file<?php echo($i) ?>" class="btn btn-primary file<?php echo($i) ?>" style="display:none;" onchange="showPhoto<?php echo($i) ?>()">
                                                </div>
                                            </div>
                                            <script>
                                            /* on clicking to upload image */
                                            $('.proImg<?php echo($i) ?>').click(function(){
                                                $('.file<?php echo($i) ?>').click();
                                            });
                                            /* on clicking the close badge */
                                            $('#close<?php echo($i) ?>').click(function(){
                                                $('#file<?php echo($i) ?>').val("");
                                                $('.bot<?php echo($i) ?>').hide();
                                                $(this).hide();
                                            
                                            });
                                            function showPhoto<?php echo($i); ?> () {
                                                var file = document.getElementById('file<?php echo($i) ?>').files[0];
                                                reader = new FileReader();
                                                reader.onloadend = function () {
                                                    $('.proImg<?php echo($i) ?>').attr('src',reader.result); //to display image
                                                    $('.bot<?php echo($i+1) ?>').show();    // show photo continaer div of the next photo
                                                    <?php if($i >= 1) { ?>
                                                    $('#addProduct').fadeIn(); // show add product button to make the user must upload at least one image
                                                    <?php } ?>
                                                    $('#close<?php echo($i) ?>').show(); // to show close badge
                                                };
                                
                                                reader.readAsDataURL(file);
                                            }
                                            
                                        </script>
                                        <?php
                                    }
                                    ?>

                                </div>

                            </div>
                        
                        </div>
                        
                         <!-- Modal -->
                        
                        
                        <div class="col-12 mb-5">
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg form-control rounded py-1" id="addProduct" style="display: none;line-height: 100%;"> <i class="ti-check"></i>&nbsp; Add Product</button>
                            </div>
                            <script>
                           
                                $('#addProduct').click(function(){
                                    $(this).html("");
                                    $(this).html("<i class='ti-cloud-up'></i>&nbsp; Uploading ... ").fadeIn();
                                });
                            </script>
                        </div>
                        
                        
                    </div>
                </form>
                </div>

            </div>
        
    </div>
</div>


@include('layouts.footer')