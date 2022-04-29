<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admins\loginAdminController;
use App\Http\Controllers\admins\dashboardController;
use App\Http\Controllers\admins\instructorController;
use App\Http\Controllers\admins\testCoursesController;
use App\Http\Controllers\admins\coursesController ;



Route::get('/test',function(){

    return view('sites.certif-print');
})->name('course.reply.delete');


Route::get('/login-admin',[loginAdminController::class,'loginShow'])->name('login.show.admin')->middleware('check.login.show');

Route::POST('/login-admin',[loginAdminController::class,'login'])->name('login.admin');

Route::get('/logout-admin',[loginAdminController::class,'logout'])->name('logout.admin');

#-- begin dashboard course group 
Route::group(['prefix'=> 'dashboard', 'as' =>'dashboard.' , 'middleware' =>  ['authadmin'] ] , function() {

    Route::get('/',[dashboardController::class,'home'])->name('home');

    Route::group(['prefix'=> 'instructor', 'as' =>'instructor.' ] , function() {

        Route::get('/',[instructorController::class,'getInstructor'])->name('show');
        Route::get('/stop{id}',[instructorController::class,'stopInstructo'])->name('stop');
        Route::get('/course/{id}',[instructorController::class,'courseInstructor'])->name('course');
        Route::get('/course-details/{id}',[instructorController::class,'courseDetailsInstructor'])->name('details');
        Route::get('/course-subscribers/{id}',[instructorController::class,'StudentSubscribers'])->name('subscribers');
    });

    Route::group(['prefix'=> 'test-courses', 'as' =>'test.' ] , function() {

        Route::get('/',[testCoursesController::class,'getTestStudents'])->name('show');
        Route::get('/test-finished-student/{id}/{idCourse}',[testCoursesController::class,'testFinishedStudent'])->name('finished.student');
        Route::get('/test-print/{id}',[testCoursesController::class,'statusPrintCretif'])->name('finished.print');
       
    });

    Route::group(['prefix'=> 'course', 'as' =>'course.' ] , function() {
        Route::get('/',[coursesController::class,'getCourses'])->name('show');
        Route::get('/stutas/{id}',[coursesController::class,'stutusCourse'])->name('stutas'); 
    });

}); #-- end dashboard course group  getInstructor