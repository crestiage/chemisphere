<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    function index(){
        $viewConfig = array("siteTitle" => "Chemisphere");
        $data = array("config" => $viewConfig);
        return view('main', ["data" => $data]);
    }

    function product(){
        $viewConfig = array("siteTitle" => "Chemisphere");
        $data = array("config" => $viewConfig);
        return view('product', ["data" => $data]);
    }
}
