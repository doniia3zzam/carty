@include('layouts.header') @include('layouts.nav')
@php
    $flag = 0;
    if(isset($delivered_products)){
        $flag = 1;
        $ordered_products = $delivered_products;
    }
    if(isset($cancelled_products)){
        $flag = 2;
        $ordered_products = $cancelled_products;
    }
@endphp

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="display-4  text-dark text-center">{{$flag ==1 ? 'Delivered Ordered Products' : ($flag == 2 ? 'Cancelled Ordered Products' : 'Pending Ordered Products')}}</div><br>
        <div class="row text-center">
        
            @if(Session::has('confirm'))
            <div class="alert alert-success h6 text-center">
                {{Session::get('confirm')}}
            </div>
            @php
                Session::forget('confirm');
                
            @endphp
            @endif

            @if(Session::has('Email'))
            <div class="alert alert-warning h6 text-center">
                {{Session::get('Email')}}
            </div>
            @php
                Session::forget('Email');
                
            @endphp
            @endif

            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Model</th>
                    @if($flag==0)
                    <th scope="col">Confirm</th>
                    <th scope="col">Cancel</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                    
                        {{-- @foreach ($delivered_products as $del) --}}
                   @isset($Pending)
                        @foreach ($ordered_products as $or)
                   
                    <tr>
                        <th scope="row">{{$or->order_id}}</th>
                        <td>{{$or->name}}</td>
                        <td>{{$or->quantity}}</td>
                        <td>{{$or->price}}</td>
                        <td>{{$or->brand_name}}</td>
                        <td>{{$or->model_name}}</td>
                        @if($flag == 0 )
                        <td>
                            <button data-toggle="modal" data-target="#setAddress{{$loop->index}}" class="btn btn-success rounded"><i class="ti-check"></i></button>
                            
                        </td>
                        <td>
                            <button  data-toggle="modal" data-target="#exampleModalCenter{{$loop->index}}" type="submit" class="btn btn-danger rounded"><i class="ti-trash"></i></button> 
                            <input type="hidden" id="hidd{{$loop->index}}" value="{{$or->orderd_pro_id}}">
                            <input type="hidden" name="" id="hiddOrder{{$loop->index}}" value="{{$or->order_id}}">
                        </td>
                        @endif
                    </tr>
                    {{-- get count of foreach  --}}
                    @if($loop->count)
                        {{Session::put('count',$loop->count)}}
                    @endif
                    {{-- get count of foreach  --}}
                @endforeach
                @endisset
                </tbody>
            </table>
        </div> 
    </div> 
</div>
{{-- pending modaals  --}}
@if($flag == 0)


@for ($i = 0; $i < Session::get('count'); $i++)
    <!-- start delete modal  -->
    <div class="modal fade" id="exampleModalCenter{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalCenterTitle">Order Cancellation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                Are you Sure you want to Cancel this Order ?
                <br>
                <div class="alert alert-warning d-block"> <b>This will reduce Your Bounce And affect Your Rating </b></div>
                </div>
                <div class="modal-footer">
                    
                    <form id="deleteForm{{$i}}" method="POST" action="{{url('Corders/'.Session::get('supplier')['supplier_id'])}}">
                    @method('DELETE')
                    @csrf
                        <input type="hidden" name="order_id" id="hiddenModalOrder{{$i}}">
                        <input type="hidden" name="orderd_pro_id" id="hiddenModal{{$i}}">
                        <input type="submit" class="btn btn-danger form-control" value="Yes, Sure">
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


@isset($Pending)
@for ($i = 0; $i < Session::get('count'); $i++)
    <!-- start delete modal  -->
    <div class="modal fade" id="setAddress{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalCenterTitle">Address Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('CONorders')}}" method="post">
                    @csrf
                    <div class="modal-body">
                    Please Choose a Branch To deliver 
                    <br>
                    <select name="supplier_lives_id" id="" class="form-control">
                        @foreach ($supplier_lives as $supplier_live)
                            <option value="{{$supplier_live->supplier_lives_id}}">{{$supplier_live->supplier_area}},{{$supplier_live->supplier_street}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="modal-footer">
                            <input type="hidden" name="orderd_pro_id" id="orderd_pro_id{{$i}}">
                            <input type="submit" class="btn btn-success rounded" value="Yes, Sure">
                    </div>
            </form>
            </div>
        </div>
    </div>
    <script>
        pass = document.getElementById("hidd{{$i}}").value;
        document.getElementById("orderd_pro_id{{$i}}").value = pass;
       
    </script>
    <!-- end delete modal  -->
@endfor
@endisset
@endif
{{-- end pending modal  --}}

@include('layouts.footer')