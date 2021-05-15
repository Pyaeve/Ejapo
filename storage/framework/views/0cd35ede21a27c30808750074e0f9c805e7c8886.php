<?php $__env->startSection('content'); ?>
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		<?php echo e(Breadcrumbs::render('home')); ?>

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Exportar Hechauka</div>

                <div class="card-body">
                    <?php echo BootForm::open()->action(route('admin.iva.hechauka.exportar_procesar')); ?>

                    <?php echo BootForm::hidden('empresa_id')->value($empresa); ?>   
                    <?php echo BootForm::hidden('cliente_id')->value($cliente[0]->ID); ?>   
                    <?php echo BootForm::select('A&ntilde;o','y')->options(['2020'=>'2020','2021'=>'2021']); ?>

                    <?php echo BootForm::select('Mes','m')->options(['01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre']); ?>

                    <?php echo BootForm::select('Libro','libro')->options(['Ventas'=>'Ventas','Compras'=>'Compras']); ?>

                    <?php echo BootForm::select('Declaraci&oacute;n','ddjj')->options(['Original'=>'Original','Rectificacion'=>'Rectificacion']); ?>

                    <?php echo BootForm::submit('Exportar a Hechauka')->addClass('btn btn-primary'); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>