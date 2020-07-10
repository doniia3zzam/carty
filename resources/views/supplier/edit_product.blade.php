@include('layouts.header') @include('layouts.nav')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <form method="POST" action="{{url('supp_product/'.$product->product_id)}}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title"> Edit Product </strong>
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
                                                <input placeholder="" name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{@Session::has('errorExtension') ? @Session::get('errorExtension')['name'] : $product->name}}"> @if($errors->has('name'))
                                                <p class='text-danger'>{{$errors->first('name')}}</p>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="price" class="control-label mb-1"> Price (<strong>EGP</strong>) </label>
                                                    <input name="price" id="price" type="text" min="1" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{@Session::has('errorExtension') ? @Session::get('errorExtension')['price'] : $product->price}}"> @if($errors->has('price'))
                                                    <p class='text-danger'>{{$errors->first('price')}}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="discount" class="control-label mb-1"> Discount </label>
                                                    <input name="discount" id="discount" type="text" min="0" step="0.01" max="0.99" class="form-control @error('discount') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{@Session::has('errorExtension') ? @Session::get('errorExtension')['discount'] : $product->discount}}"> @if($errors->has('discount'))
                                                    <p class='text-danger'>{{$errors->first('discount')}}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="stock_quantity" class="control-label mb-1"> Stock Quantity </label>
                                                    <input name="stock_quantity" id="stock_quantity" type="text" min="1" class="form-control @error('stock_quantity') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{@Session::has('errorExtension') ? @Session::get('errorExtension')['stock_quantity'] : $product->stock_quantity}}"> @if($errors->has('stock_quantity'))
                                                    <p class='text-danger'>{{$errors->first('stock_quantity')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="country_selector" class="control-label mb-1"> Country </label>
                                                    <input id="country_selector" class="form-control @error('country') is-invalid @enderror" type="text" name="country" value="{{$product->country}}"> {{--
                                                    <label for="country_selector">Select a country here...</label> --}}
                                                    <div class="form-item" style="display:none;">
                                                        <input type="text" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" placeholder="Selected country code will appear here" />
                                                        <label for="country_selector_code">...and the selected country code will be updated here</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-2">
                                                    <label for="select_example" class="control-label mb-1"> Colors </label>
                                                    <select id="select_example" class="form-control @error('color') is-invalid @enderror" name="color">
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
                                                        $('select[id=select_example]').children().each(function() {
                                                            colors = ['white', 'brown', 'green', 'red', 'orange', 'black', 'blue', 'yellow', 'purple', 'navy', 'gray']
                                                            $(this).attr('style', 'background-color:' + colors[$(this).attr('count')] + ';');
                                                        });
                                                        $('select[id=select_example]').change(function() {
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
                                                        <option value="{{$model->model_id}}" {{$product->model_id == $model->model_id ? 'selected' : '' }}> {{$model->model_name}}</option>
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
                                                        <option value="{{$sub->sub_cate_id}}" {{$product->sub_cate_id == $sub->sub_cate_id ? 'selected' : '' }}> {{$sub->sub_cate_name}}</option>
                                                        @endforeach

                                                    </select>
                                                    @if($errors->has('sub_cate_id'))
                                                    <p class='text-danger'>{{$errors->first('sub_cate_id')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class=" form-group">
                                                <textarea name="detials" id="detials" rows="6" style="resize: none;overflow: initial" placeholder="Details..." class="form-control @error('detials') is-invalid @enderror">{{@Session::has('errorExtension') ? @Session::get('errorExtension')['detials'] : $product->detials}}</textarea>
                                                @if($errors->has('detials'))
                                                <p class='text-danger'>{{$errors->first('detials')}}</p>
                                                @endif

                                            </div>

                                            <br>
                                            
                                           
                                            <hr>

                                            <br>
                                           
                                           
                                            
                                        </div>
                                    </div>

                                </div>
                                {{-- start  --}}
                            <div class="card">
                                {{-- start  --}}
                                <div class="card-header ">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-4 d-flex ">
                                            <strong class="card-title"> Product Specifications </strong>
                                        </div>
                                        @if(count($specifications) != 10)
                                            <div class="col-8 d-flex justify-content-end">
                                                <div id="AddSpec" class="btn btn-dark rounded"> <i class="ti-plus"> </i></div>
                                            </div>
                                            <script>
                                                $('#AddSpec').click(function() {
                                                    $('#specTable').fadeIn();
                                                    var scrollBottom = $(window).scrollTop() + $(window).height() *3;
                                                    // $("html, body").animate({
                                                    //     scrollTop: scrollBottom
                                                    // }, 700);
                                                    var elmnt = document.getElementById("specTable");
                                                    elmnt.scrollIntoView();
                                                });
                                            </script>
                                        @endif
                                    </div>
                                </div>
                                <div class="row ">
                                    
                                    <div class="col-12">
                                        <table border=1 class="table border text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">specification</th>
                                                    <th scope="col">Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ( $specifications as $spec)
                                                <tr id="currentTr{{$loop->index}}">
                                                    <td class="align-middle" scope="row">
                                                        @if($loop->index != 0)
                                                        <a href="{{url('delSpec/'.$spec->specification_id)}}" class="close" aria-label="Close" id="closeSpec{{$loop->index}}">
                                                            <span aria-hidden="true" style="color:red">&times;</span>
                                                        </a>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle" scope="row">
                                                        <input type="text" name="specification[]" class="form-control" id="" value="{{$spec->specification}}"> </td>
                                                    <td class="align-middle" scope="row">
                                                        <textarea name="specification_value[]" class="form-control" style="resize:none;overflow: initial" id=""> {{$spec->specification_value}}</textarea>
                                                    </td>
                                                    <input type="hidden" name="specification_id[]" id="" value="{{$spec->specification_id}}">
                                                </tr>
                                                <script>
                                                    $('#closeSpec{{$loop->index}}').click(function() {
                                                        $('#currentTr{{$loop->index}}').fadeOut();
                                                    });
                                                </script>
                                                @if($loop->count) {{Session::put('restSpec',$loop->count)}} @endif @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        @if($errors->has('specification'))
                                        <p class='text-danger'>{{$errors->first('specification')}}</p>
                                        @endif @if($errors->has('specification_value'))
                                        <p class='text-danger'>{{$errors->first('specification_value')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 mb-5 ">
                                    <div class="form-group">
                                        <input type="hidden" name="supplier_id" id="" value="{{$product->supplier_id}}">
                                        <button type="submit" class="btn btn-success btn-lg form-control rounded py-1" id="addProduct" style="line-height: 100%;"> <i class="ti-check"></i>&nbsp; Update</button>
                                    </div>
                                    <script>
                                        $('#addProduct').click(function() {
                                            $(this).html("");
                                            $(this).html("<i class='ti-cloud-up'></i>&nbsp; Updating ... ").fadeIn();
                                        });
                                    </script>
                                </div>
                                {{-- end  --}}
                            </div>
                            {{-- end  --}}
                            </div>
                            
                            
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
                        @php Session::forget('productAdded'); @endphp @endif @if(Session::has('errorExtension'))
                        <div class="text-center text-danger h5" id="alertSuccess">
                            You Must Upload Png Photos only
                        </div>
                        @php Session::forget('errorExtension'); @endphp @endif @if($errors->has('image_name'))
                        <p class='text-danger h5'>{{$errors->first('image_name')}}</p>
                        @endif

                        <div class="card">

                            <div class="card-header">
                                <div class="row d-flex ">
                                    <div class="col-md-4 d-flex align-items-center">
                                        <strong> Product </strong> <small> Photos </small>
                                    </div>
                                    @if(count($images) != 5)
                                    <div class="col-md-8 d-flex justify-content-end">
                                        <div id="addPhotos" class="btn btn-primary rounded"> <i class="ti-plus"> </i></div>
                                    </div>
                                    @endif
                                    <script>
                                        $('#addPhotos').on('click',function() {
                                            $('#photosForm').fadeIn();
                                            $('#addPhotos').fadeOut();
                                            // $('#alertSuccess').fadeOut();
                                            // var scrollBottom = $(window).scrollTop() + $(window).height() * 5;
                                            // $("html, body").animate({
                                            //     scrollTop: scrollBottom
                                            // }, 800);
                                            var elmnt = document.getElementById("photosForm");
                                            elmnt.scrollIntoView();
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="card-body card-block">

                                <div class="row my-5">
                                    @foreach ($images as $img)

                                    <div class="col-md-6 bot{{$loop->index}}">
                                        @if($loop->index >=2 )
                                        <a href="{{url('delImg/'.$img->image_id)}}" class="close" aria-label="Close" id="close{{$loop->index}}">
                                            <span aria-hidden="true" style="color:red">&times;</span>
                                        </a>
                                        </form>
                                        @endif
                                        <div class="photocont">
                                            <p>{{$img->status}}</p>
                                            <img src="{{url('public/assets/images/products/'.$img->image_name)}}" alt="" class="proImg{{$loop->index}} img-fluid rounded my-1" id="imgs{{$loop->index}}" style=" cursor: pointer;height: 290px;">
                                            <input type="file" name="image_name[]" id="file{{$loop->index}}" style="display:none" class="btn btn-primary file{{$loop->index}}" value="{{$img->image_name}}"  onchange="showPhoto{{$loop->index}}()">
                                            <input type="hidden" name="image_id[]" id="" value="{{$img->image_id}}">
                                        </div>
                                    </div>
                                    <script>
                                        /* on clicking to upload image */
                                        $('#imgs{{$loop->index}}').click(function() {
                                            $('#file{{$loop->index}}').click();
                                        });
                                        /* on clicking the close badge */
                                        $('#close{{$loop->index}}').click(function() {
                                            $('#file{{$loop->index}}').val("");
                                            $('.bot{{$loop->index}}').hide();
                                            $(this).hide();

                                        });

                                        function showPhoto{{$loop->index}}() {
                                            var file = document.getElementById('file{{$loop->index}}').files[0];
                                            reader = new FileReader();
                                            reader.onloadend = function() {
                                                $('.proImg{{$loop->index}}').attr('src', reader.result); //to display image
                                                //$('.bot<?php echo($loop->index+1) ?>').show();    // show photo continaer div of the next photo
                                                // $('#addProduct').fadeIn(); // show add product button to make the user must upload at least one image
                                                $('#close{{$loop->index}}').show(); // to show close badge
                                            };

                                            reader.readAsDataURL(file);
                                        }
                                    </script>
                                    @if($loop->count) {{Session::put('restImges',$loop->count)}} @endif @endforeach
                                </div>

                            </div>

                        </div>

                        {{-- add photos button --}}

                        

                    </div>

                    </form>




                   





                </div>







            </div>



           




        </div>



         {{-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%55 add new specifications %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% --}}
         <div class="row">
            <div class="col-12 mb-5">
                <form action="{{url('addImg')}}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" id="" value="{{$product->product_id}}">
                    <input type="hidden" name="supplier_id" id="" value="{{$product->supplier_id}}">
                    <div class="card" style="background-color:white;border:1px solid rgba(0,0,0,.125);display: none" id="specTable">
                        <!-- Credit Card -->
                        <div id="pay-invoice">
                            <div class="card-header">
                                <strong class="card-title"> Add New Specifications </strong>
                                <button type="button" class="close" id="colseTableNew" style="" aria-label="Close">
                                    <span aria-hidden="true" style="color:red">&times;</span>
                                </button>
                            </div>
                            <div class="card-body">
                                
                                <table border=1 class="table border text-center" style="background-color:white">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Specification</th>
                                            <th scope="col">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($i=10 ;$i>Session::get('restSpec');$i--)
                                        <tr id="currentTrNew{{$i}}">
                                            <td class="align-middle" scope="row">
                                                {{ ($i-($i-1)) }}
                                                @if($i != 10)
                                                    <a class="close" aria-label="Close" id="closeNewSpec{{$i}}">
                                                        <span aria-hidden="true" style="color:red">&times;</span>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="align-middle" scope="row">
                                                <input type="text" name="specification[]" class="form-control" id="" value=""> </td>
                                            <td class="align-middle" scope="row">
                                                <textarea name="specification_value[]" class="form-control" style="resize:none;overflow: initial" id=""></textarea>
                                            </td>

                                        </tr>
                                        <script>
                                            $('#closeNewSpec{{$i}}').click(function() {
                                                $('#currentTrNew{{$i}}').html("");
                                                $('#currentTrNew{{$i}}').fadeOut();
                                            });
                                            $('#colseTableNew').on('click', function() {
                                                $('#specTable,#colseTableNew').fadeOut(500, function() {
                                                    $('#specTable').html("");
                                                });
                                            });
                                        </script>
                                        @endfor

                                    </tbody>
                                </table>
                                @if($errors->has('specification'))
                                <p class='text-danger'>{{$errors->first('specification')}}</p>
                                @endif @if($errors->has('specification_value'))
                                <p class='text-danger'>{{$errors->first('specification_value')}}</p>
                                @endif
                                <button type="submit" class="rounded btn btn-dark form-control"> <i class="ti-check"></i>&nbsp; Confirm</button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
       
        {{-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% end add new specifications %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% --}} 



         {{-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%55 start add new photo%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% --}}

            <div class="col-12 mb-5">
                <form action="{{url('addImg')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" id="" value="{{$product->product_id}}">
                    <input type="hidden" name="supplier_id" id="" value="{{$product->supplier_id}}">
                    <div class="card" id="photosForm" style="display: none">

                        <div class="card-header">
                            <strong>New </strong> <small>Photos</small>
                        </div>
                        <div class="card-body card-block">
                            <div class="alert alert-warning" role="alert">
                                <h4 class="alert-heading"><strong>Before Uploading,We Accept</strong></h4>
                                <hr>
                                <br>
                                <ul style="text-indent:20px">
                                    <li>Maximum Number Of Photos <strong> 5 </strong> Photos </li>
                                    <li>Photo Extensition <strong> .png </strong> only</li>
                                    <li>Maximum Width <strong> 1920  <small>px</small> </strong> </li>
                                    <li>Maximum Height <strong> 1080 <small>px</small> </strong> </li>
                                    <i> The first Photo is the Primary One Which will appear in the index and all products pages</i>
                                    <i> The second Photo is the secondary One Which will appear in hovering</i>
                                    <i> The rest of Photos will appear in single product page and quick view</i>
                                </ul>
                            </div>
                            <div class="row my-5">

                                <?php for($i=5 ;$i>Session::get('restImges');$i--){ ?>
                                    <div class="col-md-6 bot<?php echo($i) ?>" style="<?php if($i != 5) echo('display:none;') ?>">
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
                                        $('.proImg<?php echo($i) ?>').click(function() {
                                            $('.file<?php echo($i) ?>').click();
                                        });
                                        /* on clicking the close badge */
                                        $('#close<?php echo($i) ?>').click(function() {
                                            $('#file<?php echo($i) ?>').val("");
                                            $('.bot<?php echo($i) ?>').hide();
                                            $(this).hide();

                                        });

                                        function showPhoto<?php echo($i) ?> () {
                                            var file = document.getElementById('file<?php echo($i) ?>').files[0];
                                            reader = new FileReader();
                                            reader.onloadend = function() {
                                                $('.proImg<?php echo($i) ?>').attr('src', reader.result); //to display image
                                                $('.bot<?php echo($i-1) ?>').show(); // show photo continaer div of the next photo
                                                $('#AddPhoto').fadeIn(); // show add product button to make the user must upload at least one image
                                                $('#close<?php echo($i) ?>').show(); // to show close badge
                                            };

                                            reader.readAsDataURL(file);
                                        }
                                    </script>
                                    <?php
                                            }
                                            ?>

                            </div>
                            <button type="submit" class="btn btn-primary btn-lg form-control rounded py-1" id="AddPhoto" style="display: none;line-height: 100%;"> <i class="ti-check"></i>&nbsp; Confirm</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%55 end add new photo%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% --}}



    </div>

    @include('layouts.footer')