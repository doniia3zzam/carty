<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class all_admins_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        return redirect('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'name'=>'required',
                'email'=>'required|email',
                'password'=>'required|confirmed'
            ],
            [
                'name.required'=>'Write admin Name',

            ]
            );
            $data = $request->except(['_token']);
            DB::table('admins')->insert($data);

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
        $result= DB::select('select * from admins where id=?',[$id]);
        return view('/all_admins.edit-photo',['admin'=>$result[0]]);

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
        if($request->has('admin_photo')){
        $data = $request->except(['_token']);
        $photoName = time() . '.' . $request->admin_photo->extension();
        $photoPath = 'public/assets/images/admins/';
        $request->admin_photo->move($photoPath,$photoName);
        $data = $request->except(['_token']);
        $data['admin_photo'] = $photoPath . $photoName;
        DB::update('UPDATE admins SET admin_photo = ? WHERE id = ? ',
        [$data['admin_photo'],$id]);
        //  var_dump($data);
        }
        return redirect('admon');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::delete('DELETE FROM admins WHERE id = ?',[$id]);
        return redirect('admon');

    }

    public function status($id,$st)
    {
        DB::update('UPDATE admins SET admin_status = ? WHERE id = ?',[!$st,$id]);
        return redirect('admon');
    }
    public function admon()
    {
        $results= DB::select('select * from admins');
        return view('/all_admins/show-admin',['admins'=>$results]);
    }
    public function profile($id)
    {
        $result= DB::select('select * from admins where id=?',[$id]);
        return view('/all_admins.edit-photo',['admin'=>$result[0]]);
    }
}
