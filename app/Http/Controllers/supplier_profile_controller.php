<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
class supplier_profile_controller extends Controller
{



    public function __construct()
    {
       
        $this->middleware('urlchecker:supp_profile', ['only' => ['edit']]);
        $this->middleware('verify', ['only' => ['index']]);

        // $this->middleware('permission:view-posts',   ['only' => ['show', 'index']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result1 = DB::select("SELECT * FROM cities ORDER BY name");
        return view('supplier.add_address',[
            'cities'    =>$result1
            ]);
        // return session()->get('supplier_id');
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
        $request->validate([
            'city_id' => 'required|numeric',
            'supplier_phone' => 'required|numeric',
            'supplier_street' => 'required|alpha_num',
            'supplier_area' => 'required|alpha_num',
            'supplier_bulding_no' => 'required|numeric',
        ]);
        $data = $request->except('_token');
        $supplier_id = session()->get('supplier')['supplier_id'];
        $data['supplier_id'] = $supplier_id;
        // var_dump($data);

        try {
            DB::table('suppliers_lives')->insert($data);
            return redirect()->back()->with('success','Address Successuflly Inserted');
        } 
        catch (QueryException $e) {
            // dd($e);
            // dd($e->getMessage());
            // var_dump($e->getCode());
            // var_dump($e);
            $errorCode = $e->getCode();
            // print_r($errorCode); 22007
            // echo($errorCode);
            if($errorCode == 23000){
                
                return redirect()->back()->with('faliedNo',$data);
               
            }
            
        }
 
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
        // session()->put('supplier_id', $id);
        $result1 = DB::select("SELECT * FROM suppliers WHERE supplier_id = ?",[$id]);
        $result2 = DB::select("SELECT * FROM view_supplier_lives WHERE supplier_id = ?",[$id]);
        $result3 = DB::select("SELECT * FROM cities ORDER BY name");
       return view('supplier.profile',[
           'profile'    => $result1[0],
           'adresses'   => $result2,
           'cities'     =>$result3
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
           'supplier_name'  =>'required',
            'shop_name'      =>'required',
            'email'          =>'required',
            'details'        => 'required',
            'open_time'      => 'required',
            'close_time'     => 'required',
            'supplier_photo' =>'image|max:1048'
            ]);
        if($request->has('supplier_photo')){
        $photoName = time() . '.'. $request->supplier_photo->extension();
        $photoPath = 'public/assets/images/suppliers/';
        $request->supplier_photo->move($photoPath,$photoName);
        // echo($photoPath .$photoName);
        $data  = $request->except('_token','_method','supplier_photo');
        $data['supplier_photo'] = $photoPath .$photoName;
         //changening session photo   
        $supp = Session()->get('supplier');
        $supp['supplier_photo'] = $photoPath .$photoName;
        Session()->put('supplier',$supp);
        // var_dump($supp);
        
        DB::update("UPDATE suppliers SET supplier_name = ?, shop_name = ?, email = ?, details = ?, close_time = ?, open_time = ?, supplier_photo = ? WHERE supplier_id = ?",
        [$data['supplier_name'],$data['shop_name'],$data['email'],$data['details'],$data['close_time'],$data['open_time'],$data['supplier_photo'],$id]);

        return redirect('supp_profile/'.$id.'/edit')->with('success',' You Have Successfully Update Your Infromations ');

        }else{
            $data  = $request->except('_token','_method');
            DB::update("UPDATE suppliers SET supplier_name = ?, shop_name = ? , email = ?, details = ?,close_time = ?, open_time = ? WHERE supplier_id = ?",
            [$data['supplier_name'],$data['shop_name'],$data['email'],$data['details'],$data['close_time'],$data['open_time'],$id]);
            return redirect('supp_profile/'.$id.'/edit')->with('success',' You Have Successfully Upadte Your Infromations ');
        }
    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        // echo($data['supplier_lives_id']);
        DB::delete("DELETE FROM suppliers_lives WHERE supplier_lives_id = ? ",[$data['supplier_lives_id']]);
        return redirect('supp_profile/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     */

    public function addressStatus($id,$st)
    {
        DB::update("UPDATE suppliers_lives SET supplier_address_status = ? WHERE supplier_lives_id = ? ",[!$st,$id]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     */

    public function updateAddress(Request $request,$id)
    {
        $request->validate([
            'city_id' => 'required|numeric',
            'supplier_phone' => 'required|numeric',
            'supplier_street' => 'required',
            'supplier_area' => 'required',
            'supplier_bulding_no' => 'required|numeric',
        ]);
        $data = $request->except('_token','_method');

        try {
            DB::update("UPDATE suppliers_lives SET city_id = ?,supplier_phone = ? ,supplier_street = ? ,supplier_area = ? , supplier_bulding_no = ? WHERE supplier_lives_id = ? ",
            [$data['city_id'],$data['supplier_phone'],$data['supplier_street'],$data['supplier_area'],$data['supplier_bulding_no'],$id]);
            return redirect()->back();
        } 
        catch (QueryException $e) {

            $errorCode = $e->getCode();
            if($errorCode == 23000){

                return redirect()->back()->with('faliedNo',$data);
            }
            
        }


       
    }
}
