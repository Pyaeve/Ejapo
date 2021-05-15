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
                <div class="card-header"><h3><i class="fa fa-user"> </i> Cargar Contribuyente</h3></div>

                <div class="card-body">
                   

                    <?php echo BootForm::open()->action(route('admin.contribuyentes.guardar')); ?>

                   
                         <?php echo BootForm::hidden('empresa_id')->value($empresa); ?>

                        <?php echo BootForm::checkbox('Es Cliente','cliente')->addClass('es_cliente'); ?>

                   
                         <?php echo BootForm::checkbox('Es Exportador','exportador'); ?>

              
                    <?php echo BootForm::select('Tipo Contribuyente','tipo_contribuyente')->options(['1'=>'Fisico'])->addClass('tipo_contribuyente'); ?>

                    <?php echo BootForm::select('Regimen Contribuyente','regimen')->options(['1'=>'IRP','2'=>'IVA'])->addClass('reg_tributario'); ?>                             
                   
                    <?php echo BootForm::text('Denominacion, Nombre o Raz&oacute;n Social','desc')->addClass('desc'); ?>

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

                    <?php echo BootForm::submit(' Cargar')->addClass('btn btn-primary fa fa-check'); ?>

                     <a class="btn btn-default" href="<?php echo route('admin.contribuyentes.resumen'); ?>"><i class="fa fa-return">  </i>Cancelar</a>
                    <?php echo BootForm::close(); ?>

                    
                </div>
            </div>
        </div>
    </div>
</div> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
   $('.timbrado_inicio').mask('9999-99-99');
     $('.timbrado_fin').mask('9999-99-99');
  $('.reg_tributario').hide();
$("label[for='regimen']").hide();
          
   
     $('.es_cliente').click(function(){
            if($(this).prop("checked") == true){
                  $('.reg_tributario').show();
     $("label[for='regimen']").show();
            }
            else if($(this).prop("checked") == false){
                 $('.reg_tributario').hide();
     $("label[for='regimen']").hide();
            }
        });


 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>