<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ProductBrand;
use App\Product;


class ProductController extends Controller
{

    private $defaultProductDisplayPreviewImage = "resources/img/80x80.png";

    // #TODO: Add Product Added Successfully message
    function saveProduct(Request $request){
        $input = $request->all();

        $productId = $request->get("product_id");

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
        $product = null;
        if ($productId != null){
            $product = Product::find($productId);
        }

        if ($product == null){
            $product = new Product([
                'name' => $productName,
                'description' => $productDescription,
                'sort_order' => null,
                'product_brand_code' => $productBrandCode,
                'display_image_filepath' => $displayImageFilepath
            ]);
        }else{
            $product->name = $productName;
            $product->description = $productDescription;
            $product->product_brand_code = $productBrandCode;
            if ($displayImageFilepath != null){
                $product->display_image_filepath = $displayImageFilepath;
            }
        }
        
        $product->save();

        /*
        $this->validate($request, [
            'name'      =>  'required',
            'email'     =>  'required|email',
            'subject'   =>  'required',
            'message'   =>  'required'
        ]);
        */

        $viewConfig = array("siteTitle" => "Chemisphere", "formAction" => "/saveProduct");
        $data = array("config" => $viewConfig, "productBrandList" => $productBrandList, "inputs" => $input, 
        "brandResult" => $getBrandByCodeResult, "productDisplayImage" => $this->defaultProductDisplayPreviewImage);
        
        return view('product', ["data" => $data]);
    }

    function updateProduct($productId){
        $productBrandList = ProductBrand::all()->toArray();
        
        $product = Product::find($productId);

        $viewConfig = array("siteTitle" => "Chemisphere", "formAction" => "/saveProduct");
        $data = array("config" => $viewConfig, "productBrandList" => $productBrandList);
        
        $selectedProductBrandCode = null;
        if ($product != null){
            $selectedProductBrandCode = $product->product_brand_code;
            $productDisplayImage = ($product->display_image_filepath == null) ? $this->defaultProductDisplayPreviewImage : $product->display_image_filepath;
        }

        return view('product', ["data" => $data, "product" => $product, "selectedProductBrandCode" => $selectedProductBrandCode,
        "productDisplayImage" => $productDisplayImage]);
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
        
        $viewConfig = array("siteTitle" => "Chemisphere", "formAction" => "/saveProduct");
        $data = array("config" => $viewConfig, "productBrandList" => $productBrandList);
        
        return view('product', ["data" => $data]);
    }
}
