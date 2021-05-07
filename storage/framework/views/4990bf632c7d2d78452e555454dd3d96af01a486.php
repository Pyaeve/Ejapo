<?php $__env->startSection('content'); ?>
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		<?php echo e(Breadcrumbs::render('admin_contribuyentes_editar')); ?>

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
                <div class="card-header">Editar Contribuyente</div>

                <div class="card-body">
                    

                    <?php echo BootForm::open()->action(route('admin.contribuyentes.actualizar')); ?>

                     <?php echo BootForm::hidden('id',$data['id']); ?>

                   <div class="container">
                        <div class="row">
                            <div class="col-md-6" id="izq">
                              

                    <?php echo BootForm::text('Descripcion','desc')->value($data['desc'])->addClass('desc'); ?>

                   
                    <?php echo BootForm::text('Ciudad','ciudad')->value($data['ciudad']); ?>

                    <?php echo BootForm::text('Barrio','barrio')->value($data['barrio']); ?>

                    <?php echo BootForm::text('Direccion','direccion')->value($data['direccion']); ?>

                    <?php echo BootForm::text('Tel','tel')->value($data['cel']); ?>

                    <?php echo BootForm::email('Correo','email')->value($data['email']); ?>

                            </div>
                            <div class="col-md-6" id="der">
                               <?php echo BootForm::select('Tipo Documento','tipo_doc')->options($tipo_doc_data)->select($data['tipo_doc_id']); ?>

                    <?php echo BootForm::text('Documento Nro','nro_doc')->value($data['tipo_doc_id_codigo']); ?>

                                <?php if($data['cliente']=='1'): ?>

                             <?php echo BootForm::checkbox('Es Cliente','cliente')->value($data['cliente'])->checked()->inline(); ?>

                        <?php else: ?>
                             <?php echo BootForm::checkbox('Es Cliente','cliente')->inline(); ?>

                        <?php endif; ?>

                       
                  
                         <?php if($data['exportador']=='1'): ?>
                         <?php echo BootForm::checkbox('Es Exportador','exportador')->value($data['exportador'])->checked()->inline(); ?>

                         <?php else: ?>
                        <?php echo BootForm::checkbox('Es Exportador','exportador')->value($data['exportador'])->inline(); ?>

                         <?php endif; ?>
                    <?php if($data['cliente']=='1'): ?>
                      <?php echo BootForm::select('Obligacion Tributaria','regimen')->options($regimen)->select($data['regimen']); ?>

                         
                          <?php endif; ?>
                    <?php echo BootForm::select('Tipo Contribuyente','tipo_contribuyente')->options(['1'=>'Fisico','2'=>'Jurico'])->addClass('tipo_contribuyente')->select($data['tipo']); ?>                        
                   <?php echo BootForm::text('Timbrado Nro','timbrado_codigo')->value($data['timbrado_codigo']); ?>

                    <?php echo BootForm::date('Timbrado Inicio','timbrado_inicio')->value($data['timbrado_inicio'])->addClass('timbrado_inicio'); ?>

                    <?php echo BootForm::date('Timbrado Fin','timbrado_fin')->value($data['timbrado_fin'])->addClass('timbrado_fin'); ?>

                            </div>
                      
                  
                  
                   
                    <?php echo BootForm::submit('Actualizar')->addClass('btn btn-primary'); ?>

                 
                  </div>
                </div>
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
 
   
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>