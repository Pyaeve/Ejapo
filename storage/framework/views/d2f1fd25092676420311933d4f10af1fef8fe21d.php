<?php $__env->startSection('content'); ?>
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		<?php echo e(Breadcrumbs::render('home')); ?>

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
                <div class="card-header">Resumen de Empresas</div>

                <div class="card-body">
                   <table class="table table-responsive table-striped table-hover">  
                        <thead> 
                            <tr> 
                                <th></th>
                                <th>#</th>
                                <th>Empresa</th> 
                                <th>Tipo Doc</th>
                                <th>Nro Doc</th>
                                <th>Direcci&oacute;n</th>
                                <th>Ciudad</th>
                                <th>Tel/Cel</th>
                                <th>Email</th>
                                <th>Timbrado Nro</th>
                                <th>Timbrado Inicio</th>
                                <th>Timbrado Vence</th>

                            </tr>
                           
                        </thead>
                            
                        <tbody> 
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr> 
                                <td>
                                    <a href="#" class="btn btn-primary">Editar</a>
                                    <a href="#" class="btn btn-danger">Borrar</a>
                              </td>
                                <td><?php echo $node->ID; ?></td>   
                                <td><?php echo $node->EMPRESA; ?></td>   
                                <td><?php echo $node->TIPODOC; ?></td> 
                                <td><?php echo $node->NRODOC; ?></td> 
                                <td><?php echo $node->DIRECCION; ?></td> 
                                <td><?php echo $node->CIUDAD; ?></td>  
                                <td><?php echo $node->TEL; ?></td>  
                                <td><?php echo $node->EMAIL; ?></td>  
                                <td><?php echo $node->TIMBRADO_NRO; ?></td>
                                <td><?php echo $node->TIMBRADO_INICIO; ?></td>  
                                <td><?php echo $node->TIMBRADO_FIN; ?></td>    
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                   </table>
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