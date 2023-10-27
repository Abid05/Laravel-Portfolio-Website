<?php

namespace App\Http\Controllers;

use App\Models\service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function ServiceIndex(){

         return view('Services');
    }

    public function getServiceData(){

       $result =  json_encode(service::orderBy('id','desc')->get());
       return $result;
    }

    public function getServiceDetails(Request $request){

        $id = $request->input('id');
        $result =  json_encode(service::where('id', '=', $id)->get());
        return $result;
     }

    public function serviceDelete(Request $request){

        $id = $request->input('id');
        $result = service::where('id', '=', $id)->delete();

        if($result){
            return 1;
        }else{
            return 0;
        }
    }

    public function serviceUpdate(Request $request){

        $id = $request->input('id');
        $name = $request->input('name');
        $des = $request->input('des');
        $img = $request->input('img');

        $result = service::where('id', '=', $id)->update(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);

        if($result){
            return 1;
        }else{
            return 0;
        }
    }

    public function serviceAdd(Request $request){

        $name = $request->input('name');
        $des = $request->input('des');
        $img = $request->input('img');

        $result = service::insert(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);

        if($result){
            return 1;
        }else{
            return 0;
        }
    }

}
