<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendMail;
class supplier_orders_controller extends Controller
{


    /* All pending Orders */
    ///////////////////////////////
   public function allPending($ids)
   {

       $result1 = DB::select("SELECT * FROM view_admin_supplier_orders WHERE supplier_id = ? AND ordered_product_status = 0 AND cancellation = 0  ORDER BY orderd_pro_id",[$ids]);
    //    var_dump($result1);
       // var_dump($result1[0]->supplier_id);
       if($result1 != null){
        $result2 = DB::select("SELECT * FROM suppliers_lives WHERE supplier_id = ?",[$result1[0]->supplier_id]);
        return view('supplier.myorders',[
                    'ordered_products' => $result1,
                    'supplier_lives'=>$result2,
                    'Pending'=>'1',
                ]);
       }
       return view('supplier.myorders');
        // var_dump($result2);
    //   
    }


    /* Orders confirmation */
    ///////////////////////////////
    public function conOrder(Request $request)
    {
        $data = $request->except('_token');
        var_dump($data);
        DB::update("UPDATE ordered_products SET ordered_product_status = 1, supplier_lives_id = ? WHERE orderd_pro_id = ?",[$data['supplier_lives_id'],$data['orderd_pro_id']]);
        return back()->with('confirm','You have successfully Confirm Ordered Product Number '.$data['orderd_pro_id']);
    }

    /* All deliverd Orders */
    ///////////////////////////////
    public function allDeliverd($ids)
    {
        $result1 = DB::select("SELECT * FROM view_admin_supplier_orders WHERE supplier_id = ? AND ordered_product_status = 1 ORDER BY orderd_pro_id",[$ids]);
        return view('supplier.myorders',[
            'delivered_products' => $result1,
            'Pending'=>'1',
        ]);
    }

      /* orders cancellation */
    ///////////////////////////////
    public function cancelOrder(Request $request,$ids)
    {
        /* get required data to send email */
        $or_pro_id = $request->only('orderd_pro_id','order_id');
        $getCustomer = DB::select('SELECT * FROM `view_admin_customer_order_mail` WHERE order_id = ?', [$or_pro_id['order_id']]);
        $getproduct = DB::select('SELECT name,quantity,price FROM `view_admin_supplier_orders` WHERE orderd_pro_id = ?', [$or_pro_id['orderd_pro_id']]);
        // store this data into array
        $EmailData = array(
            'first_name'=>$getCustomer[0]->first_name,
            'last_name'=>$getCustomer[0]->last_name,
            'order_id'=>$getCustomer[0]->order_id,
            'date'=>$getCustomer[0]->date,
            'product_name'=>$getproduct[0]->name,
            'product_quantity'=>$getproduct[0]->quantity,
            'product_price'=>$getproduct[0]->price,
            'orderd_pro_id'=>$or_pro_id['order_id']
        );
        /* sending email to the customer email with array of data */
        Mail::to($getCustomer[0]->email)->send(new sendMail($EmailData));
       /* update colomn cancellation in ordered product table  */
        DB::update("UPDATE ordered_products SET cancellation = 1 WHERE orderd_pro_id = ?",[$or_pro_id['orderd_pro_id']]);
        return redirect()->back()->with('Email','We Will Mail Your Customer that You Has Cancel The Order Due To Technical Reasons');

    }

     /* All cancelled Products */
    ///////////////////////////////
    public function acOrder($ids)
    {
        $result1 = DB::select("SELECT * FROM view_admin_supplier_orders WHERE supplier_id = ? AND cancellation = 1 ORDER BY orderd_pro_id",[$ids]);
        return view('supplier.myorders',[
            'cancelled_products' => $result1,
            'Pending'=>'1',
        ]);
    }
}
