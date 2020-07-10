<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers = DB::table('customers')->count();
        $suppliers = DB::table('suppliers')->count();
        $products = DB::table('products')->count();
        $orders = DB::table('orders')->count();
        $ordered_products = DB::table('ordered_products')->count();
        $offers = DB::table('offers')->count();
        $getMostSupp = '';
        $most_supp = DB::select('SELECT COUNT(supplier_id) AS most_supp, supplier_id FROM ordered_products GROUP BY supplier_id ORDER BY most_supp DESC');
        if($most_supp != null){
            $getMostSupp = DB::select('SELECT * FROM suppliers WHERE supplier_id = ?', [$most_supp[0]->supplier_id]);
            $getSecondSupp = DB::select('SELECT * FROM suppliers WHERE supplier_id = ?', [$most_supp[1]->supplier_id]);
        // var_dump($getSecondSupp[0]);

        }




        return view('dashboard',[
            'customers'=> $customers,
            'suppliers'=> $suppliers,
            'products'=> $products,
            'orders'=> $orders,
            'ordered_products'=> $ordered_products,
            'offers'=>$offers,
            'getMostSupp'=>$getMostSupp[0],
            'countofsaled'=>$most_supp[0]->most_supp,
            'getSecondSupp'=> $getSecondSupp[0],
            'countofSecondsaled'=>$most_supp[1]->most_supp,
            
            
        ]);
    }
}
