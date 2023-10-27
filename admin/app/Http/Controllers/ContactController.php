<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    
    public function contactIndex(){

        return view('contact');
   }

   public function getContactData(){

    $result =  json_encode(contact::orderBy('id','desc')->get());
    return $result;
  }




 public function contactDelete(Request $request){

    $id = $request->input('id');
    $result = contact::where('id', '=', $id)->delete();

    if($result){
        return 1;
    }else{
        return 0;
    }
}


}