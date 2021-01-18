<title>Intranet Casanare</title>
@extends('layouts.app')
@section('content')
@include('partials.notification')
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron bg-secondary shadow rounded" id="bienvenido" >
    <h1 class="display-3">Bienvenido a Intranet!</h1>
    <img src="/img/logo.png" class="img-fluid" alt="Responsive image" style="width: 50%">
    <hr>
    <p>Apreciado usuario, en el botón (Realizar Solicitud) podra acceder al formulario para solicitar
        (certificado laboral, desprendible de nómina, certificado de ingresos y retenciones)</p>
    <a  class="btn btn-primary" href="https://clinicacasanare.co/sistema/form_solicitud.php">
        Realizar Solicitud </a>

    {{--<p>Apreciado usuario para empezar oprima el boton registro y llene los campos correspondientes, posteriormente oprima registrarme
         y listo, solo queda esperar a que el administrador o encargado acepte su registro</p>--}}
    {{-- <p><a class="btn btn-light btn-lg"  data-toggle="modal" data-target="#register"  href="" role="button">Registro &raquo;</a></p>--}}
    </div>

    <div class="container">
           {{--<div class="card shadow rounded">
            <div class="card-header bg-light">
                <h2 align="center">Novedades</h2>
            </div>
</div>
<br>
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-light"><h4>Actualización 3.0</h4></div>
                    <div class="card-body"><p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac
                            cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                            Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                    </div>
                    <div class="card-footer"><p><a class="btn btn-secondary" href="#" role="button">View details
                                &raquo;</a></p></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-light"><h4>Actualización 3.0</h4></div>
                    <div class="card-body"><p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac
                            cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                            Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                    </div>
                    <div class="card-footer"><p><a class="btn btn-secondary" href="#" role="button">View details
                                &raquo;</a></p></div>
                </div>
            </div>
            <div class="col-md-4 rounded">
                <div class="card shadow">
                    <div class="card-header bg-primary text-light"><h4>Actualización 3.0</h4></div>
                    <div class="card-body"><p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac
                            cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                            Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                    </div>
                    <div class="card-footer"><p><a class="btn btn-secondary" href="#" role="button">View details
                                &raquo;</a></p></div>
                </div>
            </div>--}}
</div> <!-- /container -->
</main>

@endsection
