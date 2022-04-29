<?php

namespace App\Http\Controllers\users\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\UsersTrait;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Auth;
class UpdatePasswordController extends Controller
{
    use  UsersTrait ;
   
    private $UserModel ;

    public function __construct(User $user_Model )
    {
        $this->UserModel = $user_Model;
        
    }

    public function show()
    {
        return view('sites..profile.acount-personly.show_passwords' );
    }

    public function update(Request $request, $id)
    {   

       $data = $request->validate([
            'password_old' => ['required', Rules\Password::defaults()],
            'password' => ['required', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'same:password', Rules\Password::defaults()],
           
        ]);

       
       $reset_password = $this->get_user_by_id($id);

       if(password_verify($data['password_old']  , $reset_password->password))
       {
           $data['password'] = Hash::make($data['password']);
       }
       else
       {
           $errors = new \Illuminate\Support\MessageBag();
           $errors->add('password_old', 'كلمة المرور السابقه غير  صحيحة');
           return back()->withErrors( $errors );
       }

       unset($data['password_old'] , $data['password_confirmation']);

       $reset_password->password = $data['password'] ;
       $reset_password->save();
       Auth::login($reset_password);
       return redirect()->back()->with(['success' => 'تم تحديث كلمة السر بنجاح'] );
    
    }
}
