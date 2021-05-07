<?php $__env->startSection('content'); ?>
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		<?php echo e(Breadcrumbs::render('admin_contribuyentes_cargar')); ?>

        </div>
    </div>
      <div class="row justify-content-center">
        <div class="col-md-12">
                <?php echo $__env->make('admin.empresas.membrete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cargar Contribuyente</div>

                <div class="card-body">
                   

                    <?php echo BootForm::open()->action(route('admin.familiares.guardar')); ?>

                <?php echo BootForm::hidden('empresa_id')->value($empresa); ?>

                 <?php echo BootForm::hidden('cliente_id')->value($contribuyente[0]->ID); ?>

                 <?php echo BootForm::hidden('cliente_ruc')->value($contribuyente[0]->NRODOC); ?>

                 <?php echo BootForm::select('Periodo','periodo')->options(['2020'=>'2020','2021'=>'2021','2022'=>'2022','2023'=>'2023','2024'=>'2024','2025'=>'2025'])->addClass('periodo'); ?>  
                    <?php echo BootForm::select('Tipo Vinculo','vinculo')->options($vinculos)->addClass('vinculo'); ?>                        
                     <?php echo BootForm::select('Regimen Matrimonial','regimen')->options($regimenes)->addClass('regimen'); ?>                        
                  
                    <?php echo BootForm::text('Nombre','nombre')->addClass('nombre'); ?>

                    <?php echo BootForm::text('Identificacion','identificacion')->addClass('identificacion'); ?>

                    <?php echo BootForm::date('Fecha Nac','fecha_nac')->addClass('desc'); ?>

                   
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
  
    $('.regimen').hide();
    $("label[for='regimen']").hide();
    $('.vinculo').change(function(e){
        var $this =  $('.vinculo').val();
        if($this==1){
            $('.regimen').show();
            $("label[for='regimen']").show();
        }else {
            $('.regimen').hide();
             $("label[for='regimen']").hide();
        }
    });

 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>