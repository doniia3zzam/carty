<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class all_payments_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payments= DB::table('payment')->select('*')->orderBy('payment_status')->paginate(5);
        return view('all_payments.show-payment',compact('payments'));

    }
    public function fetch_data(Request $request){
        if($request->ajax()){
            $payments= DB::table('payment')->select('*')->orderBy('payment_status')->paginate(5);
            return view('all_payments.pay_pagination',compact('payments'))->render();
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
        return view('/all_payments/add-payment');

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
                'type'=>'required'
            ],
            [
                'type.required'=>'Write Payment Method',
            ]
            );
            $data = $request->except(['_token']);
            DB::table('payment')->insert($data);
            // var_dump($data);
            return back()->with('success','You successfully Added Payment Method.');

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
        $result= DB::select('SELECT * FROM payment WHERE payment_id=?',[$id]);
        return view('/all_payments/add-payment',['payment'=>$result[0]]);

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
        $data = $request->except(['_token']);
        DB::update('UPDATE payment SET type = ? WHERE payment_id = ? ',
        [$data['type'],$id]);
        return redirect('payment');

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
        DB::delete('DELETE FROM payment WHERE payment_id = ?',[$data['payment_id']]);
        return redirect('payment');

    }

    public function status($id,$st)
    {
        DB::update('UPDATE payment SET payment_status = ? WHERE payment_id = ?',[!$st,$id]);
        return redirect('payment');
    }
}
