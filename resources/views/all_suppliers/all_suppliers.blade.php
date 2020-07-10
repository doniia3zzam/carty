@include('layouts.header')
@include('layouts.nav')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title" id="donn">Data Table</strong>
                    </div>
                    <div class="card-body">
                        <div id="supplier_table">
                            @include('all_suppliers.all_supplier_admin_pagination')
                        </div>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $(document).on('click','.pagination a',function(event){
                                event.preventDefault();
                                var page = $(this).attr('href').split('page=')[1];
                                fetch_data(page);
                            });
                            function fetch_data(page){
                                $.ajax({
                                    url:"{{ url('suppliers/?page=')}}"+page,
                                    success:function(data)
                                    {
                                        $('#supplier_table').html(data);

                                    }
                                });
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div>
{{-- to delete supplier --}}
<span style="display:none">
{{ Session::get('count') }}</span>
@for ($i = 1; $i <= Session::get('count'); $i++)
<div class="modal fade" id="smallmodal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="smallmodalLabel">Delete Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure, you want to delete this supplier ?

                </p>
            </div>
            <form action="supplier/2" method="POST">
                @method('delete')
                {{ csrf_field() }}
            <div class="modal-footer">
                <input type="hidden" name="supplier_id" id="inputModal{{$i}}">
                <button type="submit" class="btn btn-danger rounded">Delete</button>
                <button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Cancel</button>
            </form>
            </div>
        </div>
    </div>
</div>
{{-- to add address --}}
{{-- <span style="display:none">
    {{ Session::get('count') }}</span> --}}
    {{-- @for ($i = 1; $i <= Session::get('count'); $i++) --}}


    <div class="modal fade" id="addmodal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Add Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{url('add_address')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input name="supplier_phone" type="tel" class="form-control @error('supplier_phone') is-invalid  @enderror" placeholder="Phone"
                                        value="{{old('supplier_phone')}}">
                                        @error('supplier_phone')
                                        <p class="text-danger">{{ $errors->first('supplier_phone') }}</p>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Street</label>
                                            <input  name="supplier_street" type="text" class="form-control @error('supplier_street') is-invalid  @enderror"  placeholder="Street"
                                        value="{{old('supplier_street')}}">
                                        @error('supplier_street')
                                        <p class="text-danger">{{ $errors->first('supplier_street') }}</p>
                                        @enderror

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="control-label mb-1">City</label>
                                                <select name="city_id" class="form-control @error('city_id') is-invalid  @enderror">

                                                    @foreach ($city as $c )
                                                    <option value="{{$c->city_id}}">{{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('city_id')
                                                <p class="text-danger">{{ $errors->first('city_id') }}</p>
                                                 @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Area</label>
                                            <input name="supplier_area" type="text" class="form-control @error('supplier_area') is-invalid  @enderror" placeholder="area"
                                            value="{{old('supplier_area')}}">
                                                @error('supplier_area')
                                                <p class="text-danger">{{ $errors->first('supplier_area') }}</p>
                                                 @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Building No</label>
                                            <input name="supplier_bulding_no" type="number" class="form-control @error('supplier_bulding_no') is-invalid  @enderror" placeholder="Building No"
                                        value="{{old('supplier_bulding_no')}}">
                                        @error('supplier_bulding_no')
                                                <p class="text-danger">{{ $errors->first('supplier_bulding_no') }}</p>
                                                 @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>


                    <div class="modal-footer">
                        <input type="hidden" name="supplier_id" id="inputAddModal{{$i}}">
                        <button type="submit" class="btn btn-success">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="addmodal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="smallmodalLabel">Add Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                </div>
                <form action="supplier/2" method="POST">
                    <div class="modal-footer">
                        <input type="hidden" name="supplier_id" id="inputModal{{$i}}">
                        <a href="{{url('supplier')}}" type="submit" class="btn btn-success">Add</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
<script>
    pass = document.getElementById("input{{$i}}").value;
    document.getElementById("inputModal{{$i}}").value = pass;
    // to add address
    pass1 = document.getElementById("add{{$i}}").value;
    document.getElementById("inputAddModal{{$i}}").value = pass1;

    $("#test{{$i}}").click(function(){
        // alert($("#test{{$i}}").attr("test{{$i}}"));
        var test = $("#test{{$i}}").attr("test{{$i}}");
        var dd = '#addmodal' + test;
        // alert(dd);
        localStorage.setItem("key", dd);


    });
</script>
@endfor
@if (count($errors) > 0)
    <script>
        $(document).ready(function(){
              $(localStorage.getItem("key")).modal('show');
          });
    </script>
@endif
@include('layouts.footer')
