@include('layouts.header')
@include('layouts.nav')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            @foreach($product as $pro)
            <div class="col-md-3">
                <div class="card">
                    
                    <div class="card-body row">
                       
                            <div class="card-body text-center">
                                <div class="product-img">
                                    <a href="{{url('showPro/'.$pro->product_id.'/'.$pro->offer_id)}}">
                                        <img class="primary-img" style="width:250px; height:250px;" src="{{url('public/assets/images/products/'.$pro->image_name)}}" alt="Uren's Product Image">
                                    </a>
                                </div>
                                <br>
                                <div class="product-content">
                                    <h6><a class="product-name" href="{{url('showPro/'.$pro->product_id.'/'.$pro->offer_id)}}">{{$pro->name}}</a></h6>
                                    <div class="price-box">
                                        <span class="new-price"><b>{{$pro->price}} EGP</b></span>
                                    </div>
                                    <div class="product-short_desc">
                                        <p> {!!$pro->detials!!} </p>
                                    </div>
                                </div>

                            </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div><!-- .animated -->
</div>



@include('layouts.footer')
