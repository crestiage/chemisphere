<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\ContactUsMessage;
use Mail;

class MainController extends Controller
{
    function index(){
        $viewConfig = array("siteTitle" => "Chemisphere", 
        "defaultEmptyProductImagePath" => "{{ asset('resources/img/portfolio/portfolio-1.jpg') }}");

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
