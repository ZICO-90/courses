<?php

namespace App\Http\Controllers\users\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\courses\BiographieCvRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Biography;
use Auth;
class BiographieCvController extends Controller
{
    
    public function create()
    {
        $biography =  auth()->guard('web')->user()->biography;
        
       
        return view('sites.profile.courses.biographie-cv', compact('biography'));
    }

    public function storeOrUpdate(BiographieCvRequest $request)
    {

        

        if($request->isMethod('POST'))
        {
            Biography::create([
                         'instructor_id' => auth()->guard('web')->user()->id,
                         'biography' => $request->biography ,
                         'biography_link' => $request->biography_link
            ]);

            return redirect()->back()->with(['info' =>  "تمت اضافة السيرة الذاتية بنجاخ"]);
        }elseif($request->isMethod('PUT')){

            $id = null ;
            try {

                $id  = Crypt::decrypt($request->cv);
    
        
                } catch (DecryptException $e) 
                {
                abort(404,'Not Found');
                }
    
           $update =     Biography::findOrFail($id);


           $update->update([
            'biography' => $request->biography ,
            'biography_link' => $request->biography_link
           ]);

           return redirect()->back()->with(['info' =>  "تمت تعديل السيرة الذاتية بنجاخ"]);
        }else{
            abort(404,'قد فشل هذا الطلب برجاء التحقق من صحة البيانات');
        }
       
    }
}
/*

*/