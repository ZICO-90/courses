<?php


namespace App\Http\ApiServices;
//Client(['verify' => false])
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Middleware;
use Illuminate\Database\Eloquent\Model;
class gatewayPaymentServices
{
    private $base_apiUrl ;
    private $headers ;
    private $request_client ;
    /**
     * @param $inject_client
     */
    public function __construct(Client $inject_client )
    {
  
        $this->request_client = $inject_client;
        $this->base_apiUrl = env('gateway_payment_base_apiURL');
        $this->headers = [
            'Content-Type' => 'application/json' ,
            'Authorization' => 'Bearer'.' ' . env('gateway_payment_token')
        ];

     
    } #-- end __construct


     /**
     * @param $urlVII
     * @param $method
     * @param $body
     * @return  false|mixed
     * @throws \GuzzleHttp\Exception\ClientException
     */
    private function buildRequest($urlVII , $method , $body = [])
    {
        
        // urlVII  II = 2  (url 2)
        $request = new Request($method , $this->base_apiUrl . $urlVII , $this->headers ) ;
      
      
        if(! $body )
            return false ;

           
           
          

            $response  = $this->request_client->send($request ,[
                'json' => $body
               
            ]);

       
            if($response->getStatusCode() != 200)
            {

                dd($response );
                return false ;
            }

            
            $response = json_decode($response->getBody() , true) ;
            
            return $response ;

    }#-- end buildRequest


   /**
     * @param $postFields
     */
    public function sendPayment($postFields )
    {
        $response = $this->buildRequest('/v2/SendPayment' , "POST" , $postFields );
      
        return $response ;
    }

   /**
     * @param $postFields
     */
    public function getPaymentStatus($postFields)
    {
        $response_json = $this->buildRequest('/v2/getPaymentStatus' , "POST" , $postFields );
      
        return $response_json ;
    }





}
