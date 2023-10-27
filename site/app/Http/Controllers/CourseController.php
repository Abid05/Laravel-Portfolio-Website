<?php

namespace App\Http\Controllers;

use App\Models\course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function coursePage(){

        $coursesData = json_decode(course::orderBy('id','desc')->get());
        return view('Course',['courseData'=>$coursesData]);
    }
}
