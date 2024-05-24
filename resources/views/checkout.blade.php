@extends('plantilla.cabecera')
@section('titulo', 'Checkout')

@section('contenido')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Checkout Start -->
    <div class="container-fluid pt-3">
        <div class="row px-xl-3">
            <div class="col-lg-10">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Total del Pedido</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Productos</h5>
                        @foreach (Cart::content() as $item)
                            <div class="d-flex justify-content-between">
                                <p>{{ $item->name }}</p>
                                <p>S/{{ number_format($item->price, 2) }}</p>
                            </div>
                        @endforeach
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">S/{{ Cart::subtotal() }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Envío</h6>
                            <h6 class="font-weight-medium">S/10</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">S/{{ Cart::total() + 10 }}</h5>
                        </div>
                    </div>
                </div>

                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Pago</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal" checked>
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <form action="{{ route('paypal.createOrder') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <h4 class="font-weight-semi-bold mb-2">Datos de Facturación</h4>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Nombre</label>
                                        <input class="form-control" type="text" name="nombre" placeholder="Juan" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Correo Electrónico</label>
                                        <input class="form-control" type="email" name="email" placeholder="ejemplo@correo.com"
                                            required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Teléfono</label>
                                        <input class="form-control" type="text" name="telefono" placeholder="+51 123 456 789"
                                            required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Dirección</label>
                                        <input class="form-control" type="text" name="direccion" placeholder="Av. Principal 123"
                                            required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Ciudad</label>
                                        <input class="form-control" type="text" name="ciudad" placeholder="Lima" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Departamento</label>
                                        <input class="form-control" type="text" name="departamento" placeholder="Lima" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Código Postal</label>
                                        <input class="form-control" type="text" name="postal" placeholder="15023" required>
                                    </div>
                                </div>
                            </div>

                            @foreach (Cart::content() as $item)
                                <input type="hidden" name="items[{{ $loop->index }}][name]" value="{{ $item->name }}">
                                <input type="hidden" name="items[{{ $loop->index }}][price]" value="{{ $item->price }}">
                                <input type="hidden" name="items[{{ $loop->index }}][quantity]"
                                    value="{{ $item->qty }}">
                            @endforeach

                            <!-- Total y envío -->
                            <input type="hidden" name="subtotal" value="{{ Cart::subtotal() }}">
                            <input type="hidden" name="shipping_cost" value="10">
                            <input type="hidden" name="total" value="{{ Cart::total() + 10 }}">

                            <input type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3"
                                value="Realizar Pedido">
                        </form>
                        <div id="paypal-button-container"></div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold">
                        <span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper
                    </h1>
                </a>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore
                    amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name"
                                    required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe
                                    Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All Rights
                    Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->
@endsection
