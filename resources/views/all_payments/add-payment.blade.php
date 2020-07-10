<?php
$flag=0;
if(isset($payment)) $flag=1;
?>


@include('layouts.header')
@include('layouts.nav')


    <div class="container my-3">

        @if(Session::has('success'))
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    {{Session::get('success')}}
                </div>
        @php
            Session::forget('success');
        @endphp
        @endif



        <div class="card" style="border-radius: 10px;">
            <div class="card-header">
                <label for=""><strong> Payment</strong></label>
            </div>
            <div class="card-body card-block">
                <form action="{{$flag ? url('payment/'.$payment->payment_id) : url('payment')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @if($flag)
                @method('put')
                @endif

                {{csrf_field()}}
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">payment </label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="type"
                            value="{{ $flag ? $payment->type :''}}"placeholder="Enter payment method"class="form-control">
                        </div>
                    </div>

                    @if($errors->has('type'))
                        <p class='text-danger'>{{$errors->first('type')}}</p>
                    @endif
                    <div class="form-group">
                        <div class="text-center">
                            <input type="submit" class=" rounded btn btn-{{ $flag ? 'success' : 'primary'}}" value="{{ $flag ? 'Update' : 'Submit'}}">
                        </div>
                    </div>
                </form>
           </div>
        </div>
    </div>



@include('layouts.footer')
