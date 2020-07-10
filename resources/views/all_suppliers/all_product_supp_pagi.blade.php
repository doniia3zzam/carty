<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col">Stock Quntity</th>
            <th scope="col">Model</th>
            <th scope="col">Brand</th>
            <th scope="col">Catigory</th>
            <th scope="col">Sub Catigory</th>
            <th scope="col">Active</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @if(count($products)==0)
        <tr>
            <td>No Products</td>
        </tr>
        @else
        @foreach ($products as $p )



            <tr>
                <th scope="row">{{ $p->product_id }}</th>
                <td>{{ $p->name }}</td>
                <td>{{ $p->price }}</td>
                <td>{{ $p->stock_quantity }}</td>


                <td>{{ $p->model_name }}</td>
                <td>{{ $p->brand_name }}</td>

                <td>{{ $p->category_name }}</td>
                <td>{{ $p->sub_cate_name }}</td>

                <td>
                    <a href="{{url('status/'.$p->product_id.'/'.$p->supplier_id.'/'.$p->product_status)}}" id="don{{$loop->index}}" class="switch switch-3d switch-success mr-3">
                        <input type="checkbox" class="switch-input" {{ $p->product_status == 0 ? '' : 'checked="true"' }} >
                        <span class="switch-label" ></span>
                        <span class="switch-handle"></span>
                    </a>
                </td>

                <td>
                    {{-- <form method="post" action="{{url('supplier/'.$p->product_id.'/'.$p->supplier_id)}}">
                        @method('DELETE')
                        @csrf
                    </form> --}}
                    <button type="button"  data-toggle="modal" data-target="#exampleModalCenter{{$loop->index}}" class="btn btn-danger rounded"><span class="ti-trash"></span></button>

                    <input type="hidden" id="hidd{{$loop->index}}" value="{{$p->product_id}}">
                    <input type="hidden" name="" id="hiddOrder{{$loop->index}}" value="{{$p->supplier_id}}">
                </td>
            </tr>
            @if($loop->count)
            {{Session::put('count',$loop->count)}}
            @endif

        @endforeach
        @endif
    </tbody>

</table>
{!! $products->links() !!}
