<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Cookie;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\SessionGuard;
class loginAdminController extends Controller
{
 public function loginShow()
 {
    return view('dashboardAdmins.login.login_admin');
 }

 public function login(Request $re)
 {

  $rules = [
                  
      'email' => 'required|email',
      'password' => 'required|min:6',
      
  ];

  $message =[
      'required.email' => 'البريد الالكتروني مطلوب',
      'required.password' => 'كلمة المرور مطلوبة',
     

  ];

  $data =  $this->validate($re ,$rules , $message );

  $remember = $re->has('remember') ? true : false;

  

  if( Auth::guard('admin')->attempt(['email' => $data['email'] , 'password' => $data['password'] ], $remember  ) )
  {
      $user = auth()->guard('admin')->user()	;

     if( $remember )
     {
     
         // 6  month
        Cookie::queue('remember', $user->remember_token , 259200);
        Cookie::queue('email', $data['email'], 259200);
        Cookie::queue('password',  $data['password']  , 259200);
     }else{
        Cookie::queue(
            Cookie::forget('remember')
        );

        Cookie::queue(
            Cookie::forget('email')
        );

        Cookie::queue(
            Cookie::forget('password')
        );
     }
  
     //  Auth::guard('admin')->login( $user);
      return redirect()->intended(RouteServiceProvider::ADMIN);
  }

  return redirect()->back()->with(['status' => 'كلمة المرور او البريد الالكتروني غير صحيحه']) ;
  
     
 }


 public function logout(){
    Auth::guard('admin')->logout();

    return redirect()->route('login.show.admin');   
}


}
