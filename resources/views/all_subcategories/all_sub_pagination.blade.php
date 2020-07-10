<table id="bootstrap-data-table-export" class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Photo</th>
            <th>Category</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @if(count($subcategories)==0)
        <tr>
            <td class="align-middle"> no subcategories </td>
        </tr>
        @else
        @foreach($subcategories as $subcategory)
        <tr>
            <td class="align-middle">{{$subcategory->sub_cate_id}}</td>
            <td class="align-middle">{{$subcategory->sub_cate_name}}</td>
            <td class="align-middle"><img src="{{url('public/assets/images/subcategories/'.$subcategory->subcategory_photo)}}" style="width:100px;height:100px;"></td>
            <td class="align-middle">{{$subcategory->category_name}}</td>
            <td class="align-middle">
                <a href="{{url('sub_category/'.$subcategory->sub_cate_id.'/'.$subcategory->sub_cate_status)}}" class="switch switch-3d switch-success mr-3">
                    <input type="checkbox" class="switch-input " {{ $subcategory->sub_cate_status == 0 ? '' : 'checked="true"'}} >
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                </a>
            </td>
            <td class="align-middle">
                <a href="sub_category/{{$subcategory->sub_cate_id}}/edit" class="btn btn-warning rounded"><i class="fa fa-edit"></i></a>

                <a data-toggle="modal" data-target="#smallmodal{{$loop->iteration}}" href="#" class="btn rounded btn-danger"><span class="ti-trash"></span></a>
                <input type="hidden" value="{{$subcategory->sub_cate_id}}" id="input{{$loop->iteration}}">
            </td>
        </tr>
        {{ Session::put('count',$loop->count) }}
        @endforeach
        @endif
    </tbody>
</table>
{!! $subcategories->links() !!}
