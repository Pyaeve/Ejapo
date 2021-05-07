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
                <div class="card-header"><h4><i class="fa fa-cloud-download"></i> Exportar DDJJ a Aranduka</h4> </div>

                <div class="card-body">
                   <div class="container">
                     
                           <div class="col-md-12">
                               
                               <?php echo BootForm::open()->action(route('admin.irp.aranduka.exportar.procesar')); ?>

                               <?php echo BootForm::hidden('empresa_id')->value($empresa); ?>

                          <?php echo BootForm::select('Cliente','cliente_id')->options($clientes); ?>     
                        <?php echo BootForm::select('Periodo','periodo')->options(['2020'=>'2020']); ?>

                         
                          <?php echo BootForm::submit('Exportar a Aranduka')->addClass('btn btn-primary'); ?>


                        <?php echo BootForm::close(); ?>

                       
                        <br>       

                        
                    
                  
                    
                          
                       </dir>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>