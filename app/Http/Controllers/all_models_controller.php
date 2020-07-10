<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class all_models_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models=DB::table('view_models')->select('*')->orderBy('model_status')->paginate(5);
        return view('all_models.allmodels',compact('models'));
    //    $models = DB::select('SELECT * FROM view_models ORDER BY model_status');
    //     return view('/all_models/allmodels',[
    //         'models'=>$models
    //     ]);

    }
    public function fetch_data(Request $request){
        if($request->ajax()){
            $models=DB::table('view_models')->select('*')->orderBy('model_status')->paginate(5);
            return view('all_models.allmodels_pagination',compact('models'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = DB::select('SELECT * FROM `brands`');
        return view('/all_models/addmodel',[
            'brands'=>$brands

        ]);


    //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    $request->validate(
        [
            'model_name'=>'required',
            'model_image'=>'required|image',
            'brand_id'=>'required'

        ],
        [
            'model_name.required'=>'Write model Name',
            'brand_id.required'=>'The model field is required.'
        ]
        );
        $imgName = time() . '.' . $request->model_image->extension();
        $photoPath = 'public/assets/images/models/';
        $request->model_image->move($photoPath,$imgName);

        $movedPhoto = $photoPath . $imgName;
        $userModel = 'cartyuser/assets/images/models/'.$imgName;
        usleep(1000* 1000); 
        copy($movedPhoto,$userModel);


        $data =$request->except(['_token']);
        $data['model_image']=$imgName;
        DB::table('model')->insert($data);
        //
            // var_dump($data);

        return redirect('model');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = DB::select('SELECT * FROM model WHERE model_id = ?',[$id]);
        $result2 = DB::select('SELECT * FROM `brands`');
        return view('/all_models/addmodel',[
            'model'=>$result[0],
            'brands'=>$result2
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'model_name'=>'required',
        ]);
        $data = $request->all();
        if(isset($data['model_image'])){

        $imgName= time() . '.' . $request->model_image->extension();
        $photoPath = 'public/assets/images/models/';
        $request->model_image->move($photoPath,$imgName);

        $movedPhoto = $photoPath . $imgName;
        $userModel = 'cartyuser/assets/images/models/'.$imgName;
        usleep(1000* 1000); 
        copy($movedPhoto,$userModel);

        $data = $request->except(['_token','_method','model_image']);
        $data['model_image'] = $imgName;
        DB::update('UPDATE model SET model_name = ? , model_image = ?  WHERE model_id = ? ',
        [$data['model_name'],$data['model_image'],$id]);


        }

        else{
            $data = $request->except(['_method','_token']);
            DB::update('UPDATE model SET model_name = ?  WHERE model_id = ? ',
            [$data['model_name'],$id]);
            var_dump($data);
            }
        return redirect('model');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->except('_token','_method');
        DB::delete('DELETE FROM model WHERE model_id = ?',[$data['model_id']]);
        return redirect('model');
    }

    public function status($id,$st)
    {
        DB::update('UPDATE model SET model_status = ? WHERE model_id = ?',[!$st,$id]);
        return redirect('model');
    }
}
