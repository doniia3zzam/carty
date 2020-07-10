
@include('layouts.header')
@include('layouts.nav')

<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">All Admins</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered  text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>email</th>
                                            <th>photo</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <th>Activate</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($admins)==0)
                                        <tr> 
                                            <td> no admins </td>
                                        </tr>
                                        @else
                                        @foreach($admins as $admin)
                                        <tr>
                                            <td>{{$admin->id}}</td>
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->email}}</td>
                                            <td><img src="{{url($admin->admin_photo)}}" style="width:100px;height:100px;"></td>

                                            <td>
                                           

                                            <a href="admin/{{$admin->id}}/edit" class="btn btn-warning rounded"> <i class="fa fa-edit"></i> </a>


                                            

                                            
                                            </td>
                                            <td> <form method="post" action="admin/{{$admin->id}}">
                                                @method('delete')
                                                @csrf                                                
                                                <button type="submit" class="btn btn-danger rounded"> <i class="ti-trash"></i> </button>

                                                </form>
                                            
                                            </td>
                                            <td>
                                                <a href="admin/{{$admin->id.'/'.$admin->admin_status}}" class="switch switch-3d switch-success mr-3">
                                                    <input type="checkbox" class="switch-input " {{ $admin->admin_status == 0 ? '' : 'checked="true"'}} > 
                                                        <span class="switch-label"></span> 
                                                        <span class="switch-handle"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->




@include('layouts.footer')