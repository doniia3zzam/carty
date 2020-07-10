

@include('layouts.header')
@include('layouts.nav')

@php
$flag=0; // add
if(isset($model)){
    $flag=1; //edit
}

@endphp

<div class="container my-3" style="width:50%">
    <div class="card" style="border-radius: 10px;">
        <div class="card-header">
            <strong>model</strong>
        </div>
        <div class="card-body card-block">
            <form  method="POST" action="{{ $flag ? url('model/'.$model->model_id) : url('model')}}" enctype="multipart/form-data" class="form-horizontal">

                @if($flag)
                    @method('PUT')
                @endif

                {{csrf_field()}}
                <div class="col-12">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="text-input" class="form-control-label">Model Name</label>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class=" form-group">
                                <input type="text" id="text-input" name="model_name" class="form-control" value="{{ $flag ? $model->model_name : ''}}"  placeholder="Model Name" class="form-control">                        </div>
                            </div>
                        </div>
                    </div>
                    @if($errors->has('model_name'))
                        <p class='text-danger'>{{$errors->first('model_name')}}</p>
                    @endif


                    <div class="row">
                        <div class="col-3">
                            <div class=" form-group">
                                <label for="text-input" class="form-control-label">Model Image</label>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <input type="file" name="model_image" class="form-control-file d-none" id="imgin" onchange="showPhoto()">

                                <img src="{{url($flag ? 'public/assets/images/models/'.$model->model_image : 'public/assets/images/models/default.png')}}" alt="image" id="img" style="width:150px;height:150px;cursor:pointer">
                            </div>
                        </div>
                    </div>


                    @if($errors->has('model_image'))
                        <p class='text-danger'>{{$errors->first('model_image')}}</p>
                    @endif
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Brand Name</label>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <select name ="brand_id"class="form-control">
                                    <option  value="">Choose brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->brand_id}}" {{ $flag ?  $brand->brand_id == $model->brand_id ? 'selected' : '' : ''}} >{{$brand->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            <input type="submit" class="btn rounded btn-{{ $flag ? 'success' : 'primary'}}"  value="{{ $flag ? 'Update' : 'Submit'}}">
                        </div>
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
