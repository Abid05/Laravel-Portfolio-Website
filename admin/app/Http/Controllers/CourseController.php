<?php

namespace App\Http\Controllers;

use App\Models\course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function CourseIndex(){

        return view('Courses');
   }

   public function getCoursesData(){

    $result =  json_encode(course::orderBy('id','desc')->get());
    return $result;
  }

  public function getCoursesDetails(Request $request){

    $id = $request->input('id');
    $result =  json_encode(course::where('id', '=', $id)->get());
    return $result;
 }


 public function coursesDelete(Request $request){

    $id = $request->input('id');
    $result = course::where('id', '=', $id)->delete();

    if($result){
        return 1;
    }else{
        return 0;
    }
}

public function coursesUpdate(Request $request){

    $id = $request->input('id');
    $c_name = $request->input('course_name');
    $c_des = $request->input('course_des');
    $c_fee = $request->input('course_fee');
    $c_totalenroll = $request->input('course_totalenroll');
    $e_totalclass = $request->input('course_totalclass');
    $c_link = $request->input('course_link');
    $c_img = $request->input('course_img');

    $result = course::where('id', '=', $id)->update([
        'course_name'=>$c_name,
        'course_des'=>$c_des,
        'course_fee'=>$c_fee,
        'course_totalenroll'=>$c_totalenroll,
        'course_totalclass'=>$e_totalclass,
        'course_link'=>$c_link,
        'course_img'=>$c_img
    ]);

    if($result){
        return 1;
    }else{
        return 0;
    }
}


public function coursesAdd(Request $request){

    $c_name = $request->input('course_name');
    $c_des = $request->input('course_des');
    $c_fee = $request->input('course_fee');
    $c_totalenroll = $request->input('course_totalenroll');
    $e_totalclass = $request->input('course_totalclass');
    $c_link = $request->input('course_link');
    $c_img = $request->input('course_img');

    $result = course::insert([
        'course_name'=>$c_name,
        'course_des'=>$c_des,
        'course_fee'=>$c_fee,
        'course_totalenroll'=>$c_totalenroll,
        'course_totalclass'=>$e_totalclass,
        'course_link'=>$c_link,
        'course_img'=>$c_img
    ]);

    if($result){
        return 1;
    }else{
        return 0;
    }
}


}
