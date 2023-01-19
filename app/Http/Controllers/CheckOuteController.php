<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOutRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\Payment\Payment;
use App\Services\Payment\Request\idpayRequest;
use App\Services\Payment\Request\idpayRequestVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckOuteController extends Controller
{

    public function index()
    {
        $basket = !is_null(json_decode(Cookie::get('basket'),true)) ? json_decode(Cookie::get('basket'),true) : [];
        return view('frontend.product.checkoute', compact('basket'));
    }

    public function store(CheckOutRequest $request)
    {
        $validated = $request->validated();


        $password = password_hash('123456789',PASSWORD_BCRYPT);

        $userCreated = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $password,
        ]);

        try{
            $basket = json_decode(Cookie::get('basket'),true);

            if(is_null($basket)){
                throw new \Exception(__('message.Your_Basket_Is_Empty'));
            }

            $product_ids = array_keys($basket);

            $order = Order::create([
                'user_id' => $userCreated->id,
                'amount' => $validated['amount'],
                'ref_code' => $password,
                'status' => 'unpayid',
            ]);

            foreach($product_ids as $product)
            {
                $products = Product::find($product);
                $order->orderitems()->create([
                    'price' => $products->price,
                    'product_id' => $products->id,
                ]);
            }
            $request = new idpayRequest($request->all());
            $paymentService = new Payment($validated['provider'], $request);
            return $paymentService->pay();

            

        }catch(\Exception $e){
           return back()->with('failed',$e->getMessage());
        }
       
    }

    public function callback(Request $request)
    {
        // dd($request->all());
        $request = new idpayRequestVerify([
            'id' => $request->id,
            'order_id' => $request->order_id
        ]);

        $paymentService = new Payment(Payment::IDPAY_PROVIDER, $request);

        $verify = $paymentService->verify();
        
        if($verify['status'] == false)
        {
            throw new \Exception(__('message.'.$verify['msg']));
        }
    }
}
