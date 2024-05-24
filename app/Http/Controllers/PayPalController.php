<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use PayPalHttp\HttpException;

class PayPalController extends Controller
{
    private $client;

    public function __construct()
    {
        $clientId = config('paypal.sandbox.client_id');
        $clientSecret = config('paypal.sandbox.secret');
        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $this->client = new PayPalHttpClient($environment);
    }
    
    public function createOrder(Request $request)
{

    $billingInfo = $request->only(['nombre', 'email', 'telefono', 'direccion', 'ciudad', 'departamento', 'postal']);
        session()->put('billing_info', $billingInfo);

    

    $items = $request->input('items'); 
    $subtotal = $request->input('subtotal'); 
    $shippingCost = $request->input('shipping_cost'); 
    $total = $request->input('total');
    session()->put('items', $items);
        session()->put('subtotal', $subtotal);
        session()->put('shipping_cost', $shippingCost);
        session()->put('total', $total);

    

    $orderRequest = new OrdersCreateRequest();
        $orderRequest->prefer('return=representation');
        $orderRequest->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => "USD",
                    "value" => $total
                ]
            ]],
            "application_context" => [
                "cancel_url" => route('paypal.cancel'),
                "return_url" => route('paypal.success')
            ]
        ];

        try {
            $response = $this->client->execute($orderRequest);

            foreach ($response->result->links as $link) {
                if ($link->rel == 'approve') {
                    return redirect($link->href);
                }
            }
        } catch (HttpException $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }
    
    public function paymentSuccess(Request $request){
        

        if (!session()->has(['billing_info', 'items', 'subtotal', 'shipping_cost', 'total'])) {
            return redirect()->route('checkout')->with('error', 'Error al procesar la orden. Por favor, inténtalo de nuevo.');
        }

        $billingInfo = session('billing_info');
        $items = session('items');
        $subtotal = session('subtotal');
        $shippingCost = session('shipping_cost');
        $total = session('total');


    $voucher = session()->all();
    if (!isset($voucher['billing_info']) || !isset($voucher['items']) || !isset($voucher['subtotal']) || !isset($voucher['shipping_cost']) || !isset($voucher['total'])) {
        return redirect()->route('checkout')->with('error', 'Error al procesar la orden. Por favor, inténtalo de nuevo.');
    }
        $order = Order::create([
            'nombre' => $voucher['billing_info']['nombre'],
            'email' => $voucher['billing_info']['email'],
            'telefono' => $voucher['billing_info']['telefono'],
            'direccion' => $voucher['billing_info']['direccion'],
            'ciudad' => $voucher['billing_info']['ciudad'],
            'departamento' => $voucher['billing_info']['departamento'],
            'postal' => $voucher['billing_info']['postal'],
            'subtotal' => $voucher['subtotal'],
            'shipping_cost' => $voucher['shipping_cost'],
            'total' => $voucher['total']
        ]);
        foreach ($items as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ]);
        }

        Cart::destroy();
        return view('paypal.success');
    }
    public function paymentCancel(){
        return view('paypal.cancel');
    }

}
