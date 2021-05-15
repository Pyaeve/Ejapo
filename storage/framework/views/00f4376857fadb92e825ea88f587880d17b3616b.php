<?php $__env->startSection('content'); ?>
<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-12">
                <?php echo e(Breadcrumbs::render('admin_contribuyentes_resumen')); ?>

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Familiales de <b><?php echo $cliente[0]->CONTRIBUYENTE; ?></b></div>

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
                                    Nombre
                                </th>
                                <TH>
                                    Identificacion
                                </TH>
                                <th>
                                    Vinculo
                                </th>
                                 <th>
                                    Regimen
                                </th>
                                <th>
                                    Fecha Nac
                                </th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $familiares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td>
                                        <a href="<?php echo route('admin.familiares.editar',['id'=>$node->id]); ?>" class="btn btn-primary  ">Editar</a>         
                                        <a href="@#" class="btn btn-danger ">Borrar</a>          
                                    </td> 
                                    </td>
                                    <td>
                                        <?php echo $node->id; ?>

                                    </td>
                                   
                                   <td>
                                        <?php echo $node->nombre; ?>

                                    </td>
                                       <td>
                                        <?php echo $node->identificacion; ?>

                                    </td>
                                
                                   <td>
                                        <?php echo $node->vinculo_texto; ?>

                                    </td>
                                     <td>
                                        <?php echo $node->regimen_texto; ?>

                                    </td>
                                   <td>
                                        <?php echo $node->fecha; ?>

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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

     $('.table').DataTable( {
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    } );
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>