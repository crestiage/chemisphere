<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductBrand;

class MainController extends Controller
{
    function index(){
        $viewConfig = array("siteTitle" => "Chemisphere");
        $data = array("config" => $viewConfig);
        return view('main', ["data" => $data]);
    }

    function product(){
        $productBrandList = ProductBrand::all()->toArray();
        
        $viewConfig = array("siteTitle" => "Chemisphere");
        $data = array("config" => $viewConfig, "productBrandList" => $productBrandList);
        return view('product', ["data" => $data]);
    }
}
