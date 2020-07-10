<table id="bootstrap-data-table-export" class="table table-striped table-bordered text-center">
    <thead>
      <tr>
          <th>#</th>
          <th>brand-name</th>
           <th>brand-image</th>
           <th>Active</th>
          <th>Action</th>
         </tr>
    </thead>
    <tbody>
        @if(count($brands)==0)
           <tr>
              <td> no brands</td>
           </tr>
        @else
             @foreach($brands as $brand)
                <tr>
                    <td class="align-middle">{{$brand->brand_id }}</td>
                    <td class="align-middle">{{$brand->brand_name}}</td>
                    <td class="align-middle"><img src ="{{url('public/assets/images/brands/'.$brand->brand_image)}}" style="width:100px;height:100px;" ></td>
                    <td class="align-middle">
                        <a href="{{url('brand/'.$brand->brand_id.'/'.$brand->brand_status)}}" class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" class="switch-input " {{ $brand->brand_status == 0 ? '' : 'checked="true"'}} >
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                        </a>
                    </td>
                    <td class="align-middle">
                        <a href="brand/{{$brand->brand_id}}/edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>

                        <a data-toggle="modal" data-target="#smallmodal{{$loop->iteration}}" href="#" class="btn rounded btn-danger"><span class="ti-trash"></span></a>
                        <input type="hidden" value="{{$brand->brand_id}}" id="input{{$loop->iteration}}">
                  </td>
                </tr>
                {{ Session::put('count',$loop->count) }}
            @endforeach
          @endif
    </tbody>
</table>
{!! $brands->links() !!}
