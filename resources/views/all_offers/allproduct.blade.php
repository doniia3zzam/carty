@include('layouts.header')
@include('layouts.nav')
<div class="content mt-3 ">
 <form method="post" action="{{url('storeproduct/'.$id.'/add')}}"enctype="multipart/form-data" class="form-horizontal">

    <div class="animated fadeIn">
        <div class="row ">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Table</strong>
                    </div>
                    @if(Session::has('Failed'))
                    <div class="alert alert-danger">{{Session::get('Failed')}}</div>
                    @php Session::forget('Failed'); @endphp @endif
                    <div class="card-body row ">
                      @foreach($product as $pro)
                           {{csrf_field()}}
                            <div class=" col-lg-4 col-12">
                                <input type="checkbox" name="product_id[]"  value="{{$pro->product_id}}"/>
                                
                                <input type="hidden" name="supp_id[]" value="{{$pro->supplier_id}}"/>
                                   
                            
                                <div class="card" style="width: 18rem;">
                                   
                                    <img src="{{url('public/assets/images/products/'.$pro->image_name)}}" alt="Uren's Product Image" class="card-img-top" >
                                    <div class="card-body">
                                        <h6 class="card-title">{{$pro->name}}</h6>
                                        <span class="new-price">{{$pro->price}} EGP</span>
                                        <p class="card-text">{!!$pro->detials!!}</p>
                                        <label ><h5>discount percentage</h5> </label> 
                                        <input type="number" class="form-control" name="percentage[]" />
                                    </div>
                                </div>
                            </div>
                       
                           
                      @endforeach
                       
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
    <div class="my-5">
   
        <input type="submit" class="btn btn-success form-control col-5 offset-3  " value="save"/>
        
    </div>
 </form>              
</div>



@include('layouts.footer')
