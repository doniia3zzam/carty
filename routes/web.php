<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/','maincontroller@index');
Route::get('/','maincontroller@index')->middleware('redirectIflogin');
Route::post('log','maincontroller@login');
Route::get('dash','maincontroller@home')->middleware('verify');
Route::get('out','maincontroller@logout')->middleware('verify');
Route::post('forgetPass','maincontroller@forgetPass');
Route::get('resetPassword/{supplier_id}',[
    'as' => 'resetPassword', //resetpassword is the name of the route
    'uses' => 'maincontroller@resetForm'
]);
Route::put('updatepass','maincontroller@updateNewPass');
Route::put('changePass','maincontroller@changePassword');
// Route::get('resetPassword','maincontroller@resetviewtest');

// Route::get('test','maincontroller@test');
// Route::get('url/{user}',[
//     'as' => 'url',
//     'uses' => 'maincontroller@url'
// ]);

Route::resources([
    'product' 		=> 'all_products_controller',
    'supplier' 		=> 'all_suppliers_controller',
    'brand' 		=> 'all_brands_controller',
    'model' 		=> 'all_models_controller',
    'category' 		=> 'all_categories_controller',
    'sub_category' 	=> 'all_sub_categories_controller',
    'offer' 		=> 'all_offers_controller',
    'order' 		=> 'all_orders_controller',
    'admin' 		=> 'all_admins_controller',
    'permisssion' 	=> 'all_permissions_controller',
    'customer' 		=> 'all_customers_controller',
    'city' 			=> 'all_cities_controller',
    'payment' 		=> 'all_payments_controller'

]);

Route::resource('supp_product','supplier_controller');
/* related to profile */
Route::resource('supp_profile', 'supplier_profile_controller')->only([
    'index', 'store', 'edit', 'update','destroy'
]);


Route::get('address/{id}/{st}','supplier_profile_controller@addressStatus'); // to change address status
Route::put('address/{id}','supplier_profile_controller@updateAddress')->middleware('methodMiddleWare:put'); // to update address

/* related to supplier all products */
Route::delete('/supp_pro','supplier_controller@deleteMyPorduct'); // supplier delete product
Route::get('/supp_pro/{idp}/{ids}/{st}','supplier_controller@myProductSt')->middleware('urlchecker:ids'); // supplier status product
Route::get('/supp_pro/{idp}/{ids}','supplier_controller@editProduct')->middleware('urlchecker:ids'); // supplier edit product
Route::get('delSpec/{id}','supplier_controller@deleteSpec'); // supplier delete specification in edit page
Route::get('delImg/{id}','supplier_controller@deleteImage');// supplier delete Image in edit page
Route::post('addImg','supplier_controller@AddNewImageORSpec'); // supllier add new images or specifications in edit page


/* related to  supplier orders */
Route::get('Porders/{ids}','supplier_orders_controller@allPending')->middleware('urlchecker:ids');  //all pending orders
Route::get('Dorders/{ids}','supplier_orders_controller@allDeliverd')->middleware('urlchecker:ids');  //all deliverd orders
Route::delete('Corders/{ids}','supplier_orders_controller@cancelOrder')->middleware('methodMiddleWare:delete','urlchecker:ids'); //cancel order
Route::get('ACorders/{ids}','supplier_orders_controller@acOrder'); //all cancelled order
Route::post('CONorders','supplier_orders_controller@conOrder'); //confirm order

/* start menna additional routes */

Route::delete('/product','all_products_controller@delete'); // admin delete product
Route::get('/product/{product_id}/{supplier_id}/{product_status}','all_products_controller@status'); // admin status product
Route::get('singleProduct/{product_id}/{supplier_id}','all_products_controller@single'); // view admin single product
Route::post('orderMail','all_orders_controller@orderMail');
/* end menna additional routes */



/* start yomnna additional routes */

