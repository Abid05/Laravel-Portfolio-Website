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

         $totalContact =   contact::count();
         $totalCourse  =   course::count();
         $totalProject =   Project::count();
         $totalReview  =   review::count();
         $totalService =   service::count();
         $totalVisitor =   visitor::count();

        return view('Home',[
            'totalContact' => $totalContact,
            'totalCourse'  => $totalCourse,
            'totalProject' => $totalProject,
            'totalReview'  => $totalReview,
            'totalService' => $totalService,
            'totalVisitor' => $totalVisitor
        ]);
    }
}
