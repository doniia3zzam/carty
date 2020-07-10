<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class all_brands_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = DB::table('brands')->select('*')->paginate(5);
        return view('all_brands.allbrands',compact('brands'));
        // $brands = DB::select('SELECT * FROM brands');
        // return view('/all_brands/allbrands',[
        //     'brands'=>$brands
        // ]);

    }
    public function fetch_data(Request $request){
        if($request->ajax()){
            $brands = DB::table('brands')->select('*')->paginate(5);
            return view('all_brands.brands_pagination',compact('brands'))->render();
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/all_brands/addbrand');
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
                'brand_name'=>'required',
                'brand_image'=>'required|image',


            ],
            [
                'brand_name.required'=>'Write brand Name',

            ]
            );
        $imgName= time() . '.' . $request->brand_image->extension();
        $photoPath = 'public/assets/images/brands/';
        $request->brand_image->move($photoPath,$imgName);
        $data =$request->except(['_token']);

        $movedPhoto = $photoPath . $imgName;
        // $userBrand = 'cartyuser/assets/images/brand/'.$imgName;
        usleep(1000* 1000); 
        // copy($movedPhoto,$userBrand);

        $data['brand_image']= $imgName;
        // var_dump($data);
        DB::table('brands')->insert($data);
        //

        return redirect('brand');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = DB::select('SELECT * FROM brands WHERE brand_id = ?',[$id]);


        return view('/all_brands/addbrand',[
            'brand'=>$result[0]
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
            'brand_name'=>'required',
        ]);


        $data = $request->all();
        if(isset($data['brand_image'])){

        $imgName= time() . '.' . $request->brand_image->extension();
        $photoPath = 'public/assets/images/brands/';
        $request->brand_image->move($photoPath,$imgName);

        $movedPhoto = $photoPath . $imgName;
        // $userBrand = 'cartyuser/assets/images/brand/'.$imgName;
        usleep(1000* 1000); 
        // copy($movedPhoto,$userBrand);

        $data = $request->except(['_token','_method','brand_image']);
        $data['brand_image'] =$imgName;
        DB::update('UPDATE brands SET brand_name = ? , brand_image = ? WHERE brand_id = ? ',
        [$data['brand_name'],$data['brand_image'],$id]);

        }

        else{
            $data = $request->except(['_method','_token']);
            DB::update('UPDATE brands SET brand_name = ?  WHERE brand_id = ? ',
            [$data['brand_name'],$id]);
            // var_dump($data);
            }
        // var_dump($data);
        return redirect('brand');
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
        DB::delete('DELETE FROM brands WHERE brand_id = ?',[$data['brand_id']]);
        return redirect('brand');
    }


    public function status($id,$st)
    {
        DB::update('UPDATE brands SET brand_status = ? WHERE brand_id = ?',[!$st,$id]);
        return redirect('brand');
    }
}
