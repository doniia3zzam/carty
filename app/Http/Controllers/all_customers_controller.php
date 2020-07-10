<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class all_customers_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all_customer = DB::table('customers')->select('*')->orderBy('customer_status')->paginate(5);
        return view('all_customers.index_customer',compact('all_customer'));
        // $customer = DB::select('SELECT * FROM customers ORDER BY customer_status');
        // return view('all_customers.index_customer',[
        //     'customer'=>$customer
        // ]);
    }
    public function fetch_data(Request $request){
        if($request->ajax()){
            $all_customer = DB::table('customers')->select('*')->orderBy('customer_status')->paginate(5);
            return view('all_customers.customer_pagination',compact('all_customer'))->render();
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
        $cust=DB::select('SELECT * FROM customers WHERE customer_id = ?',[$id]);
        $address=DB::select('SELECT * FROM customeraddress WHERE customer_id = ?',[$id]);
        $city=DB::select('SELECT * FROM cities');
        return view('all_customers.show_details',[
            'customer'=>$cust,
            'address'=>$address,
            'city'=>$city
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
        //
        $data = $request->except('_token','_method');
        DB::delete('DELETE FROM customers WHERE customer_id = ?', [$data['customer_id']]);
        // var_dump($data);
        return redirect('customer');

    }
    public function customer_status($id,$st){
        DB::update('UPDATE customers SET customer_status = ? WHERE customer_id = ?', [!$st,$id]);
        return redirect()->back();


    }
}
