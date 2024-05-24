<!DOCTYPE html>
<html>
<head>
    <title>Pago Exitoso</title>
    <script>
        // Mostrar una alerta de pago exitoso y redirigir al usuario al inicio
        window.onload = function() {
            alert('Pago exitoso. ¡Gracias por tu compra!');
            window.location.href = '{{ route('inicio') }}';
        };
    </script>
</head>
<body>
    
    <h2>¡Compra exitosa!</h2>
</body>
</html>
