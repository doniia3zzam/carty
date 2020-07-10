<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class all_categories_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories= DB::table('categories')->select('*')->orderBy('category_status')->paginate(5);
        return view('all_categories.show-cat',compact('categories'));
        // $results= DB::select('SELECT * FROM categories ORDER BY category_status');
        // return view('/all_categories/show-cat',['categories'=>$results]);

    }
    public function fetch_data(Request $request){
        if($request->ajax()){
            $categories= DB::table('categories')->select('*')->orderBy('category_status')->paginate(5);
            return view('all_categories.all_categories_pagination',compact('categories'))->render();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('/all_categories/add-cat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'category_name'=>'required',
                'category_photo_name'=>'required|image'
            ],
            [
                'name.required'=>'Write Category Name',

            ]
            );
            $photoName = time() . '.' . $request->category_photo_name->extension();
            $photoPath = 'public/assets/images/categories/';
            $request->category_photo_name->move($photoPath,$photoName);

            $movedPhoto = $photoPath . $photoName;
            // $userCat = 'cartyuser/assets/images/featured-categories/'.$photoName;
            usleep(1000* 1000); 
            // copy($movedPhoto,$userCat);
    
            $data = $request->except(['_token']);
            $data['category_photo_name'] = $photoName;
            DB::table('categories')->insert($data);
            // var_dump($data);
            return back()->with('success','You successfully Added Category.');

            //  return redirect('category');

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
        //
        $result= DB::select('select * from categories where category_id=?',[$id]);
        return view('/all_categories/add-cat',['category'=>$result[0]]);

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
        //
        $data = $request->all();
        if(isset($data['category_photo_name']))
        {

        $photoName = time().'.'.$request->category_photo_name->extension();
        $photoPath = 'public/assets/images/categories/';
        $request->category_photo_name->move($photoPath,$photoName);

        $movedPhoto = $photoPath . $photoName;
        // $userCat = 'cartyuser/assets/images/featured-categories/'.$photoName;
        usleep(1000* 1000); 
        // copy($movedPhoto,$userCat);

        $data = $request->except(['_token','_method','category_photo_name']);
        $data['category_photo_name'] = $photoName;
        DB::update('UPDATE categories SET category_name = ? , category_photo_name=? WHERE category_id = ? ',
        [$data['category_name'],$data['category_photo_name'],$id]);
        //  var_dump($data);
        }else{
            $data = $request->except(['_method','_token']);
            DB::update('UPDATE categories SET category_name = ? WHERE category_id = ? ',
            [$data['category_name'],$id]);
        }
        return redirect('category');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $data = $request->except('_token','_method');
        DB::delete('DELETE FROM categories WHERE category_id = ?',[$data['category_id']]);
        return redirect('category');

    }
    public function status($id,$st)
    {
        DB::update('UPDATE categories SET category_status = ? WHERE category_id = ?',[!$st,$id]);
        return redirect('category');
    }
}
