<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\users\HomeController;
use App\Http\Controllers\users\Auth\LoginController;
use App\Http\Controllers\users\Auth\RegisteredUserController;

use App\Http\Controllers\users\profile\AcountPersonlyController;
use App\Http\Controllers\users\profile\UpdatePasswordController;
use App\Http\Controllers\users\profile\InterestsController;
use App\Http\Controllers\users\profile\CoursesController;
use App\Http\Controllers\users\profile\LessonsController;
use App\Http\Controllers\users\profile\QuestionAnswersController;
use App\Http\Controllers\users\profile\BiographieCvController;
use App\Http\Controllers\users\profile\BrowseCoursesController;
use App\Http\Controllers\users\profile\StudentIsCoursesController;

use App\Http\Controllers\users\DisplayCourse\courseInformationController;
use App\Http\Controllers\users\DisplayCourse\courseSubscribeController;
use App\Http\Controllers\users\gatewayPaymentController;
use App\Http\Controllers\users\NotifyStudentController;
use App\Http\Controllers\users\commentsLessonController;
use App\Http\Controllers\users\testCoursesController;
use App\Http\Controllers\users\certifPrintController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class,'home'])->name('homepage');
Route::get('/searsh',[HomeController::class,'homeSearsh'])->name('home.searsh');
Route::post('/search-home',[HomeController::class,'searchAjax'])->name('search.ajax.home');

Route::group(['prefix'=>'login','as'=>'login.'], function() {
    Route::post('/',[LoginController::class , 'store'])->name('logins');
    Route::post('/logout',[LoginController::class , 'destroy'])->name('logout');
});



Route::group(['prefix'=>'register','as'=>'register.'], function() {
    Route::get('/',[RegisteredUserController::class , 'create'])->name('create');
    Route::post('/store',[RegisteredUserController::class , 'store'])->name('store');
    Route::get('/verify/{token}',[RegisteredUserController::class , 'verify'])->name('verify');
});





Route::group(['prefix'=>'text','as'=>'text.' ,'middleware' => [ 'auth' ]] , function() {
    Route::get('/',function(){return 'تم تفعيل الايميل بنجاح' ;})->name('text');
});





Route::group(['prefix'=> 'profile', 'as'=>'profile.' ,'middleware' => [ 'auth' ]] , function() {

 

    Route::get('/{id}',[AcountPersonlyController::class,'show'])->name('show.acounts');
    Route::PUT('/update/{id}',[AcountPersonlyController::class,'update'])->name('update.acounts');
   
   #-- begin password group
   Route::group(['prefix' =>  'password' ,  'as'=> 'password.'],function(){
      Route::get('/reset',[UpdatePasswordController::class,'show'])->name('reset.show');
      Route::PUT('/reset/update/{id}',[UpdatePasswordController::class,'update'])->name('reset.update');
   }); #-- end password group


    #-- begin interest group
    Route::group(['prefix' =>  'interest' ,  'as'=> 'interest.'],function(){
        Route::get('/show',[InterestsController::class,'show'])->name('show');
        Route::PUT('/update/{id}',[InterestsController::class,'update'])->name('update');
     }); #-- end interest group


      #-- begin course group 
    Route::group(['prefix' =>  'course' ,  'as'=> 'course.'],function(){

        Route::get('/add',[CoursesController::class,'addCourseShow'])->name('add');
        Route::POST('/create',[CoursesController::class,'CourseCreate'])->name('create');
        Route::get('/details',[CoursesController::class,'details'])->name('details');
        Route::put('/update-course/{id}',[CoursesController::class,'updateCourese'])->name('update.course');
        Route::match(['PUT' , 'POST'],'/certificate/{certifi}',[CoursesController::class,'updateOrCreateCertificate'])->name('certifi');

        Route::POST('/Lesson/add',[LessonsController::class,'lessonAdd'])->name('lesson.add');

        Route::put('/Lesson/update',[LessonsController::class,'update'])->name('lesson.update');
        Route::get('/Lesson/delete/{deleteById}',[LessonsController::class,'delete'])->name('lesson.delete');

        Route::POST('/question-answe/add',[QuestionAnswersController::class,'QuestionAnswerAdd'])->name('QuestionAnswer.add');
        Route::put('/question-answe/update',[QuestionAnswersController::class,'QuestionAnswerUpdate'])->name('QuestionAnswer.update');
        Route::get('/question-answe/delete/{deleteId}',[QuestionAnswersController::class,'allDeleteQuestion'])->name('QuestionAnswer.delete');


        Route::get('/biographie-cv',[BiographieCvController::class,'create'])->name('show.cv');
        Route::match(['PUT' , 'POST'],'/biographie-cv/update',[BiographieCvController::class,'storeOrUpdate'])->name('update.cv');

      

        Route::get('/browses-course',[BrowseCoursesController::class,'browses'])->name('browses');
        
        Route::get('/subscriber-course',[ StudentIsCoursesController::class,'subscribe'])->name('subscribe');

        
        #-- begin notify group  senEmailMessage
       Route::group(['prefix' =>  'notify' ,  'as'=> 'notify.'],function(){
        Route::post('/subscribers',[NotifyStudentController::class,'sendAllStudents'])->name('Subscribers');
        Route::get('/subscribers/{id}',[NotifyStudentController::class,'showNotify'])->name('Subscribers.show');
        Route::get('/subscribers-send-mail',[NotifyStudentController::class,'senEmailMessage'])->name('subscribers.send.mail');
         }); #-- end notify group


        Route::get('/certif-student',[certifPrintController::class,'CertifStudent'])->name('studentShow');
        Route::get('/certif-requset-student{id}',[certifPrintController::class,'CertifRequset'])->name('certif.requset.student');
                 #-- begin notify group 
       Route::group(['prefix' =>  'certif' ,  'as'=> 'print.certif.'],function(){
        Route::get('/certif-show/{id}',[certifPrintController::class,'certifPrintShow'])->name('show');
        Route::get('/print-pdf/{id}',[certifPrintController::class,'snappyBdf'])->name('snappyBdf');
        Route::get('/print-test/{id}',[certifPrintController::class,'snappyBdf_test'])->name('snappyBdf.test');


        
       
       
         }); #-- end notify group


     }); #-- end course group




}); #-- end profile group




