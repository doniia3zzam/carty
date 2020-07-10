<table id="bootstrap-data-table-export" class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @if(count($payments)==0)
        <tr>
            <td class="align-middle"> no payments </td>
        </tr>
        @else
        @foreach($payments as $payment)
        <tr>
            <td class="align-middle">{{$payment->payment_id}}</td>
            <td class="align-middle">{{$payment->type}}</td>
            <td class="align-middle">
                <a href="payment/{{$payment->payment_id.'/'.$payment->payment_status}}" class="switch switch-3d switch-success mr-3">
                    <input type="checkbox" class="switch-input " {{ $payment->payment_status == 0 ? '' : 'checked="true"'}} >
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                </a>
            </td>
            <td class="align-middle">
                <a href="payment/{{$payment->payment_id}}/edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                <a data-toggle="modal" data-target="#smallmodal{{$loop->iteration}}" href="#" class="btn rounded btn-danger"><span class="ti-trash"></span></a>
                <input type="hidden" value="{{$payment->payment_id}}" id="input{{$loop->iteration}}">
            </td>
        </tr>
        {{ Session::put('count',$loop->count) }}
        @endforeach
        @endif
    </tbody>
</table>
{!! $payments->links() !!}
