@include('layouts.header')
@include('layouts.nav')
<style>

</style>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <a href="{{url('supplier')}}"><i class="fa fa-arrow-left"></i></a>
                <strong class="card-title">All Product</strong>
            </div>
            @if(Session::has('productDel'))
            <div class="alert alert-success h6 text-center">
                {{Session::get('productDel')}}
            </div>
            @php
                Session::forget('productDel');

            @endphp
            @endif
            <div class="card-body">
                <div id="products_supp_table">
                    @include('all_suppliers.all_product_supp_pagi')
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
                            url:"{{url('products/'.$supplier_id.'?page=')}}"+page,
                            success:function(data)
                            {
                                $('#products_supp_table').html(data);
                            }
                        });
                    }
                });
                </script>
        </div>
    </div>
</div>


@for ($i = 0; $i < Session::get('count'); $i++)
<!-- start delete modal  -->
<div class="modal fade" id="exampleModalCenter{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalCenterTitle">Delete Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            Are you Sure you want to Delete this Product ?
            <br>
            </div>
            <div class="modal-footer">

                <form id="deleteForm{{$i}}" method="POST" action="{{url('supplier')}}">
                @method('DELETE')
                @csrf
                    <input type="hidden" name="supplier_id" id="hiddenModalOrder{{$i}}">
                    <input type="hidden" name="product_id" id="hiddenModal{{$i}}">
                    <input type="submit" class="btn btn-danger " value="Yes, Sure">
                    <!-- <button type="button" class="btn btn-primary" data-dismiss="modal"> Cancel </button> -->
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    pass = document.getElementById("hidd{{$i}}").value;
    document.getElementById("hiddenModal{{$i}}").value = pass;
    /* */
    pass1 = document.getElementById("hiddOrder{{$i}}").value;
    document.getElementById("hiddenModalOrder{{$i}}").value = pass1;
</script>
<!-- end delete modal  -->
@endfor
@include('layouts.footer')
