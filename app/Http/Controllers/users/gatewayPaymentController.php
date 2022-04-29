<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\UsersTrait;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\ApiServices\gatewayPaymentServices;
use Illuminate\Support\Facades\DB;
class gatewayPaymentController extends Controller
{
    use UsersTrait;
    private $UserModel ;
    private $service_paymen;
    public function __construct(User $user_Model , gatewayPaymentServices $injectPaymen )
    {
        $this->UserModel = $user_Model; 
        $this->service_paymen = $injectPaymen ;
    }

    public function infoPayment(Request $Info)
    {
  
        try {
            $student_id  =Crypt::decrypt($Info->UPayI);
           
            $course_id  =Crypt::decrypt($Info->CPayI);
        
            } catch (DecryptException $e) 
            {
            abort(404,'Not Found');
            }
          
          /*
            name:ahmed abduulah > any name
            cardNumber:5123450000000008
            Expiry date: any date
            CVC: any c

          */

            $student = $this->get_user_by_id($student_id);
            $course =  Course::findOrFail($course_id);
            $callBackUrl = route('courses.callback') . '?UPayI=' . $student->id . '&CPayI=' . $course->id;
            $errorUrl = route('courses.error')       . '?UPayI=' . $student->id . '&CPayI=' . $course->id;;
           
  
      
            $postFields = [
                //Fill required data
               
                'NotificationOption' => 'LNK', //'SMS', 'EML', or 'ALL'
                'InvoiceValue'       =>  $course->course_price,
                'CustomerName'       =>  $student->full_name,
                'DisplayCurrencyIso' => 'USD',  
                'CustomerMobile'     =>  $student->phone,
                'MobileCountryCode'  => '+2' ,

                'CustomerEmail'      =>$student->email,
                'CallBackUrl'        =>  $callBackUrl,
                'ErrorUrl'           =>   $errorUrl , 

                'Language'           => 'ar', 
                'CustomerReference'  =>  $student->id ,
                'CustomerCivilId'    => $course->id,
               
                    
            ];
           
         
         $open_gateway_payment  = $this->service_paymen->sendPayment($postFields );  
       
    
         return redirect()->away($open_gateway_payment['Data']['InvoiceURL']);

    }


    public function callbackPayment(Request $response )
    {
     
        $postFields = [
            'Key' => $response ->paymentId ,
            'KeyType' => 'paymentId'
            ];
       
       
       $gateway_payment_response_json = $this->service_paymen->getPaymentStatus($postFields);

    
       if($gateway_payment_response_json['IsSuccess'])
         {
             try {
                
                DB::beginTransaction();
                 $student = $this->get_user_by_id($response->UPayI);
                 $subscribe = \App\Models\UserCource::create([
                                              'student_id' => $response->UPayI ,
                                              'cource_id' => $response->CPayI ,
                                              'is_work' => $student->is_work,
                                             
                                             ]);

                $gateway_payment = \App\Models\GatewayPayment::create([
                    'student_id' =>  $subscribe->student_id,
                    'subscribe_id' => $subscribe->id,
                    'course_id' => $subscribe->cource_id,
                    'InvoiceId' =>  $gateway_payment_response_json['Data']['InvoiceId'],
                    'InvoiceStatus' => $gateway_payment_response_json['Data']['InvoiceStatus'],
                    'PaymentCreatedDate' => $gateway_payment_response_json['Data']['CreatedDate'],
                    'PaymentId' => $gateway_payment_response_json['Data']['InvoiceTransactions'][0]['PaymentId'],
                    'PaymentGateway' => $gateway_payment_response_json['Data']['InvoiceTransactions'][0]['PaymentGateway'],


                                             ]);   
                                             
                                             
                 DB::commit();
               
                 return redirect()->route('courses.intro',['id'=> Crypt::encrypt($response->CPayI)]) ;

             } catch (\Exception $ex) {
                DB::rollback();
              
                $message = "(Invoice: " . $gateway_payment_response_json['Data']['InvoiceId'] .") ". "لقد قمت بالدفع لكن حدث مشكلة ما برجاء التواصل مع الادارة !!! حتفط بهذه الرقم من فضلك" ;
                return redirect()->route('courses.intro',['id'=> Crypt::encrypt($response->CPayI)])->with(['error' => $message  ]) ;

             }


          
         }

         
         dd(  $gateway_payment_response_json);

    }


    public function callbackPaymentError(Request $response)
    {
        $postFields = [
            'Key' => $response ->paymentId ,
            'KeyType' => 'paymentId'
            ];
       
       
       $gateway_payment_response_json = $this->service_paymen->getPaymentStatus($postFields);
        dd($gateway_payment_response_json );
    }
}
