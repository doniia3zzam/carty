<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class all_sub_categories_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories=DB::table('view_all_subcategories')->select('*')->orderBy('sub_cate_status')->paginate(5);
        return view('all_subcategories.show-sub-cat',compact('subcategories'));
        
    }
    public function fetch_data(Request $request){
        if($request->ajax()){
            $subcategories=DB::table('view_all_subcategories')->select('*')->orderBy('sub_cate_status')->paginate(5);
            return view('all_subcategories.all_sub_pagination',compact('subcategories'))->render();
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
        $catnames=DB::select('SELECT * FROM categories ORDER BY category_name');
        return view('/all_subcategories.add-sub-cat',
            [
             'catnames'=>$catnames
            ]);

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
                'sub_cate_name'=>'required',
                'subcategory_photo'=>'required|image',
                'category_id'=>'required'

            ],
            [
                'sub_cate_name.required'=>'Write subCategory Name',
                'category_id.required'=>'The category field is required'
            ]);
            $photoName = time().'.'.$request->subcategory_photo->extension();
            $photoPath = 'public/assets/images/subcategories/';
            $request->subcategory_photo->move($photoPath,$photoName);

            $movedPhoto = $photoPath . $photoName;
            $userCat = 'cartyuser/assets/images/sub-categories/'.$photoName;
            usleep(1000* 1000); 
            copy($movedPhoto,$userCat);

            $data = $request->except(['_token']);
            $data['subcategory_photo'] = $photoName;
            DB::table('sub_categories')->insert($data);
            // var_dump($data);
            return back()->with('success','Added');

            //  return redirect('sub_category');

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
        $result= DB::select('SELECT * FROM sub_categories WHERE sub_cate_id=?',[$id]);
        $result2 =DB::select('SELECT * FROM categories ORDER BY category_name');

        return view('/all_subcategories/add-sub-cat',
        ['subcategory'=>$result[0],
            'catnames'=>$result2
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
        //
        $data=$request->all();
        if(isset($data['subcategory_photo'])){
            $photoName = time() . '.' . $request->subcategory_photo->extension();
            $photoPath = 'public/assets/images/subcategories/';
            $request->subcategory_photo->move($photoPath,$photoName);

            $movedPhoto = $photoPath . $photoName;
            $userCat = 'cartyuser/assets/images/sub-categories/'.$photoName;
            usleep(1000* 1000); 
            copy($movedPhoto,$userCat);

            $data = $request->except(['_token','_method','subcategory_photo']);
            $data['subcategory_photo'] =  $photoName;
            DB::update('UPDATE sub_categories SET sub_cate_name = ? , subcategory_photo=? , category_id=? WHERE sub_cate_id = ? ',
            [$data['sub_cate_name'],$data['subcategory_photo'],$data['category_id'],$id]);

        }else{
            $data=$request->except(['_method','_token']);
            DB::update('UPDATE sub_categories SET sub_cate_name = ? , category_id=? WHERE sub_cate_id = ? ',
            [$data['sub_cate_name'],$data['category_id'],$id]);

        }


        return redirect('sub_category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $data = $request->except('_token','_method');
        DB::delete('DELETE FROM sub_categories WHERE sub_cate_id = ?',[$data['sub_cate_id']]);
        return redirect('sub_category');
    }
    public function status($id,$st)
    {
        DB::update('UPDATE sub_categories SET sub_cate_status = ? WHERE sub_cate_id = ?',[!$st,$id]);
        return redirect('sub_category');
    }


}
