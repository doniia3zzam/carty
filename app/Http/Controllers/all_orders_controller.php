<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\support\facades\Mail;
use App\Mail\sendInvoice;
class all_orders_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allorders = DB::table('view_admin_customer_order_fatora')->select('*')->where([['email_status','=',0],['addressStatus','=','primary']])->paginate(5);
        return view('all_orders.ordersList',compact('allorders'),['sent'=>1]);

        // $result = DB::select('SELECT * FROM view_admin_customer_order_fatora WHERE email_status = 0');

        // return view('all_orders.ordersList',[
        //     'allorders'=>$result,
        //     'sent'=>1
        // ]);
    }
    public function fetch_data(Request $request){
        if($request->ajax())
            {
                $allorders = DB::table('view_admin_customer_order_fatora')->select('*')->where([['email_status','=',0],['addressStatus','=','primary']])->paginate(5);
        return view('all_orders.orderspagination',compact('allorders'),['sent'=>1])->render();
            }
    }
    public function show($id)
    {
        $result = DB::select('SELECT * FROM view_admin_customer_order_fatora WHERE order_id = ?',[$id]);
        $result1 = DB::select('SELECT * FROM view_admin_supplier_order_brancehes_fatora WHERE order_id = ?',[$id]);
        $result2 = DB::select('SELECT * FROM view_admin_supplier_order_brancehes_fatora WHERE order_id = ?',[$id]);

        return view('all_orders.singleOrder',[
            'ordercustomer'=>$result[0],
            'ordersupplier'=>$result1[0],
            'orderproduct'=>$result2
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allorders = DB::table('view_admin_customer_order_fatora')->select('*')->where([['email_status','=',1],['addressStatus','=','primary']])->paginate(5);
        return view('all_orders.ordersList',compact('allorders'));

        // $allorders = DB::select('SELECT * FROM view_admin_customer_order_fatora WHERE email_status = 1 AND addressStatus = "primary"  ');

        // return view('all_orders.ordersList',[
        //     'allorders'=>$allorders,

        // ]);
    }
    public function fetch_data_create(Request $request){
        if($request->ajax())
            {
                $allorders = DB::table('view_admin_customer_order_fatora')->select('*')->where([['email_status','=',1],['addressStatus','=','primary']])->paginate(5);
                return view('all_orders.orderspagination',compact('allorders'))->render();
            }
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
    public function orderMail(Request $request)
    {
        $request->validate([
            'invoice'=>'required|image',
            'order_id'=>'required|numeric'
        ]);
        $data = $request->except('_token');
        $photoName =  $data['order_id'] . '.'.$data['invoice']->extension();
        $photoPath = 'public/assets/images/sentInvoices/';
        $data['invoice']->move($photoPath,$photoName);
        $data['invoice'] = $photoName . $photoPath;
        $fullPath = url($photoPath.$photoName);
        $res = Mail::to('galal.husseny@gmail.com')->send(new sendInvoice($data['order_id'],$fullPath));
        if ($res == null){
            DB::update('UPDATE orders set email_status = 1 WHERE order_id = ?', [$data['order_id']]);
             return redirect()->back()->with('mailSucc','Your Invoice Has Been Successfully Sent To The Delivery Company');
        }
        return redirect()->back()->with('c','There is a problem in sending This email');
    }
}
