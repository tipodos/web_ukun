<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PayPalController extends Controller
{
    private function getApiContext()
    {
        $paypal_conf = config('services.paypal');
        
        
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret']
            )
        );

        $apiContext->setConfig($paypal_conf['settings']);
        return $apiContext;
    }

    public function payWithPayPal()
    {
        $apiContext = $this->getApiContext();

        // Crear nuevo objeto Payer
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Crear item
        $item = new Item();
        $item->setName('Item Name')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(10);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping(2)
                ->setTax(1.2)
                ->setSubtotal(10);

        $amount = new Amount();
        $amount->setCurrency('USD')
               ->setTotal(13.2)
               ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription('Descripción del pago');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.execute'))
                     ->setCancelUrl(route('paypal.cancel'));

        $payment = new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);

        try {
            $payment->create($apiContext);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // Manejar excepción
            return redirect()->route('paypal.cancel');
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectUrl = $link->getHref();
                break;
            }
        }

        if (isset($redirectUrl)) {
            return redirect()->away($redirectUrl);
        } else {
            return redirect()->route('paypal.cancel');
        }
    }

    public function executePayment(Request $request)
    {
        $apiContext = $this->getApiContext();

        $paymentId = $request->paymentId;
        $payerId = $request->PayerID;

        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $apiContext);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // Manejar excepción
            return redirect()->route('paypal.cancel');
        }

        if ($result->getState() == 'approved') {
            // Pago aprobado
            return redirect()->route('home')->with('success', 'Pago realizado con éxito');
        }

        return redirect()->route('paypal.cancel');
    }

    public function cancelPayment()
    {
        // Lógica para manejar la cancelación del pago
        return redirect()->route('home')->with('error', 'Pago cancelado');
    }
}
