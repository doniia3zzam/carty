<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Sample_data;
use datatable;
use App\supp;
use App\Notifications\addsupp;
use Notification;
use App\User;

class all_suppliers_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $suppliers=DB::table('suppliers')->select('*')->orderBy('supplier_status')->paginate(5);
        $city=DB::table('cities')->select('*')->orderBy('name')->paginate(5);
        return view('all_suppliers.all_suppliers',compact('suppliers'),compact('city'));

        // $city=DB::select('SELECT * FROM cities ORDER BY name');
        // $supp= DB::select('SELECT * FROM suppliers ORDER BY supplier_status ');
        // return view('all_suppliers.all_suppliers',[
        //     'suppliers'=>$supp,
        //     'city'=>$city,

        // ]);
    }
    public function fetch_data(Request $request){
        if($request->ajax()){
            $city=DB::table('cities')->select('*')->orderBy('name')->paginate(5);
            $suppliers=DB::table('suppliers')->select('*')->orderBy('supplier_status')->paginate(5);
        return view('all_suppliers.all_supplier_admin_pagination',compact('suppliers'),compact('city'))->render();
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
        $city=DB::select('SELECT * FROM cities');
        return view('all_suppliers.add_suppliers',
        [
            'city'=>$city
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


        $request->validate([
            'supplier_name'=>'required',
            'email'=>'email|required|unique:suppliers',
            'password'=>'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|min:6',
            'supplier_photo'=>'required|image|mimes:jpeg,png,jpg,svg|max:1048',
            'supplier_phone'=>'required|numeric|unique:suppliers_lives',
            'supplier_area'=>'required',
            'supplier_street'=>'required',
            'supplier_bulding_no'=>'required|numeric',

            'details'=>'required'
        ],
            [
                'supplier_name.required'=>'Enter your name',
                'email.required'=>'Enter your email',
                'supplier_phone.required'=>'Enter your phone',
                'supplier_area.required'=>'Enter your area',
                'supplier_photo.required'=>'photo is required',
                'supplier_area.required'=>'Enter your area',
                'supplier_street.required'=>'Enter your street',
                'password.required'=>'password is required',
                'supplier_bulding_no.required'=>'required',
                'details.required'=>'required'
            ]);


        $photoname = time().'.'.$request->supplier_photo->extension();
        $photo_path='public/assets/images/suppliers/';
        $request->supplier_photo->move($photo_path,$photoname);
        $data=$request->except('_token','city_id','name','supplier_phone','supplier_area','supplier_street','supplier_bulding_no');
        $data['supplier_photo']=$photo_path.$photoname;
        $data['password']=bcrypt($data['password']);
        DB::table('suppliers')->insert($data);
        $last_id = DB::getPdo()->lastInsertId();
        $data=$request->except('_token','supplier_lives_id','supplier_name','supplier_photo','shop_name','email','password','details','open_time','close_time');
        $data['supplier_id']=$last_id;
        DB::table('suppliers_lives')->insert($data);



        // $supp_note = new supp();
        // $supp_note->supplier_name = $request->supplier_name;
        // $supp_note->supplier_name = $request->supplier_name;
        // if($supp_note->save())
        // {
        //     $user = User::all();
        //     Notification::send($user , new addsupp($supp_note));
        // }
        // dd($supp_note);
        return redirect('supplier')->with('success','You have Successfully Added New supplier');

    }
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
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
        $supp=DB::select('SELECT * FROM suppliers WHERE supplier_id=?',[$id]);
        $city=DB::select('SELECT * FROM cities');
        $supp_lives=DB::select('SELECT * FROM suppliers_lives WHERE supplier_id=?',[$id]);
        return view('all_suppliers.show_more',[
            'suppliers'=>$supp,
            'city'=>$city,
            'supp_live'=>$supp_lives
        ]);
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
        $supp=DB::select('SELECT * FROM suppliers WHERE supplier_id=?',[$id]);
        $supp_live=DB::select('SELECT * FROM suppliers_lives WHERE supplier_id=?',[$id]);
        $city=DB::select('SELECT * FROM cities ORDER BY name');
        return view('all_suppliers.add_suppliers',[
            'supplier'=>$supp[0],
            'supp_live'=>$supp_live[0],
            'city'=>$city

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        // var_dump($request->all());
        $data = $request->except('_token','_method');
        DB::delete('DELETE FROM suppliers WHERE supplier_id = ?', [$data['supplier_id']]);
        return redirect('supplier');
    }

    public function supplierStatus($id,$st){
        DB::update('UPDATE suppliers SET supplier_status = ? WHERE supplier_id = ?', [!$st,$id]);
        return redirect('supplier');
    }


    // show all products
    public function showproduct($id)
        {
            //
            // echo($id);
            $products=DB::table('view_single_product')->select('*')->where('supplier_id','=',$id)->paginate(5);
            return view('all_suppliers.show_product',compact('products'),[
                'supplier_id'=>$id
            ]);
        }
    public function fetch_data_product(Request $request,$id){
        if($request->ajax()){
            $products=DB::table('view_single_product')->select('*')->where('supplier_id','=',$id)->paginate(5);
            return view('all_suppliers.all_product_supp_pagi',compact('products'))->render();
        }
    }
        // delete product
    // public function deleteproduct($idp,$ids)
    // {

    //     DB::delete('DElETE FROM products WHERE product_id = ? AND supplier_id = ?',[$idp,$ids]);
    //     return redirect()->back();
    // }


    public function deleteproduct(Request $request)
    {
        $data = $request->except('_token','_method');
        // var_dump($data);
        DB::delete('DELETE FROM products WHERE product_id = ? AND supplier_id = ?',[$data['product_id'],$data['supplier_id']]);
        return redirect()->back()->with('productDel','You Are Successfully delete a product');
    }

    // change status of product
    public function productstatus($idp,$ids,$st){
        DB::update('UPDATE products SET product_status = ? WHERE product_id = ? AND supplier_id= ? ', [!$st,$idp,$ids]);
        return back();

    }
    // public function address($id)
    // {
    //     $city=DB::select('SELECT * FROM cities');
    //     return view('all_suppliers.add_address',[
    //         'city'=>$city
    //     ]);
    // }
    public function add_address(Request $request)
    {
        $request->validate([
            'supplier_street'=>'required',
            'supplier_phone'=>'required',
            'supplier_area'=>'required',
            'supplier_street'=>'required',
            'supplier_bulding_no'=>'required'
        ]);

        $data=$request->except('_token');
        DB::table('suppliers_lives')->insert($data);
        return redirect()->back();

    }
    public function mark($id)
    {
        // return $id;
        DB::update("UPDATE new_supplier SET  mark_as = ? WHERE id = ? ",[1,$id]);
        return redirect('supplier');
    }
}
