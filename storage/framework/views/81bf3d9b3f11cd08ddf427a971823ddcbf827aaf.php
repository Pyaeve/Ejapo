 <?php 
                date_default_timezone_set("America/Asuncion");
setlocale(LC_TIME, 'es_PY.UTF-8');
              ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12"><br>
            <i class="float-right"><?php echo date('l d, F \d\e\l Y'); ?></i>
        		<?php echo e(Breadcrumbs::render('home')); ?>


                
        </div>
    </divY
      <div class="row justify-content-center">
        <div class="col-md-12">
                <?php echo $__env->make('admin.empresas.membrete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><h4><i class="fa fa-users"></i> Clientes</h4></div>

                <div class="card-body">
                    <h5><b><span class="count"><?php echo $total_clientes; ?></span></b> en Total</h5>
                    <h5><b><span class="count"><?php echo $total_clientes_fisicos; ?></span></b> son Fisicos </h5> 
                    <h5><b><span class="count"><?php echo $total_clientes_juridicos; ?></span></b> son Juridicos</h5> 
                    <a href="<?php echo route('admin.contribuyentes.cargar'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Cargar</a>
                    <a href="<?php echo route('admin.contribuyentes.resumen'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Resumen</a>
                      <a href="<?php echo route('admin.contribuyentes.importar'); ?>" class="btn btn-success"><i class="fa fa-cloud-upload"></i> Importar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Contribuyentes</div>

                <div class="card-body">
                   <span class="count">1250</span>  en Total
                    <a href="<?php echo route('admin.contribuyentes.cargar'); ?>" class="btn btn-success">Cargar</a>
                     <a href="<?php echo route('admin.contribuyentes.resumen'); ?>" class="btn btn-success">Resumen</a>
                </div>
            </div>
        </div>
         <div class="col-md-4">
            <div class="card">
                <div class="card-header">IRP</div>

                <div class="card-body">
                   <a href="<?php echo route('admin.irp.ingresos.clientes'); ?>" class="btn btn-success">Cargar Ingresos</a>
                    <a href="<?php echo route('admin.irp.egresos.clientes'); ?>" class="btn btn-success">Cargar Egresos</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>