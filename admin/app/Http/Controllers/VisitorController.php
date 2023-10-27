<?php

namespace App\Http\Controllers;

use App\Models\visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function VisitorIndex(){

        $visitorData = json_decode(visitor::orderBy('id','desc')->take(500)->get(),true);

         return view('Visitor',['visitor'=>$visitorData]);
    }
}
