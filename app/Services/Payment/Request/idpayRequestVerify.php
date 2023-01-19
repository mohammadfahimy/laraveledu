<?php

namespace App\Services\Payment\Request;

use App\Services\Payment\Contracts\requestInterFaces;

class idpayRequestVerify implements requestInterFaces
{
    private $id ;
    private $order_id ;

    public function __construct(array $data) 
    {
       $this->id = $data['id'];
       $this->order_id = $data['order_id'];
    }


    public function getOrderId()
    {
        return $this->order_id;
    }

    public function getId()
    {
        return $this->id;
    }

}