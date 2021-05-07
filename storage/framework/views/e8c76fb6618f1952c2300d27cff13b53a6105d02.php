<?php $__env->startSection('content'); ?>
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		<?php echo e(Breadcrumbs::render('admin_contribuyentes_resumen')); ?>

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
                <div class="card-header"><h3><i class="fa fa-users">    </i> Resumen de Contribuyentes <span class="float-right"><a href="<?php echo route('admin.contribuyentes.cargar'); ?>" class="btn btn-success"><i class="fa fa-plus">  </i> Cargar Contribuyente</a></span>   </h3> </div>

                <div class="card-body ">
                   
                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                        <li class='nav-item'><a href="#cf" class="nav-link active" role="tab" data-toggle="tab">Fisicos</a></li>
                        <li class='nav-item'><a href="#cj" class="nav-link" role="tab" data-toggle="tab">Juridicos</a></li>
      
                    </ul>     
                <div id="my-tab-content" class="tab-content">
                    <div class="tab-pane  active" id="cf">
                     
                        <br/>

                    <table class="table table-striped table-hover table-condensed table-responsive">
                        <thead>
                            <tr>
                                <TH>
                                    *
                                </TH>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Contribuyente
                                </th>
                                <TH>
                                    Cliente
                                </TH>
                                <th>
                                    Tipo Doc
                                </th>
                                <th>
                                    Nro Doc
                                </th>
                                <th>
                                    Direccion
                                </th>
                                <th>
                                    Ciudad
                                </th>
                                <th>
                                    Tel/Cel
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Timbrado Nro
                                </th>
                                <th>
                                    Timbrado Inicio
                                </th>
                                <th>
                                    Timbrado Fin
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td>
                                        <a href="<?php echo route('admin.contribuyentes.editar',['id'=>$node->ID]); ?>" class="btn btn-sm btn-default  "><i class="fa fa-pencil"> </i> Editar</a>
                                        
                                        <a href="#"  data-id="<?php echo $node->ID; ?>" class="btn-action-drop btn btn-sm btn-default  "><i class="fa fa-trash"> </i> Borrar</a>
                                            <?php if($node->CLIENTE=='Si'): ?>
                                             
                                               <?php if($node->REGIMEN=='IRP'): ?>
                                                <a href="<?php echo route('admin.familiares.ver',['id'=>$node->ID]); ?>" class="btn btn-sm btn-primary ">Ver Familiares</a>
                                                <a class="btn btn-primary" href="<?php echo route('admin.irp.ingresos.cargar',['id'=>$node->ID]); ?>">Cargar Ingresos</a> 
                                                <a class="btn btn-primary" href="<?php echo route('admin.irp.egresos.cargar',['id'=>$node->ID]); ?>">Cargar Egresos</a>
                                                <a class="btn btn-primary" href="<?php echo route('admin.contribuyentes.balance',['id'=>$node->ID,'p'=>'2020']); ?>">Ver Balance IRP</a>  
                                             <?php elseif($node->REGIMEN=='IVA'): ?>
                                                <a class="btn btn-primary" href="<?php echo route('admin.iva.ventas.cargar',['id'=>$node->ID]); ?>">Cargar Ventas</a> 
                                                <a class="btn btn-primary" href="<?php echo route('admin.iva.compras.cargar',['id'=>$node->ID]); ?>">Cargar Compras</a>
                                            <?php endif; ?>
                                            
                                            <?php endif; ?> 
                                           
                                
                                      
                                    </td>
                                    <td>
                                        <?php echo $node->ID; ?>

                                    </td>
                                   <td>
                                        <?php echo $node->CONTRIBUYENTE; ?>

                                    </td>
                                   <td>
                                        <?php echo $node->CLIENTE; ?>

                                    </td>
                                   <td>
                                        <?php echo $node->TIPODOC; ?>

                                    </td>
                                  
                                   <td>
                                        <?php echo $node->NRODOC; ?>

                                    </td>
                                  
                                   <td>
                                        <?php echo $node->DIRECCION; ?>

                                    </td>
                                  
                                   <td>
                                        <?php echo $node->CIUDAD; ?>

                                    </td>
                                  
                                   <td>
                                        <?php echo $node->TEL; ?>

                                    </td>
                                  
                                   <td>
                                        <?php echo $node->EMAIL; ?>

                                    </td>
                                   <td>
                                        <?php echo $node->TIMBRADO_NRO; ?>

                                    </td>
                                   <td>
                                        <?php echo $node->TIMBRADO_INICIO; ?>

                                    </td>
                                   <td>
                                        <?php echo $node->TIMBRADO_FIN; ?>

                                    </td>
                                
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    </div>
                    <div class="tab-pane " id="cj">
                        
                            <br>
                    <table class="table table-striped table-hover table-condensed table-responsive">
                        <thead>
                            <tr>
                                <th>
                                    *
                                </th>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Contribuyente
                                </th>
                                <TH>
                                    Cliente
                                </TH>
                                <th>
                                    Tipo Doc
                                </th>
                                <th>
                                    Nro Doc
                                </th>
                                <th>
                                    Direccion
                                </th>
                                <th>
                                    Ciudad
                                </th>
                                <th>
                                    Tel/Cel
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Timbrado Nro
                                </th>
                                <th>
                                    Timbrado Inicio
                                </th>
                                <th>
                                    Timbrado Fin
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td>
                                        <a href="<?php echo route('admin.contribuyentes.editar',['id'=>$node->ID]); ?>" class="btn btn-primary  ">Editar&nbsp;</a>
                                         <a href="<?php echo route('admin.contribuyentes.borrar',['id'=>$node->ID]); ?>" class="btn btn-primary" data-toggle="modal" data-target="#modal-confirm-drop">Borrar;</a>
                                            <?php if($node->CLIENTE=='Si' ): ?>
                                     <?php if($node->REGIMEN=='IRE' ): ?>
                                                <a class="btn btn-primary" href="<?php echo route('admin.irp.ingresos.cargar',['id'=>$node->ID]); ?>">Cargar Ingresos</a> 
                                                <a class="btn btn-primary" href="<?php echo route('admin.irp.egresos.cargar',['id'=>$node->ID]); ?>">Cargar Egresos</a>
                                                <a class="btn btn-primary" href="<?php echo route('admin.contribuyentes.balance',['id'=>$node->ID,'p'=>'2020']); ?>">Ver Balance</a>  
                                            <?php elseif($node->REGIMEN=='IVA'): ?>
                                                <a class="btn btn-primary" href="<?php echo route('admin.iva.ventas.cargar',['id'=>$node->ID]); ?>">Cargar Ventas</a> 
                                                <a class="btn btn-primary" href="<?php echo route('admin.iva.compras.cargar',['id'=>$node->ID]); ?>">Cargar Compras</a>
                                            <?php endif; ?>
                                             <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo $node->ID; ?>

                                    </td>
                                   <td>
                                        <?php echo $node->CONTRIBUYENTE; ?>

                                    </td>
                                    <td>
                                        <?php echo $node->CLIENTE; ?>

                                    </td>
                                  
                                   <td>
                                        <?php echo $node->TIPODOC; ?>

                                    </td>
                                  
                                   <td>
                                        <?php echo $node->NRODOC; ?>

                                    </td>
                                  
                                   <td>
                                        <?php echo $node->DIRECCION; ?>

                                    </td>
                                  
                                   <td>
                                        <?php echo $node->CIUDAD; ?>

                                    </td>
                                  
                                   <td>
                                        <?php echo $node->TEL; ?>

                                    </td>
                                  
                                   <td>
                                        <?php echo $node->EMAIL; ?>

                                    </td>
                                   <td>
                                        <?php echo $node->TIMBRADO_NRO; ?>

                                    </td>
                                   <td>
                                        <?php echo $node->TIMBRADO_INICIO; ?>

                                    </td>
                                   <td>
                                        <?php echo $node->TIMBRADO_FIN; ?>

                                    </td>
                                
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    </div>
       
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal-confirm-drop" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pyaeve.com</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Desea borrar este Contribuyente?</p>
        <input class="modal-data" type="hidden" name="cid" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-drop btn btn-primary">Borrar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

     $('.table').DataTable( {
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    } );


    $('.btn-drop').click(function(){
        

        var v= $("#modal-confirm-drop .modal-data").val();
        
                var url='<?php echo env('APP_URL'); ?>/admin/contribuyentes/ajax/borrar/'+v;
        $.ajax({
            url: url,
            success: function(res) {
                
               alert(res);
             },
            error: function() {
                alert("No se ha podido obtener la información");
            }
        });
       
    });

    $('.btn-action-drop').click(function(){

        var btn =$(this);
        $("#modal-confirm-drop .modal-data").val(btn.data('id'));
        $("#modal-confirm-drop").modal('show');
    });
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>