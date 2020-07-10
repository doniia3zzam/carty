@include('layouts.header')
@include('layouts.nav')
<div class="invoice-box"  >
        <div class="text-right">
            <button id="TSS" class="btn btn-primary rounded text-right m-auto"> Download <i class="fa  fa-download"> </i> </button>
        </div>
        <script>
            $(document).ready(function () { 
                $('#TSS').click(function () { 
                    domtoimage.toBlob(document.getElementById('invoiceImg')).then(function (blob) {
                            window.saveAs(blob, 'order {{$ordercustomer->order_id}}.png');
                        });
    
                 });
             });
        </script>
        <table style="background-color: #eee" id='invoiceImg'>
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{url('public/assets/images/logo/2.png')}}" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                Invoice #: {{$ordercustomer->order_id}} <br>
                                Created: {{$ordercustomer->date}}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information table table-bordered ">
                <td colspan="6">
                    <table >
                        <tr>
                            <td>
                                carty comp. for car spare parts<br>
                                +2011 4489 5434<br>
                                www.carty.com<br>
                                 
                            </td>
                            
                            <td>
                                {{$ordercustomer->first_name}} {{$ordercustomer->last_name}}<br>
                                {{$ordercustomer->phone}}<br>
                                {{$ordercustomer->email}}<br>
                                {{$ordercustomer->floorNo}} {{$ordercustomer->buildingNo}} {{$ordercustomer->customerAddress}} {{$ordercustomer->area}} {{$ordercustomer->name}}
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td colspan="6">
                    Payment Method
                </td>
                
            </tr>
            
            <tr class="details">
                <td>
                {{$ordercustomer->type}}
                </td>
            </tr>
            
            <tr class="heading text-center">
                <td >
                    Item
                </td>
                <td >
                    Quantity
                </td>
                
                <td >
                    discount
                </td>
                <td >
                    Price
                </td>
                <td >
                    sup-total
                </td>
                <td style="text-align: center">
                    supplier adress
                </td>
            </tr>
            @php
            $t=0;
            @endphp
            @foreach($orderproduct as $pro)
            <tr class="item text-center">
                <td >
                {{$pro->name}}
                </td>
                

                <td >
                {{$pro->quantity}}
                </td>
                
                <td >
                {{$pro->discount*100}}%
                </td>
                <td >
                {{$pro->price}} EGP
                </td>
                <td >
               
                @php
                
                if ($pro->discount >0)
                {
                    $dis= $pro->discount * $pro->price;
                    $sup= ($pro->price - $dis) * $pro->quantity;
                    
                }
                else{
                    $sup= ($pro->price * $pro->quantity);
                }
                
                    $t+=$sup;
                    
                @endphp
                
                {{$sup}} EGP
                </td>
                <td style="text-align:center;">
                {{$pro->supplier_bulding_no}} {{$pro->supplier_street}} {{$pro->supplier_area}} {{$pro->city_name}}
                </td>
                
            </tr>
            
            @endforeach

            <tr class="total">
            
                <td colspan="6">
                    <div class="container-fluid" style="padding:0px 0px">
                        <div class="row">
                        <div class="col-lg-6"> </div>
                            <div class="col-lg-6"> 
                                <div class="card" style="border:1px solid; background-color:#eee;">
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="row form-group">
                                                <div class="col col-md-6"><strong><label class=" form-control-label">
                                                    total of sub total:
                                                    @php 
                                                    $x=round($t,2)
                                                    @endphp
                                                    </label></div></strong>
                                                <div class="col-12 col-md-6">
                                                <p class="form-control-static"><strong>{{$x}} EGP</strong></p>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-6"><strong><label class=" form-control-label"> Tax: </label></strong></div>
                                                <div class="col-12 col-md-5">
                                                <strong><p class="form-control-static"><strong>14%</strong></p></strong>
                                                </div>
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-6"><strong><label class=" form-control-label">
                                                @php 
                                                    $s=$t * 0.14;
                                                    $to=round($t - $s);
                                                @endphp
                                                    total after tax:

                                                    </label></div></strong>
                                                <div class="col-12 col-md-6">
                                                <p class="form-control-static"><strong>{{$to}} EGP</strong></p>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-6"><strong><label class=" form-control-label"> 
                                                delivery:  </label></div></strong>
                                                <div class="col-12 col-md-6">
                                                <p class="form-control-static"><strong>20 EGP</strong></p>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-6"><strong><label class=" form-control-label"> @php $ft=$to+20;
                                                        @endphp
                                                        Final Total:</label></div></strong>
                                                <div class="col-12 col-md-6">
                                                <p class="form-control-static"><strong>{{$ft}} EGP</strong></p>
                                                </div>
                                            </div>
                                        </form>
                                        </div>   
                                    </div> 
                                </div>              
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        </div>
       
    
   

@include('layouts.footer')