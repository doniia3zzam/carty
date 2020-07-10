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
        @if(count($cities)==0)
              <tr>
              <td> no cities</td>
             </tr>
               @else
              @foreach($cities as $city)
                <tr>
                  <td class="align-middle">{{$city->city_id}}</td>
                    <td class="align-middle">{{$city->name}}</td>
                    <td class="align-middle">
                        <a href="{{url('city/'.$city->city_id.'/'.$city->city_status)}}" class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" class="switch-input " {{ $city->city_status == 0 ? '' : 'checked="true"'}} >
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                        </a>
                    </td>

                  <td class="align-middle">
                    <a href="city/{{$city->city_id}}/edit"  class="btn btn-warning"><i class="fa fa-edit"></i></a>
                    <a data-toggle="modal" data-target="#smallmodal{{$loop->iteration}}" href="#" class="btn rounded btn-danger"><span class="ti-trash"></span></a>
                        <input type="hidden" value="{{$city->city_id}}" id="input{{$loop->iteration}}">
                 </td>
                </tr>
                {{ Session::put('count',$loop->count) }}
              @endforeach
        @endif
  </tbody>
</table>
{!! $cities->links() !!}
