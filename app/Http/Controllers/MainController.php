<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\ProductBrand;
use App\Product;
use App\ContactUsMessage;
use Mail;

class MainController extends Controller
{
    function index(){
        $viewConfig = array("siteTitle" => "Chemisphere", 
        "defaultEmptyProductImagePath" => "resources/img/portfolio/portfolio-1.jpg");

        $productBrandData = DB::table("product_brand as pb")
        ->join("product as pr", "pb.code", "=", "pr.product_brand_code")
        ->select("pb.code", "pb.name")
        ->distinct()
        ->orderBy("pb.name", "asc")
        ->get();

        $productData = DB::table("product")
        ->join("product_brand", "product_brand.code", "=", "product.product_brand_code")
        ->select("product.*", "product_brand.name as product_brand_name")
        ->orderBy("product_brand.name", "asc")
        ->orderBy("product.name", "asc")
        ->get();

        $data = array("config" => $viewConfig, "productData" => $productData, "productBrandData" => $productBrandData);
        return view('main', ["data" => $data]);
    }

    function saveProduct(Request $request){
        $input = $request->all();
        $productBrandList = ProductBrand::all()->toArray();

        $isNewProductBrand = $request->get("new_brand_checkbox");
        $productBrandCode = $request->get("product_brand_dropdown");

        $newProductBrandCode = null;
        $newProductBrandName = null;
        $newProductBrandDescription = null;

        $getBrandByCodeResult = null;

        // Validations
        if ($isNewProductBrand == "on"){

            $this->validate($request, [
                'new_product_brand_code' => 'required'
            ]);
            $newProductBrandCode = $request->get("new_product_brand_code");
            $newProductBrandName = $request->get("new_product_brand_name");
            $newProductBrandDescription = $request->get("new_product_brand_description");
            $getBrandByCodeResult = $this->_GetBrandByCode($newProductBrandCode, $newProductBrandName, $newProductBrandDescription);
           
            if (empty($getBrandByCodeResult)){
                // Proceed in creating
                $this->_SaveProductBrand($newProductBrandCode, $newProductBrandName, $newProductBrandDescription);
                $productBrandCode = $newProductBrandCode;
            }else{
                // Return error
            }
        }

        $this->validate($request, [
                'product_name_textbox' => 'required'
        ]);

        $productName = $request->get("product_name_textbox");
        $productDescription = $request->get("product_description_textarea");
        $productImage = $request->file("product_image_file");

        $displayImageFilepath = null;
        if ($productImage != null){
            // Upload and save file in local directory
            $destinationPath = "resources/img/upload/product";

            // To be used for image filename
            $currentTimestamp = date("Ymd_His");
            $fileName = $currentTimestamp . "_" . $productImage->getClientOriginalName();
            $productImage->move($destinationPath, $fileName);

            $displayImageFilepath = $destinationPath . "/" . $fileName;
        }


        // Saving
        $product = new Product([
            'name' => $productName,
            'description' => $productDescription,
            'sort_order' => null,
            'product_brand_code' => $productBrandCode,
            'display_image_filepath' => $displayImageFilepath
        ]);
        
        $product->save();

        /*
        $this->validate($request, [
            'name'      =>  'required',
            'email'     =>  'required|email',
            'subject'   =>  'required',
            'message'   =>  'required'
        ]);
        */

        $viewConfig = array("siteTitle" => "Chemisphere");
        $data = array("config" => $viewConfig, "productBrandList" => $productBrandList, "inputs" => $input, 
        "brandResult" => $getBrandByCodeResult);
        
        return view('product', ["data" => $data]);
    }

    private function _SaveProductBrand($brandCode, $brandName, $brandDescription){
        // Get highest sort order
        /*
        $sortOrder = DB::select("select (max(sort_order) + 1) as highest_sort_order from product_brand");
        $sortOrder = empty($sortOrder) ? 1 : $sortOrder[0]->highest_sort_order;
        */
        $productBrand = new ProductBrand([
            'code' => $brandCode,
            'name' => $brandName,
            'description' => $brandDescription,
            'sort_order' => null
        ]);

        $productBrand->save();
    }

    private function _GetBrandByCode($brandCode){
        $result = DB::select("select * from product_brand where code = :brandCode", ["brandCode" => $brandCode]);
        return $result;
    }

    function product(){
        $productBrandList = ProductBrand::all()->toArray();
        
        $viewConfig = array("siteTitle" => "Chemisphere");
        $data = array("config" => $viewConfig, "productBrandList" => $productBrandList);
        
        return view('product', ["data" => $data]);
    }

    function team(){
        $viewConfig = array("siteTitle" => "Chemisphere");
        $data = array("config" => $viewConfig);
        return view('main', ["data" => $data]);
    }

    function processcontact(Request $request){
        $errors = array();
        
        try {
            $this->validate($request, [
                'name'      =>  'required',
                'email'     =>  'required|email',
                'subject'   =>  'required',
                'message'   =>  'required'
            ]);
    
            $contactusmessage = new ContactUsMessage([
                'name'      =>  $request->get('name'),
                'email'     =>  $request->get('email'),
                'subject'   =>  $request->get('subject'),
                'message'   =>  $request->get('message')
            ]);
                 
            $contactusmessage->save();  

        } catch (Exception $e) {
            array_push($errors, $e->getMessage());
        }

        $viewConfig = array("siteTitle" => "Chemisphere");
        $data = array("config" => $viewConfig,'success' => 'success', 'errors' => array()); //not needed

        // Send Email
        try {
        Mail::send('mail', array("body" => $contactusmessage), function($message) use($contactusmessage) {
            $message->to('chemispherelabsciences-dev@outlook.com');
            $message->subject('You have recieved an email from Chemisphere Lab Sciences Contact Us!');
            $message->from('chemispherelabsciences-dev@outlook.com');
                });
        } catch (Exception $e) {
            array_push($errors, $e->getMessage());  
        }

        //return redirect()->view('main', array("data" => $data)); 
       return redirect()->route('main', ['success' => 'success','errors' => count($errors) ]);
        //return redirect()->route('main')->with('data');        
    
    }

}
