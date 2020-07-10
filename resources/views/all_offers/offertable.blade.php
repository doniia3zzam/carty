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
                            <div class="card-body" id="table_data">
                                    @include('all_offers.pagination_data')
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

<script>
$(document).ready(function(){
    $(document).on('click','.pagination a',function(event){
        console.log('gg');
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        console.log(page)
       fetch_data(page);
    });
    function fetch_data(page){
        $.ajax({
            url:"offer?page="+page,
            success:function(data)
            {
                $('#table_data').html("");
                $('#table_data').html(data);
            }
        });
    }
});
</script>

@include('layouts.footer')
