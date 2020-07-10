
@include('layouts.header')
@include('layouts.nav')
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Table</strong>
                            </div>
                            <div class="card-body">
                                <div id="all_sub_table">
                                    @include('all_subcategories.all_sub_pagination')
                                </div>
                            </div>

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
                                    url:"{{ url('subcategories/?page=')}}"+page,
                                    success:function(data)
                                    {
                                        $('#all_sub_table').html(data);

                                    }
                                });
                            }
                        });
                        </script>

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        <span style="display:none">
            {{ Session::get('count') }}</span>
            @for ($i = 1; $i <= Session::get('count'); $i++)
            <div class="modal fade" id="smallmodal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="smallmodalLabel">Delete Sub Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                Are you sure, you want to delete this Sub Category ?

                            </p>
                        </div>
                        <form action="sub_category/2" method="POST">
                            @method('delete')
                            {{ csrf_field() }}
                            <div class="modal-footer">
                                <input type="hidden" name="sub_cate_id" id="inputModal{{$i}}">
                                <button type="submit" class="btn btn-danger rounded">Delete</button>
                                <button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <script>
                pass = document.getElementById("input{{$i}}").value;
                document.getElementById("inputModal{{$i}}").value = pass;
            </script>
@endfor
@include('layouts.footer')
