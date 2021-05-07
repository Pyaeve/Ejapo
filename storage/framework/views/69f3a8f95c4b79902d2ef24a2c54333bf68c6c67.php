<?php $__env->startSection('content'); ?>
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		<?php echo e(Breadcrumbs::render('admin_irp_ingresos_cargar')); ?>

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
                <div class="card-header">Cargar Ingresos para <b><?php echo $cliente[0]->NRODOC; ?> | <?php echo $cliente[0]->CONTRIBUYENTE; ?></b></div>

                <div class="card-body">
                     <?php echo BootForm::open()->action(route('admin.irp.ingresos.guardar')); ?>

                            <?php echo BootForm::hidden('cliente_id')->value($cliente[0]->ID); ?> 
                            <?php echo BootForm::hidden('empresa_id')->value($empresa); ?>

                            <?php echo BootForm::hidden('cliente_ruc')->value($cliente[0]->NRODOC); ?> 
                    <div class="container">
                        <div class="row">
                          
                           <div class="col-md-6">
                             
                              <?php echo BootForm::select('Contribuyente','contribuyente')->options($contribuyentes)->addClass('contribuyente'); ?>                               <?php echo BootForm::select('Tipo Ingreso','tipoIngreso')->options($tipo_ingreso)->select('REMDEP')->addClass('tipoIngreso'); ?> 
                            
                              <?php echo BootForm::text('Total Ingreso No Gravado','ingresoNoGravado')->value(0)->addClass('ingresoNoGravado'); ?>

                              <?php echo BootForm::text('Total Ingreso Gravado','ingresoGravado')->value(0)->addClass('ingresoGravado'); ?>

                              <?php echo BootForm::text('Total Ingreso Neto','ingresoTotal')->value(0)->addClass('ingresoTotal'); ?>

                           </div>
                           <div class="col-md-6">
                              <?php echo BootForm::select('Tipo Documento','tipo')->options($tipo_doc)->addClass('tipo_doc')->select('5'); ?>   
                            
                              <?php echo BootForm::date('Fecha','fecha'); ?>

                              <?php echo BootForm::label('Condicion')->addClass('condicion'); ?><br>  
                              <?php echo BootForm::inlineRadio('Contado','condicion')->addClass('contado'); ?>

                              <?php echo BootForm::inlineRadio('Credito','condicion')->addClass('credito'); ?><br><br>
                              <?php echo BootForm::text('Documento Nro','doc_nro')->addClass('doc_nro'); ?>

                              <?php echo BootForm::text('Timbrado','timbrado')->addClass('timbrado_nro'); ?>

                           </div>
                          
                           
                           <?php echo BootForm::submit('Cargar')->addClass('btn btn-primary'); ?>

                            
                             
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

   
  

      $('.contribuyente').change(function(e){
        var v =  $('.contribuyente').val();
       
        var url1='<?php echo env('APP_URL'); ?>/admin/contribuyentes/ajax/ruc/'+v;
        $.ajax({
            url: url1,
            success: function(res) {
                
                $('.contribuyente_ruc').val(res);
             },
            error: function() {
                alert("No se ha podido obtener la información");
            }
        });
        var url2='<?php echo env('APP_URL'); ?>/admin/contribuyentes/ajax/timbrado/'+v;
        $.ajax({
            url: url2,
            success: function(res) {
                
                $('.timbrado_nro').val(res);
             },
            error: function() {
                alert("No se ha podido obtener la información");
            }
        });
    });
    $('.contribuyente').select2({
    theme: "bootstrap"
});
     $('.tipoIngreso').select2({
    theme: "bootstrap"
});
     $('.tipo_doc').select2({
    theme: "bootstrap"
});

var importe =0;
var total=0;
var subtotal=0;



$('.ingresoTotal').val(0);
$('.ingresoGravado').val(0);
$('.ingresoNoGravado').val(0);

$('.ingresoGravado').change(function(){
  
   importe=parseInt($('#ingresoGravado').val());
   subtotal=parseInt($('#ingresoNoGravado').val());
  
   total=(subtotal+ importe);
   $('#ingresoTotal').val(total);

});
$('.ingresoNoGravado').change(function(){
  
   importe=parseInt($('#ingresoGravado').val());
   subtotal=parseInt($('#ingresoNoGravado').val());
  
   total=(subtotal+ importe);
   $('#ingresoTotal').val(total);

});


$('.doc_nro').mask("999-999-9999999");
$('.tipo_doc').ha
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>