<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class all_cities_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cities = DB::table('cities')->select('*')->orderBy('city_status')->paginate(5);
        return view('all_cities.allcities',compact('cities'));
        // $cities = DB::select('SELECT * FROM cities ORDER BY city_status');
        // return view('/all_cities/allcities',[
        //     'cities'=>$cities
        // ]);
    }
    public function fetch_data(Request $request){
        if($request->ajax()){
            $cities = DB::table('cities')->select('*')->orderBy('city_status')->paginate(5);
        return view('all_cities.allcities_pagination',compact('cities'))->render();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('all_cities.addcities');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'=>'required',


            ],
            [
                'name.required'=>'Write city Name',

            ]
            );

        $data =$request->except(['_method','_token']);

        // var_dump($data);
        DB::table('cities')->insert($data);
        //

        return redirect('city');
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
        $result = DB::select('SELECT * FROM cities WHERE city_id = ?',[$id]);

        return view('/all_cities/addcities',[
            'city'=>$result[0]
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
        $data = $request->except(['_token']);
        DB::update(' UPDATE cities SET name=? WHERE city_id =?',
        [$data['name'],$id]);
        // var_dump($data);
        return redirect('city');
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
        DB::delete('DELETE FROM cities WHERE city_id = ?',[$data['city_id']]);
        return redirect('city');
    }


    public function status($id,$st)
    {
        DB::update('UPDATE cities SET city_status = ? WHERE city_id = ?',[!$st,$id]);
        return redirect('city');
    }
}
