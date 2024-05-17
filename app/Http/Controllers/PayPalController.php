<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

class PayPalController extends Controller
{
    
    

    // ...

    public function payWithPayPal()
    {
        $clientId = 'tu_cliente_id_de_paypal';
        $clientSecret = 'tu_cliente_secreto_de_paypal';

        $apiContext = new ApiContext(
            new OAuthTokenCredential($clientId, $clientSecret)
        );

        // Crear un objeto de Payer
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Crear un objeto de Amount
        $amount = new Amount();
        $amount->setTotal('10.00');
        $amount->setCurrency('USD');

        // Crear un objeto de Transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount);

        // Crear un objeto de RedirectUrls
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.execute'));
        $redirectUrls->setCancelUrl(route('paypal.cancel'));

        // Crear un objeto de Payment
        $payment = new Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setTransactions([$transaction]);
        $payment->setRedirectUrls($redirectUrls);

        // Crear el pago y obtener el enlace de aprobación de PayPal
        try {
            $payment->create($apiContext);
            $approvalUrl = $payment->getApprovalLink();

            // Redirigir al usuario al enlace de aprobación de PayPal
            return redirect()->to($approvalUrl);
        } catch (\Exception $e) {
            // Manejar cualquier error que pueda ocurrir
            return redirect()->route('paypal.cancel')->withErrors(['error' => 'Error al procesar el pago']);
        }
    }

    public function payPalStatus(Request $request)
    {
        
    }

}
