<table id="bootstrap-data-table-export" class="table table-striped table-bordered text-center">
    <thead class="text-dark">
        <tr>
            <th>Order id</th>
            <th>Customer name</th>
            <th>order's Total</th>
            <th>Shipping status </th>
            <th>Date</th>
            @isset($sent)
            <th>Upload Invoice</th>
            @endisset
        </tr>
    </thead>
    <tbody>
        @foreach($allorders as $order)
        <tr>
            <td><a href="{{url('order/'.$order->order_id)}}">{{$order->order_id}}</a></td>
            <td><a href="{{url('order/'.$order->order_id)}}">{{$order->first_name . ' ' .$order->last_name}}</a></td>
            <td>{{$order->total}}</td>
            <td>{{$order->status}}</td>
            <td>{{$order->date}}</td>
            @isset($sent)
            <td>
                <button data-toggle="modal" data-target="#exampleModalCenter{{$loop->index}}" type="button" class="btn btn-primary rounded"> <i class="fa fa-picture-o"></i></button>
                <input type="hidden" id="hidd{{$loop->index}}" value="{{$order->order_id}}">

            </td>
            @endisset
        </tr>
            @if($loop->count)
                {{Session::put('count',$loop->count)}}
            @endif
        @endforeach
    </tbody>
</table>
{!! $allorders->links() !!}
