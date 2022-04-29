<?php

namespace App\Http\Controllers\users\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Countrie;

use App\Http\Traits\UsersTrait;
use App\Http\Traits\CountriesTraits;
use App\Http\Traits\ImagesTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class AcountPersonlyController extends Controller
{
    use  UsersTrait ;
    use CountriesTraits;
    use ImagesTrait;
    private $UserModel ;
    private $countriesModel;
    public function __construct(User $user_Model , Countrie $Countrie_model )
    {
        $this->UserModel = $user_Model;
        $this->countriesModel = $Countrie_model;
    }
    
    public function show($id)
    {

        try {
            $id  =Crypt::decrypt($id);
           
            } catch (DecryptException $e) 
            {
            abort(404,'Not Found');
            }

        $user_info = $this->get_user_by_id($id);
        $country_drop_dwon_list = $this->get_countries_drop_dwon_list();
       
        return view('sites..profile.acount-personly.show_acounts' ,compact('user_info' ,'country_drop_dwon_list') );
    }


    public function update(Request $request, $id)
    {

        try {
            $id  =Crypt::decrypt($id);
           
            } catch (DecryptException $e) 
            {
            abort(404,'Not Found');
            }
      
            //Specialization  qualification Employment
      $data =  $request->validate([
            'full_name' => ['required', 'string', 'min:10' , 'max:255'],
            'username' => ['required', 'string','min:6' , 'max:255'],
            'phone' => ['required', 'regex:/(01)[0-9]{9}/', 'unique:users,phone,'.$id],
            'country_id' => ['required', 'string', 'max:255'],
            'Specialization' => ['nullable', 'string', 'min:4', 'max:255'],
            'qualification' => ['nullable', 'string', 'min:4', 'max:255'],
            'Employment' => ['nullable', 'string', 'min:4', 'max:255'],
            'gender' => ['required'],
        ]);

       
        $user_update = $this->get_user_by_id($id);

        if($request->hasFile('avatar'))
        {
            $image =$request->file('avatar');
           
            $imageName = time().hash('sha256' , Str::random(120)) . '.' . $image->getClientOriginalExtension();
            $is_path_public = 'site/assets/images/users/';
            $oldPath = $user_update->avatar;
            $this->uploadImage($image ,$imageName,$is_path_public , $oldPath);

           $user_update->avatar = $is_path_public . $imageName ;
        }

        $user_update->update( $data);

        return back()->with(['success' => 'تم تحديث ملفك الشخصي بنجاح']);
        
    }


}
