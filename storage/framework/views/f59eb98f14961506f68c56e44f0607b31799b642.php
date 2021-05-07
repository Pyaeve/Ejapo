<?php $__env->startSection('content'); ?>
<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-12">
                <?php echo e(Breadcrumbs::render('admin_contribuyentes_cargar')); ?>

        </div>
    </div>
     <div class="row justify-content-center">
        <div class="col-md-8">
               <?php echo $__env->make('admin.empresas.membrete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cargar Empresa</div>

                <div class="card-body">
                    <?php echo BootForm::open()->action(route('admin.empresas.guardar')); ?>

                    <?php echo BootForm::checkbox('Es Exportador','exportador'); ?>

                    <?php echo BootForm::text('Descripcion','desc')->addClass('desc'); ?>

                    <?php echo BootForm::select('Tipo Documento','tipo_doc')->options($tipo_doc_data); ?>

                    <?php echo BootForm::text('Documento Nro','nro_doc')->required(); ?>

                    <?php echo BootForm::text('Ciudad','ciudad')->required(); ?>

                    <?php echo BootForm::text('Barrio','barrio')->required(); ?>

                    <?php echo BootForm::text('Direccion','direccion')->required(); ?>

                    <?php echo BootForm::text('Tel','tel')->required(); ?>

                    <?php echo BootForm::email('Correo','email')->required(); ?>

                    <?php echo BootForm::text('Timbrado Nro','timbrado_codigo')->required(); ?>

                    <?php echo BootForm::date('Timbrado Inicio','timbrado_inicio')->required()->addClass('timbrado_inicio')->placeholder('asdasd'); ?>

                    <?php echo BootForm::date('Timbrado Fin','timbrado_fin')->required()->addClass('timbrado_fin'); ?>

                    <?php echo BootForm::submit('Cargar')->addClass('btn btn-primary'); ?>

                     <a class="btn btn-default" href="<?php echo route('admin.contribuyentes.resumen'); ?>">Cancelar</a>
                    <?php echo BootForm::close(); ?>

                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
   

 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>