@include('layouts.header')
@include('layouts.nav')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5">
            
            






            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($singleProducts as $im)
                    <div class="carousel-item {{$loop->index == 0 ? 'active' : ' '}}">
                        <img src="{{url('public/assets/images/products/'.$im->image_name)}}" class="d-block w-100" alt="{{$im->image_id}}">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="card" style="border:none">
                <div class="card-body card-block">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="row form-group">
                            <div class="col col-md-5"><strong><label class=" form-control-label">product name :</label></strong></div>
                            <div class="col-12 col-md-7">
                            <strong><p class="form-control-static"><strong>{{$singleProduct->name}}</strong></p></strong>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-5"><strong><label class=" form-control-label">supplier name :</label></div></strong>
                            <div class="col-12 col-md-7">
                             <p class="form-control-static"><strong>{{$singleProduct->supplier_name}}</strong></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body card-block">
                   
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label class=" form-control-label">Category :</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <p class="form-control-static">{{$singleProduct->category_name}}</p>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label class=" form-control-label">sub-category :</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <p class="form-control-static">{{$singleProduct->sub_cate_name}}</p>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label class=" form-control-label">brand :</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static">{{$singleProduct->brand_name}}</p>
                                </div></div>
                                <div class="row form-group">
                            <div class="col col-md-4"><label class=" form-control-label">model :</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static">{{$singleProduct->model_name}}</p>
                                </div></div>
                                <div class="row form-group">
                            <div class="col col-md-4"><label class=" form-control-label">price :</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static">{{$singleProduct->price}}</p>
                                </div></div>
                                <div class="row form-group">
                            <div class="col col-md-4"><label class=" form-control-label">stock quantity :</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static">{{$singleProduct->stock_quantity}}</p>
                                </div></div>
                                <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">discount :</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static">{{$singleProduct->discount}}</p>
                                </div></div>
                                <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">country :</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static">{{$singleProduct->country}}</p>
                                </div></div>
                                <div class="row form-group">
                                <div class="col col-md-4"><label class=" form-control-label">details :</label></div>
                                <div class="col-12 col-md-8">
                                    <p class="form-control-static">{!!$singleProduct->details!!}</p>
                                </div></div>   
                   
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Uren's Single Product Sale Area End Here -->

        <!-- Begin Uren's Single Product Tab Area -->
        <div class="sp-product-tab_area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sp-product-tab_nav">
                            <div class="product-tab">
                                <ul class="nav product-menu">
                                    <li><a data-toggle="tab" href="#specification"><span>Specification</span></a></li>
                                    <li><a data-toggle="tab" href="#reviews"><span>Reviews </span></a></li>
                                </ul>
                            </div>
                            <div class="tab-content uren-tab_content">
                                <div id="specification" class="tab-pane" role="tabpanel">
                                    <table class="table table-bordered specification-inner_stuff">
                                        <tbody>
                                            @foreach($singleSpecification as $s)
                                            <tr>
                                                <td colspan="2"><strong>{{$s->specification}}</strong></td>
                                                <td colspan="2"><strong>{{$s->specification_value}}</strong></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="reviews" class="tab-pane" role="tabpanel">
                                    <div class="tab-pane active" id="tab-review">
                                        <form class="form-horizontal" id="form-review">
                                            <div id="review">
                                                <table class="table table-striped table-bordered">
                                                    <tbody>
                                                    @foreach($singleRating as $r)
                                                        <tr>
                                                            <td style="width: 50%;"><strong>{{$r->first_name}}{{$r->last_name}}</strong></td>
                                                            <td class="text-right">{{$r->date}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <p>{{$r->comment}}</p>
                                                                <div class="rating-box">
                                                                    <ul>
                                                                        <li><i class="ion-android-star"></i></li>
                                                                        <li><i class="ion-android-star"></i></li>
                                                                        <li><i class="ion-android-star"></i></li>
                                                                        <li><i class="ion-android-star"></i></li>
                                                                        <li><i class="ion-android-star"></i></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@include('layouts.footer')