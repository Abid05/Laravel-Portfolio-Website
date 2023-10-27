<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TermsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'HomeIndex'])->name('home');

Route::post('/contactSend',[HomeController::class,'ContactSend']);

Route::get('/projects',[ProjectController::class,'projectPage'])->name('project');
Route::get('/course',[CourseController::class,'coursePage'])->name('course');
Route::get('/contact',[ContactController::class,'contactPage'])->name('contact');
Route::get('/policy',[PolicyController::class,'policyPage'])->name(('policy'));
Route::get('/terms',[TermsController::class,'termsPage'])->name('terms');






