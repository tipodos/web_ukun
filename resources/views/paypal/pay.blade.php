@extends('layouts.app')

@section('content')
    <form id="paypal-form" action="{{ route('paypal.createOrder') }}" method="post">
        @csrf
        <input type="hidden" name="total" value="100">
        <button type="submit">Pagar con PayPal</button>
    </form>

    <div id="paypal-button-container"></div>
@endsection

@section('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.sandbox.client_id') }}&currency=USD"></script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '100.00' // Aquí puedes usar la variable PHP que contiene el total a pagar
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Aquí puedes redirigir al usuario a una página de éxito o hacer otras acciones
                    alert('Transaction completed by ' + details.payer.name.given_name);
                });
            }
        }).render('#paypal-button-container'); // Renderiza el botón de PayPal en el contenedor especificado
    </script>
@endsection
