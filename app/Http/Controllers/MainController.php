<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductBrand;
use App\ContactUsMessage;

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

    function team(){
        $viewConfig = array("siteTitle" => "Chemisphere");
        $data = array("config" => $viewConfig);
        return view('main', ["data" => $data]);
    }

    //
    function processcontact(Request $request){
        // $name = $request->input('name');
        // $email = $request->input('email');
        // $input = $request->all();
        // echo "<pre>";
        // //print_r($request);
        // echo "</pre>";
        // //var_dump($request);

        // if not POST index();
        
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
        
        $viewConfig = array("siteTitle" => "Chemisphere");
        $data = array("config" => $viewConfig,'success' => 'success', 'errors' => array());
        return view('main', ["data" => $data]); 


    }

}
