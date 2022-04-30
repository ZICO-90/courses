<?php

namespace App\Http\Controllers\users\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\VerifyUsers;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
       $country = $this->dropDownList();
       $policy = \App\Models\PrivacyPolicy::get()->first();
      
        return view('sites.auth.register',compact('country' ,'policy'));
    }

    public function dropDownList()
    {
        return \App\Models\Countrie::pluck('name' , 'id');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
       
  

        $request->validate([
            'full_name' => ['required', 'string', 'min:10' , 'max:255'],
            'username' => ['required', 'string','min:6' , 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'same:password',  Rules\Password::defaults()] ,
            'phone' => ['required', 'regex:/(01)[0-9]{9}/', 'unique:users'],
            'country_id' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
        ]);

        $is_work =  null ;
        if(!$request->has('instructor') && !$request->has('student'))
        {
            $errors = new \Illuminate\Support\MessageBag();
            $errors->add('at_least_one', 'يجب ان تختار مدرب او متدرب او كلامها');
            return back()->withErrors( $errors )->withInput()->with([ 'country' => $this->dropDownList()]);
        }

        if(!$request->has('policy'))
        {
            $errors = new \Illuminate\Support\MessageBag();
            $errors->add('policy', 'يجب الموافقة علي سياسة الخصوصية');
            return back()->withErrors( $errors )->withInput()->with([ 'country' => $this->dropDownList()]);
        }

        if($request->has('instructor') && $request->has('student'))
            $is_work = 3 ;
        elseif($request->has('instructor'))
            $is_work = $request->instructor ;
        elseif($request->has('student'))
            $is_work = $request->student ;
        

         

        $user = User::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'gender' => $request->gender,
            'is_work' =>  $is_work,
            'policyactivation' => $request->policy ,
            'country_id' => $request->country_id,
        ]);

        $last_id = $user->id ;
        $token = $last_id.hash('sha256' ,Str::random(120));

      $url = route('register.verify' , ['token' => $token ]) ;

        VerifyUsers::create([
            'user_id' => $last_id  ,
            'token'=> $token ,
        ]) ;


$mail_data = [
    'recipient' => $request->email,
    'formEmail' =>$request->email,
    'subject' => 'email verification',
    'actionUrl' => $url   ,
    'username' => $request->full_name,
] ;


\Mail::send('sites.mail.email-verify-template', ['data' =>  $mail_data] , function($message) use($mail_data){

    $message->to($mail_data['recipient']);
    $message->from($mail_data['formEmail'] , $mail_data['formEmail'] );
    $message->subject($mail_data['subject'] );
   
});



       if(!empty($user))
       return back()->with(['success' => 'تم التسجيل بنجاح ! لقد ارسلنا لك رابط التحقق علي البريد الالكتروني'])->with([ 'country' => $this->dropDownList()]);
       else
       return back()->with(['error' => 'يوجد مشكله برجاء المحاوله مره اخري '])->with([ 'country' => $this->dropDownList()]);

    }

    public function  verify($token)
    {
        $VerifyUser =  VerifyUsers::where('token' , $token )->first();
        if(!is_null($VerifyUser))
        {
            $user = $VerifyUser->user ;
            if(!$user->email_verified)
            {
                $VerifyUser->user-> email_verified = 1;
                $VerifyUser->user->save();
                return redirect()->route('homepage')->with(['success' => 'تم تفعيل البريد الالكتروني بنجاح يمكنك الدخول الان' ])->with(['verifyEmail' =>  $user->email]);
            }else{
                return redirect()->route('homepage')->with(['success' => 'البريد الالكتروني مفعل بالفعل '])->with(['verifyEmail' =>  $user->email]);
            }
        }
    }
}
