<?php

namespace App\Services\Payment\Providers;

use App\Services\Payment\Contracts\abstractProvidersInterface;
use App\Services\Payment\Contracts\payableInteface;

class idpayProvider extends abstractProvidersInterface implements payableInteface{

    private $statusOkay = 100;
    public $statusWaiting = '10';

    public function pay()
    {
        $params = array(
            'order_id' => '21',
            'amount' => $this->request->getAmount(),
            'name' => $this->request->getName(),
            'phone' => '09382198592',
            'mail' => $this->request->getEmail(),
            'desc' => 'توضیحات پرداخت کننده',
            'callback' => route('checkout.callback'),
          );
          
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: 732b75c3-2e23-49bc-92e9-d093e2a19dd1',
            'X-SANDBOX: 1'
          ));
          
          $result = curl_exec($ch);

          $result = json_decode($result,true);

          if(isset($result['error_code']))
          {
            throw new \Exception('we have errorr');
          }
          
          curl_close($ch);
          return redirect()->away($result['link']);
    }

    public function verify()
    {
        $params = array(
            'id' => $this->request->getId(),
            'order_id' => $this->request->getOrderId(),
          );
          
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/inquiry');
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: 732b75c3-2e23-49bc-92e9-d093e2a19dd1',
            'X-SANDBOX: 1',
          ));
          
          $result = curl_exec($ch);
          $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          curl_close($ch);
          
          $new_result = json_decode($result, true);

          if(isset($new_result['error_code'])){
            return [
              'status' => false,
              'msg' => $result['error_message']
            ];
          }
          if( $new_result['status'] == $this->statusOkay ){

            return [
              'status' => true,
              'data' =>$new_result
            ];
  
          }
          if($new_result['status'] == $this->statusWaiting){

            return [
                'status' => false,
                'data' => $new_result
            ];

          }

          if($new_result['status'] == 1)
          {
            return [
                'status' => false,
                'msg' =>  'پرداخت انجام نشده است'
            ];
          }
    }


}