Route::group(['prefix'=> 'courses', 'as' =>'courses.'] , function() {


    Route::get('/intro/{id}',[courseInformationController::class,'intro'])->name('intro');
    Route::get('/all-courses',[courseInformationController::class,'allCourse'])->name('allCourse');
    Route::get('/all-courses/search-interests/{id?}',[courseInformationController::class,'allCourse'])->name('search.ByIDinterests');
    Route::GET('/all-courses/search-other',[courseInformationController::class,'allCourse'])->name('search.interests');
    Route::POST('/all-courses/search-ajax',[courseInformationController::class,'searchAjax'])->name('search.Ajax');
    Route::POST('/payment',[gatewayPaymentController::class,'infoPayment'])->name('payment');
    Route::get('/callback',[gatewayPaymentController::class,'callbackPayment'])->name('callback');
    Route::get('/error-payment',[gatewayPaymentController::class,'callbackPaymentError'])->name('error');
     
}); #-- end course group 


Route::group(['prefix'=> 'subscriber', 'as' =>'subscriber.' , 'middleware' => [ 'auth:web'  ]] , function() {


    Route::get('/course/{id}',[courseSubscribeController::class,'show'])->name('show');
    Route::get('/course/individual/{id}',[courseSubscribeController::class,'individualShwo'])->name('individual.show');
    Route::POST('/course/individual',[courseSubscribeController::class,'endLeeeson'])->name('individual.endLesson');
    Route::POST('/course/free',[courseSubscribeController::class,'courseFree'])->name('course.free');
    Route::POST('/course/comments',[commentsLessonController::class,'comments'])->name('course.comments');
    Route::put('/course/comments-edit',[commentsLessonController::class,'commentsEdit'])->name('course.comments.edit');
    Route::get('/course/comments-delete/{deleteId}',[commentsLessonController::class,'commentsDelete'])->name('course.comments.delete');
    Route::POST('/course/reply-comments',[commentsLessonController::class,'reply'])->name('course.reply');
    Route::put('/course/reply-comments-edit',[commentsLessonController::class,'repliesEdit'])->name('course.reply.edit');
    Route::get('/course/reply-comments-delete/{deleteId}',[commentsLessonController::class,'repliesDelete'])->name('course.reply.delete');

    Route::post('/rating-course',[courseSubscribeController::class,'rating'])->name('rating');

    Route::group(['prefix'=> 'test', 'as' =>'test.'], function() {

        Route::get('/course/{id}',[testCoursesController::class,'testShow'])->name('show');
        Route::post('/test-finished-courses/{id}',[testCoursesController::class,'testFinished'])->name('finished');
        
      
    }); 
     
}); #-- end subscribe course group 


Route::post('/search',[HomeController::class,'searchAjax'])->name('search.ajax');

Route::get('/r-tests',[courseSubscribeController::class,'test'])->name('r.test');




