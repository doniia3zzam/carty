@include('layouts.header') @include('layouts.nav')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">orders Table</strong>
                    </div>
                    <div class="card-body">
                        @if(Session::has('mailSucc'))
                            <div class="alert alert-success text-center">{{Session::get('mailSucc')}}</div>
                            @php Session::forget('mailSucc'); @endphp
                        @endif

                        @if(Session::has('mailSucc'))
                            <div class="alert alert-danger text-center ">{{Session::get('mailSucc')}}</div>
                            @php Session::forget('mailSucc'); @endphp
                        @endif

                        <div id="orders_table">
                            @include('all_orders.orderspagination')
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
                                    @if(isset($sent))
                                    url:"{{ url('allorders/?page=')}}"+page,
                                    @else
                                    url:"{{ url('allorders/create/?page=')}}"+page,
                                    @endif
                                    success:function(data)
                                    {
                                        $('#orders_table').html(data);
                                    }
                                });
                            }
                        });
                    </script>
                </div>
            </div>

        </div>
    </div>
    <!-- .animated -->

<!-- .content -->

</div>
@for ($i = 0; $i< Session::get('count'); $i++) <!-- start delete modal -->
    <div class="modal fade" id="exampleModalCenter{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="exampleModalCenterTitle">Send Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="done{{$i}}">Please upload your Invoice</p>
                    <div  class="text-center">
                        <img src="{{url('public/assets/images/invoices/default.png')}}" id="img1{{$i}}"  style="cursor: pointer;">
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{url('orderMail')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input id="inputUpload{{$i}}" style="display: none;" name="invoice" type="file" accept=".png,.jpg,.jpeg" onchange="showPhoto{{$i}}()" />
                        <input type="hidden" name="order_id" id="hiddenModal{{$i}}">
                        <button type="submit" class="btn btn-primary rounded" id="send"> Send Mail <i class="fa fa-envelope"> </i> </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        pass = document.getElementById("hidd{{$i}}").value;
        document.getElementById("hiddenModal{{$i}}").value = pass;

        $('#img1{{$i}}').click(function () {
            $('#inputUpload{{$i}}').click();
        });
        $('#send').click(function(){
            $(this).html("");
            $(this).html("Sending ... &nbsp; <i class='ti-email'></i>").fadeIn();
        });



        function showPhoto{{$i}}() {
            var file = document.getElementById('inputUpload{{$i}}').files[0];
            console.log(file);
            reader = new FileReader();
            // console.log(reader);
            reader.onloadend = function () {
                $('#img1{{$i}}').attr('src',reader.result);
                // console.log(reader.result);
                $("#done{{$i}}").html("");
                $("#done{{$i}}").html("The file has been uploaded");
                $("#done{{$i}}").attr("class","text-success font-weight-bold");
            };

            reader.readAsDataURL(file);
        }

    </script>
    <!-- end delete modal  -->
@endfor
<!-- /#right-panel -->
@include('layouts.footer')
