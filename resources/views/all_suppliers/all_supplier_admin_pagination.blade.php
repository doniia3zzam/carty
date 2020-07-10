<table id="bootstrap-data-table-export" class="table table-striped table-bordered text-center" id="myTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Shop Name</th>
            <th>Email</th>
            <th>Date</th>
            <th>Products</th>
            <th>Add Address</th>
            <th>Action</th>
            <th>Stauts</th>
        </tr>
    </thead>
    <tbody>
        @if(count($suppliers)==0)
            <tr>
                <td>No Suppliers</td>
            </tr>
        @else
            @foreach ($suppliers as $s )
                <tr>
                    <td><a href="supplier/{{$s->supplier_id}}">{{ $s->supplier_name }}</a></td>
                    <td>{{ $s->shop_name }}</td>
                    <td>{{ $s->email }}</td>
                    <td>{{$s->supp_reg_date}}</td>
                    <td><a href="allproduct/{{$s->supplier_id}}" class="btn rounded btn-info"><i class="fa fa-eye"></a></td>
                    <td>
                        <a data-toggle="modal" data-target="#addmodal{{$loop->iteration}}" href="#"
                            class="btn btn-warning rounded" id='test{{$loop->iteration}}' test{{$loop->iteration}}="{{$loop->iteration}}"><i class="fa fa-plus text-light"></i></a>

                        <input type="hidden" value="{{$s->supplier_id}}" id="add{{$loop->iteration}}">
                        </td>
                    <td>

                    <a data-toggle="modal" data-target="#smallmodal{{$loop->iteration}}" href="#" class="btn rounded btn-danger"><span class="ti-trash"></span></a>
                    <input type="hidden" value="{{$s->supplier_id}}" id="input{{$loop->iteration}}">
                </td>
                    <td>
                        <a href="supplierStatus/{{ $s->supplier_id.'/'.$s->supplier_status }}" id="don{{$loop->index}}" class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" class="switch-input" {{ $s->supplier_status == 0 ? '' : 'checked="true"' }} >
                            <span class="switch-label" ></span>
                            <span class="switch-handle"></span>
                        </a>
                    </td>
                </tr>
                {{ Session::put('count',$loop->count) }}
            @endforeach
        @endif
    </tbody>
</table>
{!!$suppliers->links()!!}
