@extends('plantilla.cabecera')
@section('titulo', 'checkout')

@section('contenido')
<script src="https://www.paypal.com/sdk/js?client-id=TU_CLIENT_ID&currency=USD"></script>
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
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Datos de Facturación</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" placeholder="Juan">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Apellido</label>
                            <input class="form-control" type="text" placeholder="Pérez">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Correo Electrónico</label>
                            <input class="form-control" type="text" placeholder="ejemplo@correo.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Teléfono</label>
                            <input class="form-control" type="text" placeholder="+51 123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Dirección Línea 1</label>
                            <input class="form-control" type="text" placeholder="Av. Principal 123">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Dirección Línea 2</label>
                            <input class="form-control" type="text" placeholder="Urb. Las Flores">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>País</label>
                            <select class="custom-select">
                                <option selected>Perú</option>
                                <option>Argentina</option>
                                <option>Chile</option>
                                <option>Colombia</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Ciudad</label>
                            <input class="form-control" type="text" placeholder="Lima">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Departamento</label>
                            <input class="form-control" type="text" placeholder="Lima">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Código Postal</label>
                            <input class="form-control" type="text" placeholder="15023">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="crearCuenta">
                                <label class="custom-control-label" for="crearCuenta">Crear una cuenta</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="envioDiferente"
                                    data-toggle="collapse" data-target="#direcciones-envio">
                                <label class="custom-control-label" for="envioDiferente">Enviar a una dirección
                                    diferente</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse mb-4" id="direcciones-envio">
                    <h4 class="font-weight-semi-bold mb-4">Dirección de Envío</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" placeholder="Ana">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Apellido</label>
                            <input class="form-control" type="text" placeholder="García">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Correo Electrónico</label>
                            <input class="form-control" type="text" placeholder="ejemplo@correo.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Teléfono</label>
                            <input class="form-control" type="text" placeholder="+51 987 654 321">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Dirección Línea 1</label>
                            <input class="form-control" type="text" placeholder="Av. Secundaria 456">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Dirección Línea 2</label>
                            <input class="form-control" type="text" placeholder="Urb. Las Palmeras">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>País</label>
                            <select class="custom-select">
                                <option selected>Perú</option>
                                <option>Argentina</option>
                                <option>Chile</option>
                                <option>Colombia</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Ciudad</label>
                            <input class="form-control" type="text" placeholder="Arequipa">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Departamento</label>
                            <input class="form-control" type="text" placeholder="Arequipa">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Código Postal</label>
                            <input class="form-control" type="text" placeholder="04001">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Total del Pedido</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Productos</h5>
                        <!-- Mostrar cada producto del carrito -->
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
                            <h6 class="font-weight-medium">S/10</h6> <!-- Puedes cambiar esto según tus reglas de envío -->
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">S/{{ Cart::total() + 10 }}</h5> <!-- Suma el envío al total -->
                        </div>
                    </div>
                </div>

                <form action="{{ route('paypal.pay') }}" method="GET">
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
                            <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Realizar Pedido</button>
                        </div>
                    </div>
                    <script>paypal.Buttons({
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
                    }).render('#paypal-button-container'); </script>
                </form>

            </div>
        </div>
    </div>




    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper</h1>
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
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
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
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                    Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
@endsection
