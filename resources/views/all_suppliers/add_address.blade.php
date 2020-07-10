@include('layouts.header')
@include('layouts.nav')
<form action="{{url(' supplier')}}" method="post" novalidate="novalidate">
    @csrf

    <div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Add Another Address</strong>
        </div>
        <div class="card-body">

            <div id="pay-invoice">
                <div class="card-body">
                        <div class="">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input name="supplier_phone" type="tel" class="form-control" placeholder="Phone" value="+02"
                                    value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Street</label>
                                        <input  name="supplier_street" type="text" class="form-control"  placeholder="Street"
                                    value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="control-label mb-1">City</label>
                                            <select name="city_id" class="form-control">
                                                {{-- <option value="">Select City</option> --}}
                                                @foreach ($city as $c )
                                                <option value="{{$c->city_id}}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Area</label>
                                        <input name="supplier_area" type="text" class="form-control" placeholder="area"
                                    value="">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Building No</label>
                                        <input name="supplier_bulding_no" type="number" class="form-control" placeholder="Building No"
                                    value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div>
                                <button type="submit" class="btn btn-lg btn-primary btn-block">
                                    Submit
                                </button>
                            </div>

                </div>
            </div>

        </div>
    </div> <!-- .card -->
</form>
@include('layouts.footer')
