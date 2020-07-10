<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\forgetpassword;
use Illuminate\support\Facades\Storage;

class maincontroller extends Controller
{
    public function __construct()
    {
        // return 'hhh';
        // return view('layouts.nav',['supp',Session()->get('supplier')['supplier_id']]);
        // $new_order=DB::select('SELECT * FROM new_order WHERE supplier_id = ?'[Session()->get('supplier')['supplier_id']]);
        // return view('layouts.nav',[
        //     'new_order'=>$new_order
        // ]);
    }
    public function index()
    {
        return view('loginSupplier');
    }
    public function login(Request $request)
    {
        $request->validate([
         'email' => 'required|email',
         'password'=>'required'
        ]);
        $user = $request->only('email','password','supplier_status');


     //    var_dump($hashpass);
        $result[0] = DB::select('SELECT * FROM suppliers WHERE email = ?',[$user['email']]);
        if($result[0] == null){
         //    email is wrong
        return redirect()->back()->with('noUser',$user);
        }
        else
        {
             // email is correct
             if(password_verify($user['password'],$result[0][0]->password)){
                 //password is correct

                 if($result[0][0]->supplier_status == 1){
                     //status is activated
                      $sessionArr = array(
                        'supplier_id' => $result[0][0]->supplier_id,
                        'supplier_name' => $result[0][0]->supplier_name,
                        'supplier_photo' => $result[0][0]->supplier_photo,
                        );
                        Session()->put('supplier',$sessionArr);
                        return redirect('dash');

                 }
                 else
                 {
                    return redirect()->back()->with('noUser',$user);
                 }




             }
             else
             {
                  //password is wrong
                 return redirect()->back()->with('noUser',$user);
             }

         }


    }
    public function home()
    {

        $mostDemandPro = DB::select('SELECT count(product_id) AS count_pro , product_id,supplier_id ,name ,detials FROM view_admin_most_saled_product_supplier WHERE supplier_id = ? GROUP BY product_id ,name ,detials,supplier_id LIMIT 4',[Session()->get('supplier')['supplier_id']]);
        // var_dump($mostDemandPro);

        return view('dashboard',['mostDemandPro'=>$mostDemandPro]);

    }
    public function logout()
    {
         Session()->forget('supplier');
         return redirect('/');
    }




    public function test()
    {


     $href =  URL::temporarySignedRoute(
         'url', now()->addMinutes(2), ['user' => 1]
     );
     $verifyLink = '<a href="'.$href.'" style="background: #343a40;color: #ffc107;padding: 10px;text-decoration: none;border: 1px solid #ffc107;border-radius: 5px;">Reset Password</a>';
     return $verifyLink;

    }
    public function url(Request $request,$user)
    {
         if (! $request->hasValidSignature()) {
             abort(401);
         }

    }




    public function forgetPass(Request $request)
    {
        $request->validate([
         'emailforget'=>'required|email'
        ],[
            'emailforget.required'=> 'The Email field is required',
            'emailforget.email'=> 'The Email field is Must be in Email Formating'
        ]);
     $user = $request->only('emailforget');
     $result[0] = DB::select('SELECT * FROM suppliers WHERE email = ?',[$user['emailforget']]);
     if($result[0] == null){
        return redirect()->back()->with('noMail',$user);
        }
     $href =  URL::temporarySignedRoute(
         'resetPassword', now()->addMinutes(60), ['supplier_id' => $result[0][0]->supplier_id]
     );
     $verifyLink = '<a href="'.$href.'" style="background: #ffc107;color: #343a40;padding: 10px;text-decoration: none;border: 1px solid #343a40;border-radius: 5px;">Reset Password</a>';
     $EmailData = array(
         'supplier_id'=>$result[0][0]->supplier_id,
         'supplier_name'=>$result[0][0]->supplier_name,
         'email'=>$result[0][0]->email,
         'reset_password'=>$verifyLink,

     );
     Mail::to($EmailData['email'])->send(new forgetpassword($EmailData));
     return redirect()->back()->with('successMail','You will have an email shortly.');


    }
    public function resetForm(Request $request,$supp)
    {
         if (! $request->hasValidSignature()) {
             abort(401);
         }
         return view('supplier.resetpassword',[
             'supplier_id' => $supp
         ]);
     }
     public function updateNewPass(Request $request)
     {
         $request->validate([
             'password' => 'min:8|required_with:password_confirmation|same:password_confirmation|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
             'password_confirmation' => 'min:8'
         ],[
             'password.regex'=>'Password must have at least onecapital letter,number and special caracter'
         ]);
         $password = $request->only('password','supplier_id');
         $password['password'] = bcrypt($password['password']);
         // var_dump($password);
         DB::update("UPDATE suppliers SET password = ? WHERE supplier_id = ? ",[$password['password'],$password['supplier_id']]);
         return redirect('/');

     }
     public function changePassword(Request $request)
     {
         $request->validate([
             'password'              =>'required',
             'new_password'          =>'min:8|required_with:password_confirmation|same:password_confirmation|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
             'password_confirmation' =>'min:8'
         ],[
             'new_password.regex'=>'Password must have at least one capital letter,small letter, number and special caracter'
         ]);
        $data = $request->except('_token','_method');
        $supplier = DB::select('SELECT * FROM suppliers where supplier_id = ?', [$data['supplier_id']]);
        if(password_verify($data['password'],$supplier[0]->password)){
             $data['new_password'] = bcrypt($data['new_password']); //hashing the new password
             DB::update('UPDATE suppliers SET password = ? WHERE supplier_id = ?', [$data['new_password'],$data['supplier_id']]);
             return redirect()->back()->with('ChangePass','You Have Already Changed Your Password');
         }
         return redirect()->back()->with('WrongPass','Wrong Password');

     }

// notifaction supplier
    //  public static function noti()
    //  {

    //      $count = DB::select("SELECT count(*) AS countorder FROM new_order WHERE mark_as = 0 ");
    //      $new_order=DB::select('SELECT * FROM new_order WHERE mark_as = 0');
    //      return view('layouts.nav',[
    //          'new_order'=>$new_order,
    //          'count'=>$count[0]->countorder
    //      ]);
    //  }





}
