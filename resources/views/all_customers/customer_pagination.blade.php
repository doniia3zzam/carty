
<table id="bootstrap-data-table-export" class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($all_customer) == 0)
            <tr>
                <td class="align-middle">No customer</td>
            </tr>
        @else
        @foreach ($all_customer as $cust)


        <tr>
            <td class="align-middle">{{$cust->customer_id}}</td>
            <td class="align-middle">
                <a href="{{'customer/'.$cust->customer_id}}">
                <img src="{{ url('public/assets/images/customer/'.$cust->photo_name) }}" alt="" style="width:70px;height:70px">
                </a>
            </td >
            <td class="align-middle">

                <a href="{{'customer/'.$cust->customer_id}}"> {{ $cust->first_name }} {{$cust->last_name}}</a>
            </td>
            <td class="align-middle">{{ $cust->email }}</td>
            <td class="align-middle">
                <a href="status/{{ $cust->customer_id.'/'.$cust->customer_status }}" class="switch switch-3d switch-success mr-3">
                    <input type="checkbox" class="switch-input" {{ $cust->customer_status == 0 ? '' : 'checked="true"' }} >
                    <span class="switch-label" ></span>
                    <span class="switch-handle"></span>
                </a>
            </td>
            <td class="align-middle">
                <a data-toggle="modal" data-target="#smallmodal{{$loop->iteration}}" href="#" class="btn btn-danger rounded">
                    <span class="ti-trash"></span>
                </a>
                    <input type="hidden" value="{{$cust->customer_id}}" id="input{{$loop->iteration}}">
                {{-- <button class="btn btn-outline-danger" style="border-raduis:20%"><span class="ti-trash"></span></button> --}}
            </td>
        </tr>
        {{ Session::put('count',$loop->count) }}
        @endforeach
        @endif
    </tbody>
</table>
{!! $all_customer->links() !!}
