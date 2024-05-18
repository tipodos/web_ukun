<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu página con PayPal</title>
    <!-- Incluye el script del SDK de PayPal aquí -->
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=USD"></script>
</head>
<body>
    <!-- Contenido de tu página -->
    <h1>¡Página con PayPal!</h1>
    <!-- Otro contenido de tu página -->
    <script>
        paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            // ...
            purchase_units: [{
                amount: {
                    value: 100
                }
            }],
        });
    },
    onApprove: function(data, actions) {
        // ...
    }
}).render('#paypal-button-container'); 
    </script>
</body>
</html>