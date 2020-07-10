@include('layouts.header')
@include('layouts.nav')



<div class="container py-3 col-12 ">
@foreach($product as $pro)
<div class="card mb-3 p-3" style="max-width:100%;">
  <div class="row no-gutters ">
    <div class="col-md-4">
      <img src="{{url('public/assets/images/products/'.$pro->image_name)}}" class="card-img" alt="{{$pro->name}}">
    </div>
    <div class="col-md-8">
     
        <div class="card-body">
          <h4 class="card-title"><b>{{$pro->name}}</b></h4>
          <p class="card-text"><b>prouduct ID : </b>{{$pro->product_id}}</p>
          <p class="card-text"><b>Supplier ID : </b>{{$pro->supp_id}}</p>
          <p class="card-text"><b>Offer ID : </b>{{$pro->offer_id}}</p>
         <p class="card-text"> <b>price : </b>{{$pro->price}}</p>
          <p class="card-text"><b>discount : </b>{{$pro->discount}}</p>
          <p class="card-text"><b>model : </b>{{$pro->model_name}}</p>

          <p class="card-text"><b>brand : </b>{{$pro->brand_name}}</p>
          <p class="card-text"><b>categoty : </b>{{$pro->category_name}}</p>
          <p class="card-text"><b>subcategory : </b>{{$pro->sub_cate_name}}</p>
          
          </div>
        
    </div>
  </div>
</div>
@endforeach

</div>

@include('layouts.footer')




