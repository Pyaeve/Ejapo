<?php $__env->startSection('content'); ?>
<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-12">
                <?php echo e(Breadcrumbs::render('admin_irp_egresos_cargar')); ?>

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
                <div class="card-header">Cargar Egresos para <b><?php echo $cliente[0]->NRODOC; ?> | <?php echo $cliente[0]->CONTRIBUYENTE; ?></b></div>

                <div class="card-body">
                     <?php echo BootForm::open()->action(route('admin.irp.egresos.guardar')); ?>

                            <?php echo BootForm::hidden('cliente_id')->value($cliente[0]->ID); ?> 
                            <?php echo BootForm::hidden('empresa_id')->value($empresa); ?>

                            <?php echo BootForm::hidden('cliente_ruc')->value($cliente[0]->NRODOC); ?> 
                    <div class="container">
                        <div class="row">
                          
                           <div class="col-md-6">
                             
                              <?php echo BootForm::select('Contribuyente','contribuyente')->options($contribuyentes)->addClass('contribuyente'); ?> 
                              <?php echo BootForm::select('Tipo Egreso','tipoEgreso')->options($tipo_egreso)->addClass('tipoEgreso'); ?> 
                               <?php echo BootForm::select('Subtipo Egreso','subtipoEgreso')->options($subtipo_egreso)->addClass('subtipoEgreso'); ?> 
                             
                                <?php echo BootForm::text('Total Egreso Neto','egresoTotal')->addClass('egresoTotal'); ?>

                           </div>
                           <div class="col-md-6">
                              <?php echo BootForm::select('Tipo Documento','tipo')->options($tipo_doc)->addClass('tipo_doc')->addClass('tipo_doc'); ?>   
                             
                              <?php echo BootForm::date('Fecha','fecha'); ?>

                              <?php echo BootForm::label('Condicion'); ?><br>  
                              <?php echo BootForm::inlineRadio('Contado','condicion'); ?>

                              <?php echo BootForm::inlineRadio('Credito','condicion'); ?><br><br>
                              <?php echo BootForm::text('Documento Nro','doc_nro')->addClass('doc_nro'); ?>

                              <?php echo BootForm::text('Timbrado','timbrado'); ?>

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

const et = document.querySelector('.egresoTotal');

function formatNumber (n) {
    n = String(n).replace(/\D/g, "");
  return n === '' ? n : Number(n).toLocaleString('es-PY',{'maximumFractionDigits':2});
}
et.addEventListener('keyup', (e) => {
    const element = e.target;
    const value = element.value;
  element.value = formatNumber(value);
});

 
    $('.doc_nro').mask("999-999-9999999");
    $('.tipoEgreso').change(function(e){
        let v =  $('.tipoEgreso').val();
        let dd = $('.subtipoEgreso');dd.empty();
        let url='<?php echo env('APP_URL'); ?>/admin/irp/egresos/ajax/subtipo/'+v;
        $.ajax({
            url: url,
            success: function(r) {
                $.each(r, function (k, j) {
                    dd.append($('<option></option>').attr('value', j.codigo).text(j.desc));
                });
             },
            error: function() {
                alert("No se ha podido obtener la información");
            }
        });
    });
     $('.contribuyente').select2({
    theme: "bootstrap"
});
     $('.tipoEgreso').select2({
    theme: "bootstrap"
});
     $('.subtipoEgreso').select2({
    theme: "bootstrap"
});
     $('.tipo_doc').select2({
    theme: "bootstrap"
});
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>