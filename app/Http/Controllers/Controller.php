<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

// notifi for supplier
    public static function noti()
     {
        // notifi_order
         $count = DB::select('SELECT count(*) AS countorder FROM notifi_order WHERE supplier_id = ? AND mark_as = ?',[Session()->get('supplier')['supplier_id'],0]);
         $new_order=DB::select('SELECT * FROM notifi_order WHERE supplier_id = ? AND mark_as = ? ',[Session()->get('supplier')['supplier_id'],0]);
         return view('layouts.nav',[
             'new_order'=>$new_order,
             'count'=>$count[0]->countorder
         ]);
     }

}
