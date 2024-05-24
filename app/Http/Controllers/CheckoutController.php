<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Exception\PayPalConnectionException;
use Session;

class CheckoutController extends Controller
{
    private $apiContext;
    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.sandbox.client_id'),
                config('paypal.sandbox.secret')
            )
        );

        $this->apiContext->setConfig(config('paypal.settings'));
    }
    public function paypal(Request $request)
    {
        // Recoger datos del cliente
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $telefono = $request->input('telefono');
        $direccion = $request->input('direccion');
        $ciudad = $request->input('ciudad');
        $departamento = $request->input('departamento');
        $postal = $request->input('postal');

        // Crear una instancia de Payer y establecer el método de pago a "paypal"
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Crear una lista de objetos de artículos
        $items = [];
        foreach ($request->input('items') as $item) {
            $itemObj = new Item();
            $itemObj->setName($item['name'])
                    ->setCurrency('USD')
                    ->setQuantity($item['quantity'])
                    ->setPrice($item['price']);
            $items[] = $itemObj;
        }

        // Crear una lista de artículos
        $itemList = new ItemList();
        $itemList->setItems($items);

        // Establecer los detalles
        $details = new Details();
        $details->setShipping($request->input('shipping_cost'))
                ->setSubtotal($request->input('subtotal'));

        // Establecer el monto total
        $amount = new Amount();
        $amount->setCurrency('USD')
               ->setTotal($request->input('total'))
               ->setDetails($details);

        // Crear una transacción
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription('Compra en EShopper')
                    ->setInvoiceNumber(uniqid());

        // Crear URLs de redirección
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('success'))
                     ->setCancelUrl(route('cancel'));

        // Crear el pago
        $payment = new Payment();
        $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);
        

        try {
            // Crear el pago en PayPal
            
            $payment->create($this->apiContext);

            // Obtener la URL de aprobación
            $approvalUrl = $payment->getApprovalLink();

            $orderData = [
                'customer_name' => $nombre,
                'customer_email' => $email,
                'items' => $items, // Los artículos del carrito
                'subtotal' => $request->input('subtotal'),
                'shipping_cost' => $request->input('shipping_cost'),
                'total' => $request->input('total')
            ];

            // Devolver la URL de aprobación
            return response()->json(['id' => $payment->getId(), 'links' => $payment->getLinks()]);
        } catch (PayPalConnectionException $ex) {
            $errorData = json_decode($ex->getData(), true);
            return response()->json([
                'error' => 'Error en la creación de la transacción',
                'details' => $errorData
            ]);
        }catch (\Exception $ex) {
        return response()->json([
            'error' => 'Error inesperado',
            'details' => $ex->getMessage()
        ]);
    }
}
    public function success(Request $request)
{
    // Verificar si hay parámetros de la solicitud
    if ($request->has('paymentId') && $request->has('PayerID')) {
        // Obtener los parámetros de la solicitud
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        try {
            // Obtener el pago de PayPal utilizando el ID de pago
            $payment = Payment::get($paymentId, $this->apiContext);

            // Ejecutar el pago utilizando el ID de pago y el ID del pagador
            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);

            // Procesar el pago
            $result = $payment->execute($execution, $this->apiContext);

            // Verificar si el pago se realizó correctamente
            if ($result->getState() === 'approved') {
                // Pago aprobado
                // Implementa aquí la lógica para procesar el pedido y actualizar la base de datos

                // Redirigir a una página de éxito o mostrar un mensaje de éxito
                return redirect()->route('checkout.success');
            } else {
                // Pago no aprobado
                // Implementa aquí la lógica para manejar un pago no aprobado
                return redirect()->route('checkout.cancel')->with('error', 'El pago no fue aprobado.');
            }
        } catch (PayPalConnectionException $ex) {
            // Error de conexión con PayPal
            // Manejar el error y redirigir a una página de error
            return redirect()->route('checkout.error')->with('error', 'Error de conexión con PayPal.');
        }
    } else {
        // Parámetros de solicitud incompletos
        // Redirigir a una página de error o mostrar un mensaje de error
        return redirect()->route('checkout.error')->with('error', 'Parámetros de solicitud incompletos.');
    }
}


    public function paypalCancel()
    {
        // Implementar lógica para manejar la cancelación de PayPal
    }
}
