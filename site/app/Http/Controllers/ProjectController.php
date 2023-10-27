<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
  
class ProjectController extends Controller
{
    public function projectPage(){

        $projectData = json_decode(Project::orderBy('id','desc')->get());
        return view('Projects',['projectData'=>$projectData]);
    }
}