Route::get('brand/{id}/{st}','all_brands_controller@status');/////// switche for brands

Route::get('model/{id}/{st}','all_models_controller@status');/////// switche for models

Route::get('city/{id}/{st}','all_cities_controller@status');/////// switche for cities

/* end yomnna additional routes */



/* start hadeer additional routes */

Route::get('category/{id}/{st}','all_categories_controller@status'); /////// activate and deactivate (status) of category /////////

Route::get('sub_category/{id}/{st}','all_sub_categories_controller@status'); ////// activate and deactivate (status) of sub-category ////////

Route::get('payment/{id}/{st}','all_payments_controller@status');////// activate and deactivate (status) of payment////////

Route::get('admin/{id}/{st}','all_admins_controller@status');  ////// activate and deactivate (status) of admins ////////

Route::get('admon','all_admins_controller@admon');

Route::get('adminProfile/{id}','all_admins_controller@profile');
/* end hadeer additional routes */



/* start Donia additional routes */

Route::get('/supplierStatus/{id}/{st}','all_suppliers_controller@supplierStatus');// to edit status

Route::get('/allproduct/{id}','all_suppliers_controller@showproduct');// to show all product

Route::delete('/supplier','all_suppliers_controller@deleteproduct');// to delete product

Route::get('/status/{idp}/{ids}/{st}','all_suppliers_controller@productstatus');// to change product status

Route::get('/add_address/{id}','all_suppliers_controller@address');// to view the add address form

Route::post('/add_address','all_suppliers_controller@add_address');// to add address

Route::get('/status/{id}/{st}','all_customers_controller@customer_status');// customer_status

/* end Donia additional routes */


/* start shymaa additional routes */

Route::get('showPro/{idp}/{idf}','all_offers_controller@showproduct');  //for showing product in offered product list

Route::get('test/{id}/{st}','all_offers_controller@updatestatus'); //for activate and deactivate offer

Route::get('kh/{id}/add','all_offers_controller@showallproduct'); //for showing all product to choose from them

Route::post('storeproduct/{id}/add','all_offers_controller@storeproduct');//stroe product in offer

Route::post('storeproduct/{id}','all_offers_controller@updateproduct'); //update product in offer

Route::get('storeproduct/{id}/{supp}/{offid}','all_offers_controller@delete'); //delete product in offer

Route::get('offer/fetch_data','all_offers_controller@fetch_data'); // for pagination ajax

/* end shymaa additional routes */





//  ************* Auth ADMIN ************* //
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Password Change Routes...

Route::get('password/change', 'Auth\AuthController@changePassword');

Route::post('password/change', 'Auth\AuthController@postChangePassword');


//  all paginations

Route::get('all_customer','all_customers_controller@fetch_data');// customer pagination

Route::get('models','all_models_controller@fetch_data'); // models  pagination

Route::get('cities','all_cities_controller@fetch_data'); // cities pagination

Route::get('categories','all_categories_controller@fetch_data'); // categories pagination

Route::get('brands','all_brands_controller@fetch_data');  // brands  pagination

Route::get('subcategories','all_sub_categories_controller@fetch_data');  // sub_category pagination

Route::get('payments','all_payments_controller@fetch_data'); // payments pagination

Route::get('suppliers','all_suppliers_controller@fetch_data'); // suppliers pagination

Route::get('products/{id}','all_suppliers_controller@fetch_data_product'); // products

Route::get('allproducts','all_products_controller@fetch_data');// all products

Route::get('allorders','all_products_controller@fetch_data'); // all pending orders

Route::get('allorders/create','all_products_controller@fetch_data_create'); // all sent orders

Route::get('allproducts_supp_page/{id}','supplier_controller@fetch_data_supp_pro'); // product of supplier admin


//  all paginations

// notifications

Route::get('mark/{id}','all_suppliers_controller@mark');
// notification for supplier
Route::get('markor/{id}','supplier_controller@markor');






