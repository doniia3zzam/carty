<table id="bootstrap-data-table-export" class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Photo</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @if(count($categories)==0)
        <tr>
            <td class="align-middle"> no categories </td>
        </tr>
        @else
        @foreach($categories as $category)
        <tr>
            <td class="align-middle">{{$category->category_id}}</td>
            <td class="align-middle">{{$category->category_name}}</td>
            <td class="align-middle"><img src="{{url('public/assets/images/categories/'.$category->category_photo_name)}}" style="width:100px;height:100px;"></td>
            <td class="align-middle">
                <a href="category/{{$category->category_id.'/'.$category->category_status}}" class="switch switch-3d switch-success mr-3">
                    <input type="checkbox" class="switch-input " {{ $category->category_status == 0 ? '' : 'checked="true"'}} >
                    <span class="switch-label"></span>
                    <span class="switch-handle"></span>
                </a>
            </td>
            <td class="align-middle">
                <a href="category/{{$category->category_id}}/edit" class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>
                <a data-toggle="modal" data-target="#smallmodal{{$loop->iteration}}" href="#" class="btn rounded btn-danger"><span class="ti-trash"></span></a>
                <input type="hidden" value="{{$category->category_id}}" id="input{{$loop->iteration}}">
            </td>
        </tr>
        {{ Session::put('count',$loop->count) }}
        @endforeach
        @endif
    </tbody>
</table>
{!! $categories->links() !!}
