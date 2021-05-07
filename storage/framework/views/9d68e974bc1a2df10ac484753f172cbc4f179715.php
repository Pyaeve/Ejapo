<?php $__env->startSection('content'); ?>
<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-12">
                <?php echo e(Breadcrumbs::render('admin_irp_egresos_clientes')); ?>

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Selecione un cliente</div>

                <div class="card-body ">
                   
             

                    <table class="table table-striped table-hover table-condensed table-responsive">
                        <thead>
                            <tr>
                                <TH>
                                    
                                </TH>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Contribuyente
                                </th>
                                <TH>
                                    Tipo
                                </TH>
                                <th>Regimen</th>
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
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($node->REGIMEN=='IRP'): ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo route('admin.irp.egresos.cargar',['id'=>$node->ID]); ?>" class="btn btn-primary  ">Seleccionar</a>          
                                    </td>
                                    <td>
                                        <?php echo $node->ID; ?>

                                    </td>
                                   <td>
                                        <?php echo $node->CONTRIBUYENTE; ?>

                                    </td>
                                   <td>
                                        <?php echo $node->TIPO; ?>

                                    </td>
                                    <td><?php echo $node->REGIMEN; ?></td>
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
                                <?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

     $('.table').DataTable( {
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    } );
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>