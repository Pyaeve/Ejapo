<?php $__env->startSection('content'); ?>
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		<?php echo e(Breadcrumbs::render('admin_iva_ventas_cargar')); ?>

        </div>
    </div>
       <div class="row justify-content-center">
        <div class="col-md-12">
                <?php echo $__env->make('admin.empresas.membrete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header"><h4><i class="fa fa-plus"> </i> Cargar Ventas para <b> <i class="fa fa-user"> </i> <?php echo $cliente[0]->NRODOC; ?> | <?php echo $cliente[0]->CONTRIBUYENTE; ?></b> </h4> 
                </div>
                <div class="card-body">
                     <?php echo BootForm::open()->action(route('admin.iva.ventas.guardar')); ?>

                      <?php echo BootForm::hidden('cliente_id')->value($cliente[0]->ID); ?> 
                            <?php echo BootForm::hidden('empresa_id')->value($empresa); ?>

                            <?php echo BootForm::hidden('cliente_ruc')->value($cliente[0]->NRODOC); ?> 
                     <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                               
                                <?php echo BootForm::select('Contribuyente','contribuyente')->options($contribuyentes)->addClass('contribuyente'); ?> 
                                 
                    <?php echo BootForm::text('Importe Total','total_importe')->addClass('total_importe'); ?>

                     <?php echo BootForm::text('Total Gravadas 10%','total_gravadas_10')->addClass('total_gravadas_10'); ?>

                      <?php echo BootForm::text('Total Debito 10%','total_gravadas_total_10')->addClass('total_gravadas_total_10'); ?>

                     <?php echo BootForm::text('Total Gravadas 5%','total_gravadas_5')->addClass('total_gravadas_5'); ?>

                     <?php echo BootForm::text('Total Debito 5%','total_gravadas_total_5')->addClass('total_gravadas_total_5'); ?>

                        <?php echo BootForm::text('Total Exentas','total_exentas')->addClass('total_exentas'); ?>


                    
                            </div>
                             <div class="col-md-6">
                                <?php echo BootForm::date('Fecha','fecha'); ?>

                                <?php echo BootForm::text('Factura Nro','factura_nro'); ?>

                    <?php echo BootForm::label('Condicion de Venta'); ?><br>
                    <?php echo BootForm::radio('Contado','condicion','contado')->inline()->addClass('contado')->selected(); ?>

                    <?php echo BootForm::radio('Credito','condicion','credito')->inline()->addClass('credito'); ?><br><br>
                     <?php echo BootForm::text('Timbrado','timbrado')->required(); ?>

                       <?php echo BootForm::text('Cuotas','cuotas')->value('0')->addClass('cuotas'); ?>

                            </div>
   
                        </div>
                     </div>
                   
                   
                   
                  
                   
                   
                    
                    <?php echo BootForm::submit('Cargar')->addClass('btn btn-primary'); ?>

                    <?php echo BootForm::close(); ?>

                 </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    $('.cliente').change(function(e){
        var v =  $('.cliente').val();
        
        var url='<?php echo env('APP_URL'); ?>/admin/contribuyentes/ajax/ruc/'+v;
        $.ajax({
            url: url,
            success: function(res) {
                
                $('.cliente_ruc').val(res)
             },
            error: function() {
                alert("No se ha podido obtener la información");
            }
        });
    });
    $('.contribuyente').change(function(e){
        var v =  $('.contribuyente').val();
        
        var url='<?php echo env('APP_URL'); ?>/admin/contribuyentes/ajax/ruc/'+v;
        $.ajax({
            url: url,
            success: function(res) {
               
                $('.contribuyente_ruc').val(res)
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
function calcularImporte(){
        var gravadas_10=parseInt($('.total_gravadas_10').val());
        var gravadas_total_10=parseInt($('.total_gravadas_total_10').val());
        var gravadas_5=parseInt($('.total_gravadas_5').val());
        var gravadas_total_5=parseInt($('.total_gravadas_total_5').val());
        var gravadas_exentas=parseInt($('.total_exentas').val());
        var gravadas_total=gravadas_10+gravadas_total_10+gravadas_5+gravadas_total_5+gravadas_exentas;
        $('.total_importe').val(gravadas_total);
    
}
function calcularImporteTotal(){
     
        var gravadas_10=Math.ceil(parseInt($('.total_importe').val())/1.1);
        var gravadas_total_10=Math.ceil(gravadas_10*10/100);

        $('.total_gravadas_total_10').val(gravadas_total_10);
        $('.total_gravadas_10').val(gravadas_10);
        var gravadas_5=parseInt($('.total_gravadas_5').val());
        var gravadas_total_5=parseInt($('.total_gravadas_total_5').val());
        var gravadas_exentas=parseInt($('.total_exentas').val());
       // var gravadas_total=gravadas_10+gravadas_total_10+gravadas_5+gravadas_total_5+gravadas_exentas;
       // $('.total_importe').val(gravadas_total);
    
}

 
/* $('.total_gravadas_10').change(function(){
    $('.total_gravadas_total_10').val(parseInt($('.total_gravadas_10').val())*10/100);
  // calcularImporteTotal();
}); */
$('.total_gravadas_5').change(function(){
    $('.total_gravadas_total_5').val(parseInt($('.total_gravadas_5').val())*5/100);
//  calcularImporteTotal();
});
$('.total_exentas').change(function(){
    
   calcularImporteTotal();
});


$('.total_gravadas_10').val(0);
$('.total_gravadas_5').val(0);
$('.total_gravadas_total_10').val(0);
$('.total_gravadas_total_5').val(0);
$('.total_exentas').val(0);
$('.total_importe').val(0);
$('.contado').click(function(){
    if($(this).prop("checked") == true){
          $('label[for=cuotas]').hide();
          $('.cuotas').hide();
    }
    else if($(this).prop("checked") == false){
                $('label[for=cuotas]').show();
          $('.cuotas').show();      
    }
});
$('.credito').click(function(){
    if($(this).prop("checked") == true){
          $('label[for=cuotas]').show();
          $('.cuotas').show();
    }
    else if($(this).prop("checked") == false){
                $('label[for=cuotas]').hide();
          $('.cuotas').hide();      
    }
});
$('.total_importe').change(function(){
   // $('.total_gravadas_total_10').val(parseInt($('.total_gravadas_10').val())*10/100);
   //alert('ss');
   calcularImporteTotal();
});
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>