<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Session;
use Illuminate\Database\QueryException;
class all_offers_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data=DB::table('offers')->paginate(5);
        if($request->ajax()){
           
            return view('all_offers.pagination_data',compact('data'))->render();
        }

       return view('all_offers.offertable',compact('data'));
    }
    // public function fetch_data(Request $request ){
    //    // var_dump($request->all());die;
    //     if($request->ajax()){
    //         $data=DB::table('offers')->paginate(3);
    //         return view('all_offers.offertable',compact('data'))->render();
    //     }
    // }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('all_offers.offerform');
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
          'offer_title'=>'required',
          'offer_short_desc'=>'required',
          'start_date'=>'required',
          'end_date'=>'required',
          'offer_photo_name'=>'required',
          'description'=>'required',
          'offer_status'=>'required'
      ],['offer_title.required'=>'offer_title is required']);
      
      $image=time().'.'.$request->offer_photo_name->extension();

      $image_path='public/assets/images/offered/';
      $request->offer_photo_name->move($image_path,$image);

        $movedPhoto = $image_path . $image;
        // $userOffer = 'cartyuser/assets/images/slider/'.$image;
        usleep(1000* 1000); 
        // copy($movedPhoto,$userOffer);

        

      $data=$request->all();
      $data=$request->except('_token');
      $data['offer_photo_name']=$image;
     
      $lastid= DB::table('offers')->insertGetId($data);
      var_dump($data);
      return redirect('kh/'.$lastid.'/add');
    }



    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result=DB::select('select * from view_admin_offered where offer_id=?',[$id]);
   
        return view('all_offers.offeredproducttable',['product'=>$result]);
    }
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result=DB::select('select * from offers where offer_id=?',[$id]);
        $results=DB::select('select * from view_admin_offered where offer_id = ?',[$id]);
       
        return view('all_offers.offerform',['offer'=>$result[0],'offproduct'=>$results]);
    }


    // $photoName = time() . '.'. $images['image_name'][$i]->extension();
    // $publicPath = 'public/assets/images/products/'.$photoName;
    // $productPath = 'cartyuser/assets/images/product/large-size/';
    // $images['image_name'][$i]->move($productPath,$photoName);
    // $movedPhoto = $productPath . $photoName;
    // $smallPhoto = 'cartyuser/assets/images/product/small-size/'.$photoName;
    // usleep(500* 1000); 
    // copy($movedPhoto,$smallPhoto);
    // usleep(200* 1000);
    // copy($movedPhoto,$publicPath);
    // usleep(500* 1000);




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->has('offer_photo_name')){

        $image=time().'.'.$request->offer_photo_name->extension();
        $image_path='public/assets/images/offered/';
        $request->offer_photo_name->move($image_path,$image);
        $movedPhoto = $image_path . $image;
        // $userOffer = 'cartyuser/assets/images/slider/'.$image;
        usleep(1000* 1000); 
        // copy($movedPhoto,$userOffer);

        
        $data=$request->all();
        $data['offer_photo_name'] = $image;
        // var_dump($data);
        
        $lastid= DB::table('offers')->where ('offer_id',$id)->update(['offer_title'=>$data['offer_title'] ,'offer_short_desc'=>$data['offer_short_desc'] ,'description'=>$data['description'],'start_date'=>$data['start_date'],
        'end_date'=>$data['end_date'] ,'offer_photo_name'=>$data['offer_photo_name'] ,'offer_status'=>$data['offer_status']]);
        return redirect('offer');
    }
    else{
    $data=$request->all();
        $data=$request->except('_token');
        
        
        $lastid= DB::table('offers')->where ('offer_id',$id)->update(['offer_title'=>$data['offer_title'] ,'offer_short_desc'=>$data['offer_short_desc'] ,'description'=>$data['description'],'start_date'=>$data['start_date'],
        'end_date'=>$data['end_date']  ,'offer_status'=>$data['offer_status']]);
        return redirect('offer');
        
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result=DB::delete('delete from offers where offer_id=?',[$id]);
        return redirect('/offer');
    }


    public function showproduct($idp,$ido)
    {
        
        $result=DB::select('SELECT * FROM view_admin_offered WHERE product_id = ? AND offer_id = ?',[$idp,$ido]);
        return view('all_offers.product',['product'=>$result]);
           
    }


    public function updatestatus($id,$st)
    {
        $result=DB::update('UPDATE offers SET offer_status = ? where offer_id = ?',[!$st,$id]);
        return redirect('/offer');
    }


    public function showallproduct($id)
    {

        $result=DB::select('select * from view_admin_products_suppliers_images where status="primary"');

       return view('all_offers.allproduct',['product'=>$result,'id'=>$id]);
    }



    
    public function storeproduct(Request $request,$id )
    {
      $request->validate([
          'product_id'=>'required',
          'percentage'=>'required'
      ]);
      $data=$request->all();
      $data=$request->except('_token'); //eh da ely hwa eh 5las 5las :D
      $count=$request->only('product_id');
      $suppid=$request->only('supp_id');
      $percent=$request->only('percentage');
      $x = 0;
      $test = array();
      for ($i=0; $i < count($percent['percentage']) ; $i++) { 
        if($percent['percentage'][$i] != null){
            $test['percentage'][$x]=$percent['percentage'][$i];
            $x++;
         
        }

    }

        $productcount=count($count['product_id']);
        // for($i=0;$i<$productcount; $i++){
        // DB::table('offered_products')->insert(['offer_id'=>$id,'product_id'=> $count['product_id'][$i],'supp_id'=>$suppid['supp_id'][$i],'percentage'=>$test['percentage'][$i]]);
        //     }
        // return redirect('offer');
      
        for($i=0;$i<$productcount; $i++){
            try {
                
                    DB::table('offered_products')->insert(['offer_id'=>$id,'product_id'=> $count['product_id'][$i],'supp_id'=>$suppid['supp_id'][$i],'percentage'=>$test['percentage'][$i]]);
                    
                    
            } 
            catch (QueryException $e) {
                // dd($e);
                $errorCode = $e->getCode();
                if($errorCode == 23000){

                    return redirect()->back()->with('Failed','This product is already In the offer'); 
                }
                
            }
        }
        return redirect('offer');







   
    }
    
    
    public function updateproduct(Request $request,$id)
    {
      $data=$request->all();
      $data=$request->except('_token');
      $count=$request->only('product_id');
      $suppid=$request->only('supp_id');
      $percent=$request->only('percentage');
      $productcount=count($count['product_id']);
      for($i=0;$i<$productcount; $i++){
        DB::table('offered_products')->insert(['offer_id'=>$id,'product_id'=> $count['product_id'][$i],
        'supp_id'=>$suppid['supp_id'][$i],'percentage'=>$percent['percentage'][$i]]);  
    }
    return redirect('offer');
}
    public function delete($id,$subid,$offid)
        {
            $result=DB::delete('DELETE FROM offered_products where product_id = ? and supp_id = ? and offer_id = ?',[$id,$subid,$offid]);
            return redirect('offer/'.$offid.'/edit');
        }

}
