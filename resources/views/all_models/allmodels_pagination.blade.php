<table id="bootstrap-data-table-export" class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>model_name</th>
            <th>model_image</th>
            <th>brand_name </th>
            <th>Active</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($models)==0)
            <tr>
              <td class="align-middle"> no models</td>
            </tr>
          @else
            @foreach($models as $model)
               <tr>
                    <td class="align-middle">{{$model->model_id}}</td>
                      <td class="align-middle">{{$model->model_name }}</td>
                     <td class="align-middle"><img src ="{{url('public/assets/images/models/'.$model->model_image)}}" style="width:100px;height:100px;" ></td>
                    <td class="align-middle">{{$model->brand_name}}</td>
                    <td class="align-middle">
                        <a href="{{url('model/'.$model->model_id.'/'.$model->model_status)}}" class="switch switch-3d switch-success mr-3">
                            <input type="checkbox" class="switch-input " {{ $model->model_status == 0 ? '' : 'checked="true"'}} >
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                        </a>
                    </td>
                  <td class="align-middle">
                    <a href="{{url('model/'.$model->model_id.'/edit')}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                    <a data-toggle="modal" data-target="#smallmodal{{$loop->iteration}}" href="#" class="btn rounded btn-danger"><span class="ti-trash"></span></a>
                    <input type="hidden" value="{{$model->model_id}}" id="input{{$loop->iteration}}">
                   </td>
                </tr>
                {{ Session::put('count',$loop->count) }}
            @endforeach
          @endif
        </tbody>
</table>
{!! $models->links() !!}
