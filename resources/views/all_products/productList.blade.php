@include('layouts.header')
@include('layouts.nav')

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">All products in Carty</strong>
                            </div>
                            @if(Session::has('deletePro'))
                            <div class="alert alert-success h6 text-center">
                                {{Session::get('deletePro')}}
                            </div>
                                @php
                                    Session::forget('deletePro');
                                @endphp
                            @endif
                            <div class="card-body">
                                <div id="product">
                                    @include('all_products.productpagination')
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
                                            url:"{{url('allproducts/?page=')}}"+page,
                                            success:function(data)
                                            {
                                                $('#product').html(data);

                                            }
                                        });
                                    }
                                });
                                </script>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

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

                    <form id="deleteForm{{$i}}" method="POST" action="{{url('product')}}">
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
