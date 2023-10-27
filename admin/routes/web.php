<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


//Login Panel

Route::controller(LoginController::class)->group(function () {
        
    Route::get('/Login','LoginIndex');
    Route::post('/onLogin','onLogin');
    Route::get('/logOut','onLogout')->name('logout');
});

//All Page Route
Route::middleware(['loginCheck'])->group(function () {

    Route::get('/',[HomeController::class,'HomeIndex'])->name('home');
    Route::get('/visitor',[VisitorController::class,'VisitorIndex'])->name('visitor');


    Route::controller(ServiceController::class)->group(function () {

        Route::get('/service','ServiceIndex')->name('service');
        Route::get('/getServiceData','getServiceData');
        Route::post('/serviceDelete','serviceDelete');
        Route::post('/serviceDetails','getServiceDetails');
        Route::post('/serviceUpdate','serviceUpdate');
        Route::post('/serviceAdd','serviceAdd');
    });

    Route::controller(ProjectController::class)->group(function () {
        
        Route::get('/projects','projectsIndex')->name('project');
        Route::get('/getprojectsData','getProjectsData');
        Route::post('/projectsDelete','projectsDelete');
        Route::post('/projectsDetails','getProjectsDetails');
        Route::post('/projectsUpdate','projectsUpdate');
        Route::post('/projectsAdd','projectsAdd');
    });

    Route::controller(CourseController::class)->group(function () {
      

        Route::get('/courses','CourseIndex')->name('course');
        Route::get('/getCoursesData','getCoursesData');
        Route::post('/coursesDelete','coursesDelete');
        Route::post('/coursesDetails','getCoursesDetails');
        Route::post('/coursesUpdate','coursesUpdate');
        Route::post('/coursesAdd','coursesAdd');
    });

    Route::controller(ContactController::class)->group(function () {

        Route::get('/contact', 'contactIndex')->name('contact');
        Route::get('/getcontactData','getContactData');
        Route::post('/contactDelete','contactDelete');
    });
 
    
});
