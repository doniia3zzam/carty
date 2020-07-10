<?php
$flag=0;
if(isset($subcategory)) $flag=1;
?>
@include('layouts.header')
@include('layouts.nav')


<div class="container my-3" style="width:70%">
    <div class="card" style="border-radius: 10px;">
                    @if(Session::has('success'))
                            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                {{Session::get('success')}}
                            </div>
                                @php
                                    Session::forget('success');
                                @endphp
                                @endif
                                <div class="card-header">
                                    <strong>Sub Category</strong>
                                 </div>
                        <div class="card-body ">

                            <form action="{{ $flag ? url('sub_category/'.$subcategory->sub_cate_id) : url('sub_category')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @if($flag)
                                @method('put')
                                @endif
                                {{csrf_field()}}
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class=" form-group">
                                                <label for="text-input" class=" form-control-label">Subcateory Name</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class=" form-group">
                                                <input type="text" name="sub_cate_name"
                                            value="{{ $flag ? $subcategory->sub_cate_name :''}}" placeholder="Enter Subcategory Name"
                                            class="form-control"></div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($errors->has('sub_cate_name'))
                                        <p class='text-danger'>{{$errors->first('sub_cate_name')}}</p>
                                    @endif

                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="select" class=" form-control-label">Select Category Name </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select name="category_id" id="select" class="form-control">
                                                    <option value="">Choose Category</option>
                                                    @foreach($catnames as $catname)
                                                        <option value="{{$catname->category_id}}" {{ $flag ? $catname->category_id == $subcategory->category_id ? 'selected' : '' : '' }} >{{$catname->category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @if($errors->has('category_id'))
                                        <p class='text-danger'>{{$errors->first('category_id')}}</p>
                                    @endif

                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="file-input" class="form-control-label">Choose Photo</label>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <input type="file" name="subcategory_photo" class="form-control-file d-none" id="imgin" onchange="showPhoto()">

                                                    <img src="{{url($flag ? 'public/assets/images/subcategories/'.$subcategory->subcategory_photo : 'public/assets/images/subcategories/default.png')}}" alt="image" id="img" style="width:150px;height:150px;cursor:pointer">

                                            </div>
                                        </div>
                                    </div>

                                    @if($errors->has('subcategory_photo'))
                                        <p class='text-danger'>{{$errors->first('subcategory_photo')}}</p>
                                    @endif



                                    <div class="col-12 text-center">
                                        <input type="submit" class="rounded p-2 btn btn-{{ $flag ? 'success' : 'primary'}}"
                                        value="{{ $flag ? 'Update' : 'Submit'}}">
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>


    {{-- </div>
</div> --}}
<script>
    document.getElementById("img").addEventListener("click", function(){
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
@include('layouts.footer')
