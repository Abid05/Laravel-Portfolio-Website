<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    
    public function projectsIndex(){

        return view('Projects');
   }

   public function getProjectsData(){

    $result =  json_encode(Project::orderBy('id','desc')->get());
    return $result;
  }

  public function getProjectsDetails(Request $request){

    $id = $request->input('id');
    $result =  json_encode(Project::where('id', '=', $id)->get());
    return $result;
 }


 public function projectsDelete(Request $request){

    $id = $request->input('id');
    $result = Project::where('id', '=', $id)->delete();

    if($result){
        return 1;
    }else{
        return 0;
    }
}

public function projectsUpdate(Request $request){

    $id = $request->input('id');
    $p_name = $request->input('project_name');
    $p_des = $request->input('project_des');
    $p_link = $request->input('project_link');
    $p_img = $request->input('project_img');

    $result = Project::where('id', '=', $id)->update([
        'project_name'=>$p_name,
        'project_des'=>$p_des,
        'project_link'=>$p_link,
        'project_img'=>$p_img
    
    
    ]);

    if($result){
        return 1;
    }else{
        return 0;
    }
}


public function projectsAdd(Request $request){

    $p_name = $request->input('project_name');
    $p_des = $request->input('project_des');
    $p_link = $request->input('project_link');
    $p_img = $request->input('project_img');

    $result = Project::insert([
        'project_name'=>$p_name,
        'project_des'=>$p_des,
        'project_link'=>$p_link,
        'project_img'=>$p_img,
    ]);

    if($result){
        return 1;
    }else{
        return 0;
    }
}
}
