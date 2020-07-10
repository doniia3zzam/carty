
@php
$flag=0; // add
if(isset($city)){
    $flag=1; //edit
}
@endphp


    @include('layouts.header')
    @include('layouts.nav')


<div class="container my-3" style="width:50%">
        <div class="card" style="border-radius: 10px;">
            <div class="card-header">
                <strong>City</strong>
            </div>
    <div class="card-body card-block">
        <form action="{{ $flag ? url('city/'.$city->city_id) : url('city')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">

                @if($flag)
                    @method('PUT')
                @endif
                {{csrf_field()}}

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="text-input" class=" form-control-label">City Name</label>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <input type="text" id="text-input" name="name" value="{{ $flag ? $city->name : ''}}"    placeholder="city_name" class="form-control"></div>
                        </div>
                    </div>
                </div>

                @if($errors->has('name'))
                  <p class='text-danger'>{{$errors->first('name')}}</p>
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
    @include('layouts.footer')
