<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

   
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">



 
    <!-- Styles 
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.css"> -->
       <link rel="stylesheet" type="text/css" href="<?php echo asset('css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo asset('css/app.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo asset('css/select2.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo asset('css/select2-bootstrap.css'); ?>">
   
  <link href='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.css' rel='stylesheet' />


  <link href='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.css' rel='stylesheet' />

  <link href='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.css' rel='stylesheet' />

  <link href='https://unpkg.com/@fullcalendar/list@4.4.0/main.min.css' rel='stylesheet' />

  <link href="<?php echo e(URL::asset('font-awesome/css/font-awesome.css')); ?>" rel="stylesheet">
 
</head>
   

<body>
    <div id="app">
         <?php if(auth()->guard()->guest()): ?>

         <?php else: ?>
          <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <?php echo e(config('app.name', 'Laravel')); ?>

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <?php if(Auth::check()): ?>

    

                        <?php echo $__env->make(config('laravel-menu.views.bootstrap-items'), ['items' => $BackeckAdminNavBar->roots()], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                     <a class="dropdown-item" href="<?php echo e(route('admin.usuarios.perfil')); ?>">
                                      Perfil
                                    </a>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        
          <?php endif; ?>
        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
<!-- Scripts -->
 
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"  ></script>
    <script type="text/javascript" src="<?php echo asset('js/jquery.mask.js'); ?>"></script>
       <script type="text/javascript" src="<?php echo asset('js/popper.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/tooltips.min.js'); ?>"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/js/bootstrap.js"></script>
<script src='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.js'></script>




  <script src='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.js'></script>

  <script src='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.js'></script>

  <script src='https://unpkg.com/@fullcalendar/list@4.4.0/main.min.js'></script>

  <script src='https://unpkg.com/@fullcalendar/bootstrap@4.4.0/main.min.js'></script>


 
 
 <script type="text/javascript" src="<?php echo asset('js/select2.js'); ?>"></script>


    <script type="text/javascript">
        $(document).ready(function(){
             <?php echo $__env->yieldContent('scripts'); ?>
        });
    </script>
</html>
