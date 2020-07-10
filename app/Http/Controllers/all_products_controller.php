<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class all_products_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allproducts = DB::table('view_admin_products_suppliers_images')->select('*')->where('status','=','primary')->paginate(5);
        return view('all_products.productList',compact('allproducts'));

        // $result = DB::select('SELECT * FROM view_admin_products_suppliers_images where status="primary"');

        // return view('all_products.productList',[
        //     'allproducts'=>$result,
        // ]);
    }
    public function fetch_data(Request $request){
        if($request->ajax())
            {
            $allproducts = DB::table('view_admin_products_suppliers_images')->select('*')->where('status','=','primary')->paginate(5);
            return view('all_products.productpagination',compact('allproducts'))->render();
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
    public function destroy($id)
    {
        //
    }

    /* additional */

    public function single($pro_id,$supp_id)
    {   $result = DB::select('SELECT * FROM view_admin_products_suppliers_images WHERE product_id = ? and  supplier_id = ?',[$pro_id,$supp_id]);
        $result1 = DB::select('SELECT * FROM view_admin_products_suppliers_images where status="primary"');
        $result2 = DB::select('SELECT * FROM specifications WHERE product_id = ? and  supplier_id = ?',[$pro_id,$supp_id]);
        $result3 = DB::select('SELECT * FROM view_rating_customer WHERE product_id = ? and  supplier_id = ?',[$pro_id,$supp_id]);
        return view('all_products.singleProduct',[
            'singleProducts'=>$result,
            'singleProduct'=>$result1[0],
            'singleSpecification'=>$result2,
            'singleRating'=>$result3
        ]);
    }


    public function delete(Request $request)
    {
        $data =$request->only('product_id','supplier_id');
        // var_dump($data);
        $res = DB::delete('DELETE FROM products WHERE product_id = ? AND  supplier_id = ?', [$data['product_id'],$data['supplier_id']]);
        return redirect()->back()->with('deletePro','You Have Successfully Delete Your Product ');
    }


    public function status($pro_id,$supp_id,$st)
    {
        DB::update('UPDATE products SET product_status = ? WHERE product_id = ? and  supplier_id = ?',[!$st,$pro_id,$supp_id]);
        return redirect('product');
    }
}
