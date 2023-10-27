<?php

namespace App\Http\Controllers;

use App\Models\contact;
use App\Models\course;
use App\Models\Project;
use App\Models\review;
use App\Models\service;
use App\Models\visitor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomeIndex(){

        $UserIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate= date("Y-m-d h:i:sa");
        visitor::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);

        $serviceData = json_decode(service::all());
        $coursesData = json_decode(course::orderBy('id','desc')->limit(6)->get());
        $projectData = json_decode(Project::orderBy('id','desc')->limit(10)->get());
        $reviewData = json_decode(review::all());

        return view('Home',[
            'serviceData'=>$serviceData,
            'courseData'=>$coursesData,
            'projectData'=>$projectData,
            'reviewData'=>$reviewData
        ]);
    }

    public function ContactSend(Request $request){

       $c_name   =    $request->input("contact_name");
       $c_mobile =    $request->input("contact_mobile");
       $c_email  =    $request->input("contact_email");
       $c_mgz    =    $request->input("contact_mgz");

       $result = contact::insert([

        'contact_name'=>$c_name,
        'contact_mobile'=>$c_mobile,
        'contact_email'=>$c_email,
        'contact_mgz'=>$c_mgz

       ]);


       if($result){

        return 1;

       }else{

        return 0;
       }
       
    }
}

