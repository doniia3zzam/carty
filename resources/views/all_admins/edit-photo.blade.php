{{-- @extends('layouts.app') --}}
@include('layouts.header')
@include('layouts.nav')

{{-- @section('content') --}}

<div class="container-fluid">
<div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">


                        <div class="col-3"> My profile</div>
                        <div class="offset-6 col-3 text-right">
                            <a href="{{url('password/change')}}" class="btn btn-info text-right"> change  password </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('admin/'.$admin->id) }}" enctype="multipart/form-data">
                    @method('put')
                        @csrf

                        <!-- <div class="form-group row">
                            <label for="file-input" class="col-md-4 col-form-label text-md-right">Choose Photo</label>

                            <div class="col-md-6">
                                <input id="file-input" type="file" class="form-control"
                                name="admin_photo">
                            </div>
                        </div> -->



                        <div class="form-group col-md-4 m-auto">
                            <input type="file" class="form-control" id="file-input" name="admin_photo"
                            style="display: none;" onchange="showPhoto()" >

                            <img src="{{url($admin->admin_photo)}}" id="img1"
                             style="cursor: pointer; width:150px; height:150px;">

                            <!-- <div class="btn btn-outline-dark" id="btnUpload">Upload Photo</div> -->
                        </div>


                        <div class="form-group row my-4">
                            <div class="col-md-8 offset-md-5">
                                <input type="submit" class="btn btn-success" value="update">
                            </div>
                        </div>
                        <div class="row">

                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- <div class="col-md-5">
            <img src="{{url($admin->admin_photo)}}" alt="admin" style="width:440px;height:440px" id="img1">
        </div> -->

    </div>

</div>


<script>
        $('#img1').click(function () {
            $('#file-input').click();
        });
        function showPhoto() {
            var file = document.getElementById('file-input').files[0];
            console.log(file);
            reader = new FileReader();
            // console.log(reader);
            reader.onloadend = function () {
                $('#img1').attr('src',reader.result);
                // console.log(reader.result);
            };

            reader.readAsDataURL(file);
        }
    </script>



{{-- @endsection --}}
@include('layouts.footer')

