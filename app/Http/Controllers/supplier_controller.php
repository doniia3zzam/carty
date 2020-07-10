<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class supplier_controller extends Controller
{




    public function __construct()
    {

        $this->middleware('urlchecker:supp_product', ['only' => ['show']]);
        // $this->middleware('verify', ['only' => ['index']]);

        // $this->middleware('permission:view-posts',   ['only' => ['show', 'index']]);
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result1 = DB::select("SELECT * FROM sub_categories ORDER BY sub_cate_name ");
        $result2 = DB::select("SELECT * FROM model ORDER BY model_name ");
        return view('supplier.add_product',[
            'sub_cats' => $result1,
            'models' => $result2,
        ]);
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


        $request->validate([
            'name'                  => 'required',
            'price'                 => 'required|numeric|min:1',
            'discount'              => 'required|numeric|between:0,0.99',
            'stock_quantity'        => 'required|numeric|between:1,3000',
            'country'               => 'required',
            'color'                 => 'required',
            'detials'               => 'required',
            'model_id'              => 'required|numeric',
            'sub_cate_id'           => 'required|numeric',
            'specification'         => 'required',
            'specification_value'   => 'required',
        ]);
        /* inserting product in product table */
        if($request->has('stock_quantity')){ // because i will use this func to add images only in edit page
        $data = $request->except('_token','image_name','country_selector_code','specification','specification_value');
        $data['supplier_id'] =  session()->get('supplier')['supplier_id'];
        $lastId = DB::table('products')->insertGetId($data);
        }
        /* inserting multiple images in products_images table */
        if($request->has('image_name')){
            $images = $request->only('image_name');
            $images_count = count($images['image_name']);
            $arr[0] = 'primary';$arr[1] = 'secondary';$arr[2] = 'others';$arr[3] = 'others';$arr[4] = 'others';
            for ($i=0; $i < $images_count ; $i++) {
                $photoName = time() . '.'. $images['image_name'][$i]->extension();
                if($images['image_name'][$i]->extension() == 'png' || $images['image_name'][$i]->extension() == 'PNG'){

                    $publicPath = 'public/assets/images/products/';
                    // $productPath = 'cartyuser/assets/images/product/large-size/';
                    $images['image_name'][$i]->move($publicPath,$photoName);
                    // $movedPhoto = $productPath . $photoName;
                    // $smallPhoto = 'cartyuser/assets/images/product/small-size/'.$photoName;
                    usleep(500* 1000);
                    // copy($movedPhoto,$smallPhoto);
                    // usleep(200* 1000);
                    // copy($movedPhoto,$publicPath);
                    // usleep(500* 1000);

                    $images['image_name'][$i] = $photoName;
                    DB::table('products_images')->insert(
                        ['product_id' => $lastId, 'supplier_id' => $data['supplier_id'], 'image_name' => $images['image_name'][$i], 'status' => $arr[$i]]
                    );


                }else{
                    return redirect()->back()->with('errorExtension',$data);
                }
                usleep(300* 1000); //waiting 1 second every move proccess = 5s
            }
        }
        /* inserting multiple specifications */
        if($request->has('specification')){
            $spec = $request->only('specification','specification_value');
            $specs_count = count($spec['specification']);
            for ($i=0; $i < $specs_count ; $i++) {
                DB::table('specifications')->insert(
                    ['product_id' => $lastId, 'supplier_id' => $data['supplier_id'], 'specification' => $spec['specification'][$i], 'specification_value' => $spec['specification_value'][$i]]
                );
            }
        }

        return redirect()->back()->with('productAdded',$images_count);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $result = DB::select('SELECT * FROM view_admin_products_suppliers_images where status="primary" AND supplier_id = ?',[$id]);
        // return view('supplier.all_products',[
        //     'allproducts'=>$result,
        // ]);
        $allproducts_supp_page=DB::table('view_admin_products_suppliers_images')->select('*')->where([['status','=','primary'],['supplier_id','=',$id]])->paginate(5);
        return view('supplier.all_products',compact('allproducts_supp_page'));
    }
// *******************

    public function fetch_data_supp_pro(Request $request,$id){
        if($request->ajax()){
            $allproducts_supp_page=DB::table('view_admin_products_suppliers_images')->select('*')->where([['status','=','primary'],['supplier_id','=',$id]])->paginate(5);
            return view('supplier.supp_pro_page',compact('allproducts_supp_page'))->render();
        }
    }

// ------------------------------
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
        $request->validate([
            'name'                  => 'required',
            'price'                 => 'required|numeric|min:1',
            'discount'              => 'required|numeric|between:0,0.99',
            'stock_quantity'        => 'required|numeric|between:1,3000',
            'country'               => 'required',
            'color'                 => 'required',
            'detials'               => 'required',
            'model_id'              => 'required|numeric',
            'sub_cate_id'           => 'required|numeric',
            'specification'         => 'required',
            'specification_value'   => 'required',
        ]);
        /* updating product in product table */

        $data = $request->except('_token','_method','image_name','country_selector_code','specification','specification_value');
        DB::update('UPDATE products SET name=?,stock_quantity=?,price=?,discount=?,country=?,detials=?,color=?,sub_cate_id=?,model_id=? WHERE product_id = ? AND supplier_id = ?',
        [$data['name'],$data['stock_quantity'],$data['price'],$data['discount'],$data['country'],$data['detials'],$data['color'],$data['sub_cate_id'],$data['model_id'],$id,$data['supplier_id']]);



        /* updating multiple images in products_images table */

        if($request->has('image_id')){
            $images = $request->only('image_name','supplier_id','image_id');
            var_dump($images);
            $images_count = count($images['image_id']);

            $arr[0] = 'primary';$arr[1] = 'secondary';$arr[2] = 'others';$arr[3] = 'others';$arr[4] = 'others';
            // var_dump($arr);
            for ($i=0; $i < $images_count ; $i++) {
                $photoName = time() . '.'. $images['image_name'][$i]->extension();
                if($images['image_name'][$i]->extension() == 'png' || $images['image_name'][$i]->extension() == 'PNG'){

                    $publicPath = 'public/assets/images/products/';
                    // $productPath = 'cartyuser/assets/images/product/large-size/';
                    $images['image_name'][$i]->move($publicPath,$photoName);
                    // $movedPhoto = $productPath . $photoName;
                    // $smallPhoto = 'cartyuser/assets/images/product/small-size/'.$photoName;
                    usleep(500* 1000);
                    // copy($movedPhoto,$smallPhoto);
                    // usleep(200* 1000);
                    // copy($movedPhoto,$publicPath);
                    // usleep(500* 1000);

                    $images['image_name'][$i] = $photoName;
                    // var_dump($images['image_name'][$i]);
                    DB::update("UPDATE products_images SET image_name=?,status=? WHERE product_id = ? AND supplier_id = ? AND image_id = ? ",
                    [$images['image_name'][$i],$arr[$i],$id,$images['supplier_id'],$images['image_id'][$i]]);


                }else{
                    return redirect()->back()->with('errorExtension',$data);
                }
                usleep(1000* 1000); //waiting 1 second every move proccess = 5s
            }
        }


        /* updating specifications in product table */

        if($request->has('specification')){
            $spec = $request->only('specification','specification_value','supplier_id','specification_id');
            // var_dump($spec);
            $specs_count = count($spec['specification']);
            for ($i=0; $i < $specs_count ; $i++) {
                DB::update("UPDATE `specifications` SET specification=?,specification_value=? WHERE product_id = ? AND supplier_id = ? AND specification_id = ?",
                [$spec['specification'][$i],$spec['specification_value'][$i],$id,$spec['supplier_id'],$spec['specification_id'][$i]]);

             }
            }

        return redirect()->back();



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
    /* additional  */
    public function deleteMyPorduct(Request $request)
    {
        $data =$request->only('product_id','supplier_id');
        $res = DB::delete('DELETE FROM products WHERE product_id = ? AND  supplier_id = ?', [$data['product_id'],$data['supplier_id']]);
        return redirect()->back()->with('deletePro','You Have Successfully Delete Your Product ');

    }
    public function myProductSt($pro_id,$supp_id,$st)
    {
        DB::update('UPDATE products SET product_status = ? WHERE product_id = ? and  supplier_id = ?',[!$st,$pro_id,$supp_id]);
        return redirect()->back();
    }
    public function editProduct($idp,$ids)
    {
        $result1 = DB::select("SELECT * FROM products WHERE product_id = ? AND supplier_id = ? ",[$idp,$ids]);
        $result2 = DB::select("SELECT * FROM products_images WHERE product_id = ? AND supplier_id = ? ",[$idp,$ids]);
        $result3 = DB::select("SELECT * FROM specifications WHERE product_id = ? AND supplier_id = ? ",[$idp,$ids]);
        $result4 = DB::select("SELECT * FROM model ORDER BY model_name");
        $result5 = DB::select("SELECT * FROM sub_categories ORDER BY sub_cate_name");
        return view('supplier.edit_product',[
            'product'       => $result1[0],
            'images'        =>$result2,
            'specifications'=> $result3,
            'models'        => $result4,
            'sub_cats'      => $result5,
        ]);
    }
    public function deleteSpec($id)
    {
        DB::delete("DELETE FROM specifications WHERE specification_id = ?",[$id]);
        return redirect()->back();
    }
    public function deleteImage($id)
    {
        DB::delete("DELETE FROM products_images WHERE image_id = ?",[$id]);
        return redirect()->back();
    }
    public function AddNewImageORSpec(Request $request)
    {


        if($request->has('image_name','product_id')){
            $images = $request->only('image_name','supplier_id','product_id');

            $images_count = count($images['image_name']);


            // var_dump($arr);
            for ($i=0; $i < $images_count ; $i++) {
                $photoName = time() . '.'. $images['image_name'][$i]->extension();
                if($images['image_name'][$i]->extension() == 'png' || $images['image_name'][$i]->extension() == 'PNG'){
                    $photoPath = 'public/assets/images/products/';
                    $images['image_name'][$i]->move($photoPath,$photoName);

                    $images['image_name'][$i] = $photoPath .$photoName;
                    // var_dump($images['image_name'][$i]);

                    DB::table('products_images')->insert(
                        ['image_name' => $images['image_name'][$i], 'status' => 'others', 'product_id' => $images['product_id'], 'supplier_id' => $images['supplier_id']]
                    );


                }else{
                    return redirect()->back()->with('errorExtension');
                }
                usleep(1000* 1000); //waiting 1 second every move proccess = 5s
            }
            return redirect()->back();
        }
        elseif ($request->has('specification','product_id')) {
            $request->validate([
                'specification'         => 'required',
                'specification_value'   => 'required',
            ]);
            $spec = $request->except('_token');
            $specs_count = count($spec['specification']);
            for ($i=0; $i < $specs_count ; $i++) {
                DB::table('specifications')->insert(
                    ['product_id' => $spec['product_id'], 'supplier_id' => $spec['supplier_id'], 'specification' => $spec['specification'][$i], 'specification_value' => $spec['specification_value'][$i]]
                );
            }
            return redirect()->back();
        }

            // return redirect()->back();


    }
    public function markor($id)
    {

        DB::update("UPDATE new_order SET  mark_as = ? WHERE id = ? ",[1,$id]);
        return redirect('Porders/'.Session()->get('supplier')['supplier_id']);
    }


}
