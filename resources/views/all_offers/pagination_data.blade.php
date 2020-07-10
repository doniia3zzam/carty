
<div>
 <table id="bootstrap-data-table-export" class="table table-striped table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Offer ID</th>
                                            <th>Offer Title</th>
                                            <th>Short Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Photo</th>
                                            <th>Show</th>
                                            <th>Edit </th>
                                            <th>Delete</th>
                                            <th>Activate</th>


                                        </tr>
                                        <!-- hwa kda bya5od kym kolo 7ta ely m4 e5tarto aywa hatele form b2a kda  -->
                                    </thead>
                                    <tbody >

                                        @foreach($data as $offer)
                                            <tr>
                                            <form method="post" action="{{url('offer/'.$offer->offer_id)}}">
                                            {{csrf_field()}}
                                            @method('DELETE')

                                                <td>{{$offer->offer_id}}</td>
                                                <td>{{$offer->offer_title}}</td>
                                                <td>{{$offer->offer_short_desc}}</td>
                                                <td>{{$offer->start_date}}</td>
                                                <td>{{$offer->end_date}}</td>
                                                <td>
                                                <img style="width:50px; hieght:50px;"src="{{url('public/assets/images/offered/'.$offer->offer_photo_name)}}" id="img1"  style="cursor: pointer;">

                                                </td>
                                                <td><a class="btn btn-info rounded" href="{{url('offer/'.$offer->offer_id)}}"><i class="fa fa-eye"></i></a></td>
                                                    <td><a class="btn btn-seco  ndary btn btn-warning rounded" href="{{url('offer/'.$offer->offer_id.'/edit')}}"><i class="fa fa-pencil-square-o"></i></a></td>
                                                    <td>   <button type="submit" class="btn btn-danger rounded "><i class='fa fa-trash-o'></i> </button></td>

                                                    
                                                
                                                <td>
                                                <a href="{{url('test/'.$offer->offer_id.'/'.$offer->offer_status)}}" class="switch switch-3d switch-success mr-3">
                                                <input type="checkbox" class="switch-input" {{$offer->offer_status ? ' checked="true"' : ''}}>
                                                   <span class="switch-label"></span>
                                                    <span class="switch-handle"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                </table>
                                {{ $data->links() }}
                                        </div>