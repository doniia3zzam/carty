<?php
$flag=0;
if(isset($category)) $flag=1;
?>

@include('layouts.header')
@include('layouts.nav')



<div class="container my-3" style="width:50%">
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
                    <strong>Category</strong>
                 </div>
                <div class="card-body card-block col-12">
                    <form action="{{ $flag ? url('category/'.$category->category_id) : url('category')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @if($flag)
                    @method('put')
                    @endif

                    {{csrf_field()}}
                            <div class="row">
                                <div class="col-3">
                                    <div class=" form-group">
                                        <label for="text-input" class=" form-control-label">Cateory Name</label>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class=" form-group">
                                        <input type="text" name="category_name" placeholder="Enter Category Name"
                                        value="{{ $flag ? $category->category_name :''}}" class="form-control">
                                    </div>
                                </div>
                            </div>

                                @if($errors->has('category_name'))
                                    <p class='text-danger'>{{$errors->first('category_name')}}</p>
                                @endif

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="file-input" class="form-control-label">Choose Photo</label>
                                    </div>
                                </div>
                                {{-- <div class="col-3">
                                    <div class="form-group">
                                        <i class="fa fa-upload" id="icon" style="width:20%"></i>
                                        <input type="file" name="category_photo_name" class="form-control-file d-none" id="imgin" onchange="showPhoto()">
                                    </div>
                                </div> --}}
                                <div class="col-9">
                                    <div class="form-group">
                                        <input type="file" name="category_photo_name" class="form-control-file d-none" id="imgin" onchange="showPhoto()">

                                            <img src="{{url($flag ? 'public/assets/images/categories/'.$category->category_photo_name : 'public/assets/images/categories/default.png')}}" alt="image" id="img" style="width:150px;height:150px;cursor:pointer">

                                    </div>
                                </div>
                            </div>

                            @if($errors->has('category_photo_name'))
                            <p class='text-danger'>{{$errors->first('category_photo_name')}}</p>
                            @endif

                            <div class="col-12 ">
                                <div class="form-group text-center">
                                        <input type="submit" class="p-2 mx-auto btn rounded btn-{{ $flag ? 'success' : 'primary'}}"
                                        value="{{ $flag ? 'Update' : 'Submit'}}">
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
