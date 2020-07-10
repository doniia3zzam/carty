<table id="bootstrap-data-table-export" class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Stock Quantity</th>
            <th>views</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($allproducts_supp_page as $pro)
        <tr>
            <td><a href="{{url('/supp_pro/'.$pro->product_id.'/'.$pro->supplier_id)}}"><img src= "{{url('public/assets/images/products/'.$pro->image_name)}}" alt="{{$pro->product_id}}" style="width:100px;height:100px;"></a></td>

            <td class="align-middle"><a href="{{url('/supp_pro/'.$pro->product_id.'/'.$pro->supplier_id)}}">{{$pro->name}}</a></td>
            <td class="align-middle">{{$pro->price}}</td>
            <td class="align-middle">{{$pro->discount * 100}} %</td>
            <td class="align-middle">{{$pro->stock_quantity}}</td>
            <td class="align-middle">{{$pro->views}}</td>
            <td class="align-middle">

                <a href="{{url('supp_pro/'.$pro->product_id.'/'.$pro->supplier_id.'/'.$pro->product_status)}}" class="switch switch-3d switch-success mr-3">
                    <input type="checkbox" class="switch-input" {{ $pro->product_status == 0 ? '' : 'checked="true"' }} >
                    <span class="switch-label"></span>
                    <span class="switch-handle"></span>
                </a>

            </td>
            <td class="align-middle">
                    <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter{{$loop->index}}" ><i class="ti-trash"></i></button>
                    <input type="hidden" id="hidd{{$loop->index}}" value="{{$pro->product_id}}">
                    <input type="hidden" name="" id="hiddOrder{{$loop->index}}" value="{{$pro->supplier_id}}">
            </td>
        </tr>
        @if($loop->count)
        {{Session::put('count',$loop->count)}}
        @endif
        @endforeach
    </tbody>
</table>
{{ $allproducts_supp_page->links() }}
