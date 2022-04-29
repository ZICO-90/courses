<?php

namespace App\Http\Controllers\users\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Cookie;
class LoginController extends Controller
{

    public function store(Request $request)
    {
        /*
            لا تعرف المستخدم اذ كان البريد موجود ولا لا فقط يعلم ان المعلومات التي قدمها غير مناسبة في رساله
        */
        $rules = [
                    
            'email' => ['required', 'string', 'email' ],
            'password' => ['required', 'string'],
            
        ];
    
       
    
        $data =  $this->validate($request ,$rules);
        
      /*
            > remember_me مش شغاله عندي بحثت كتير وملقتش حل لها مؤجله لحين معرفة السبب
      */
        $remember = $request->has('remember')  ? true : false;

     
        if( Auth::guard('web')->attempt([ 'email' => $data['email'] , 'password' => $data['password']  ] , $remember  ) )
        {
        
            if(!auth()->guard('web')->user()->email_verified)
            {
                $email = auth()->guard('web')->user()->email ;
                Auth::guard('web')->logout();
    
                return redirect()->route('homepage')->with(['error' => 'البريد الاكتروني غير  مفعل اذهب الي بريدك الاكتروني وقم بالتفعيل '])->with(['verifyEmail' => $email])->withInput();
            }

            $user = auth()->guard('web')->user()->remember_token ;
            if( $remember )
            {
                
                // 6  month
               Cookie::queue('remember_', $user , 259200);
               Cookie::queue('email_', $data['email'], 259200);
               Cookie::queue('password_',  $data['password']  , 259200);
            }else{
               Cookie::queue(
                   Cookie::forget('remember_')
               );
       
               Cookie::queue(
                   Cookie::forget('email_')
               );
       
               Cookie::queue(
                   Cookie::forget('password_')
               );
            }
           
            return redirect()->intended(route('homepage'));
        }
    
        return redirect()->back()->with(['error' => 'كلمة المرور او البريد الالكتروني غير صحيحه']) ;
        
           
       }
    

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
