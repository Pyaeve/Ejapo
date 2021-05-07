<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Pyaeve.com La 1era. Plataforma Virtual 100% Paraguaya para Carga Simplificada de Impuestos(IVA,IRP e IRE) en la Nube</title>
 <meta name="description" content="Pyaeve.com La 1era. Plataforma Virtual 100% Paraguaya para Carga Simplificada de Impuestos(IVA,IRP e IRE) en la Nube">
   
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
 

 
    <!-- Styles 
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.css"> -->
       <link rel="stylesheet" type="text/css" href="<?php echo asset('css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo asset('css/app.css'); ?>">
</head>
   

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="#">
                    Pyaeve.com
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   La 1era. Plataforma Virtual 100% Paraguaya para Carga Simplificada de Impuestos(IVA,IRP e IRE) en la Nube
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row">
                
                <div class="col-lg-12 col-md-12 col-sm-12">
                    
                        <div class="card">
                            <div class="card-header">
                                <h4>Registro de Cuenta Gratis </h4>
                            </div>
                            <div class="card-body" >
                                    <h4 align="center">Registrate y obten una cuenta totalmente gratuita</h4>
                                    <h4 align="center">por 30 dias sin ningun compromiso..</h4>
                                   <?php echo BootForm::open()->action(route('frontend.empresas.registrar')); ?>

                                   <?php echo BootForm::text('Empresa o Emprendimiento','empresa'); ?>

                                   <?php echo BootForm::hidden('role')->value('2'); ?>

                                   <?php echo BootForm::text('Nombre','name'); ?>

                                   <?php echo BootForm::text('Apellido','sername'); ?>

                                     <?php echo BootForm::text('Email','email'); ?>

                                   <?php echo BootForm::password('Contrase&ntilde;a','password'); ?>

                                  
                                   <?php echo BootForm::submit('Crear Cuenta')->addClass('btn btn-primary'); ?>

                                   <?php echo BootForm::close(); ?>

                            </div>
                        </div>

                </div>
            </div> 
            </div>
           
        </main>
    </div>
</body>
<!-- Scripts -->
 
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"  ></script>
    <script type="text/javascript" src="<?php echo asset('js/jquery.mask.js'); ?>"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/js/bootstrap.js"></script>
 
    <script type="text/javascript">
        $(document).ready(function(){
             <?php echo $__env->yieldContent('scripts'); ?>
        });
    </script>
</html>
