
@php
$flag=0; // add
if(isset($brand)){
    $flag=1; //edit
}
@endphp

@include('layouts.header')
@include('layouts.nav')

    <div class="container my-3" style="width:50%">
         <div class="card" style="border-radius: 10px;">
                 <div class="card-header">
                    <strong>Brand</strong>
                 </div>
                    <div class="card-body card-block">
                        <form action="{{ $flag ? url('brand/'.$brand->brand_id) : url('brand')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                @if($flag)
                                     @method('PUT')
                                @endif
                                     {{csrf_field()}}


                                    <div class="row">
                                        <div class="col-3">
                                            <div class=" form-group">
                                                <label for="text-input" class=" form-control-label">Brand Name</label>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class=" form-group">
                                                <input type="text" id="text-input" name="brand_name" value="{{ $flag ? $brand->brand_name : ''}}"  placeholder="	brand_name" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                 @if($errors->has('brand_name'))
                                        <p class='text-danger'>{{$errors->first('brand_name')}}</p>
                                  @endif


                                <div class="row">
                                    <div class="col-3">
                                        <div class=" form-group">
                                            <label for="text-input" class=" form-control-label">Brand Image</label>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <input type="file" name="brand_image" class="form-control-file d-none" id="imgin" onchange="showPhoto()">
                                            <img src="{{url($flag ? 'public/assets/images/brands/'.$brand->brand_image : 'public/assets/images/brands/default.png')}}" alt="image" id="img" style="width:150px;height:150px;">
                                        </div>
                                    </div>
                                </div>

                                    @if($errors->has('brand_image'))
                                        <p class='text-danger'>{{$errors->first('brand_image')}}</p>
                                    @endif
                                <div class="form-group">
                                    <div class="text-center">
                                        <input type="submit" class="btn rounded btn-{{ $flag ? 'success' : 'primary'}}"  value="{{ $flag ? 'Update' : 'Submit'}}">
                                    </div>
                                </div>
                        </form>
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
