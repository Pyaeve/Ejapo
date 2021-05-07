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
          <div class="col-md-12" style="margin-bottom:25px">               
            <div class="card">
                <div class="card-header"><h4><i class="fa fa-user"></i><b> <?php echo strtoupper($contribuyente[0]->NRODOC); ?> | <?php echo strtoupper($contribuyente[0]->CONTRIBUYENTE); ?>   </b>  </h4></div>

                <div class="card-body" style="align-self: center">
                        <?php echo BootForm::open()->get(); ?>

                               
                        <?php echo BootForm::select('Periodo','p')->options(['2020'=>'2020']); ?>

                         
                          <?php echo BootForm::submit('Filtrar')->addClass('btn btn-primary'); ?>


                             <a class="btn btn-primary" href="<?php echo route('admin.irp.ingresos.cargar',['id'=>$contribuyente[0]->ID]); ?>"><i class="fa fa-plus"></i> Cargar Ingresos</a>
                         <a class="btn btn-primary" href="<?php echo route('admin.irp.egresos.cargar',['id'=>$contribuyente[0]->ID]); ?>"><i class="fa fa-plus"></i> Cargar Egresos</a>
                            <a class="btn btn-primary aranduka" href="<?php echo route('admin.irp.aranduka.exportar',['ci'=>$contribuyente[0]->ID,'pe'=>$_GET['p']]); ?>"><i class="fa fa-cloud-download">  </i> Exportar a Aranduka</a>
                        <?php echo BootForm::close(); ?>

                       
                        <br>       

                        
                    <table class="table table-responsive table-striped"> 
                        <thead>
                            <tr>
                               
                                <th>Ingresos</th>
                                <th>Egresos</th>
                                <th>Total Residuo</th>
                                <th>Liquicacion del IRP(8%)</th>
                           </tr>
                        </thead>
                               
                        <tbody> 
                             <tr align="right">  
                              
                                    <td>  <?php echo number_format($ingresos_total, 0, ',', '.'); ?>  </td>
                                     <td>  <?php echo number_format($egresos_total,0,',','.'); ?>  </td>
                                     <td>   <?php echo number_format($total,0,',','.'); ?></td>
                                     <td>   <?php echo number_format($impuesto,0,',','.'); ?></td>
                                </tr>
                        </tbody>
                    </table>
                  
                    
                </div>    
            </div>
          </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><B><i class="fa fa-plus">    </i> Ingresos</B></div>

                <div class="card-body">
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                        <TH>    </TH>
                                <th>Fecha</th>
                                <th>Nro Doc</th>
                                <th>Tipo Doc</th>
                                <th>Tipo Ingreso</th>
                                <th>Monto Total</th>
                                    
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $ingresos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <td>
                                   <a class="btn btn-primary" href="<?php echo route('admin.irp.ingresos.editar',['id'=>$node->id]); ?>"><i class="fa fa-pencil">    </i> Editar</a>
                                   <a class="btn btn-danger" href="<?php echo route('admin.irp.ingresos.borrar',['id'=>$node->id]); ?>"><i class="fa fa-trash"></i> Borrar</a>
                                </td>                                <td>
                                   <?php echo $node->fecha; ?>

                                </td>
                                <td>
                                    <?php echo $node->nro_doc; ?>

                                </td>
                                <td>
                                    <?php echo $node->tipo_doc; ?>

                                </td>
                                <td>
                                   <?php echo $node->tipo_ingreso; ?>

                                </td>
                                <td>
                                    <?php echo number_format($node->ingreso_total,0,',','.'); ?>

                                </td>
                             
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><B><i class="fa fa-minus">    </i> Egresos</B></div>

                <div class="card-body">
                  <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                        <TH>    </TH>
                                <th>Fecha</th>
                                <th>Nro Doc</th>
                                <th>Tipo Doc</th>
                                <th>Tipo Egreso</th>
                                <th>Monto Total</th>
                                    
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $egresos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                 <td>
                                   <a class="btn btn-primary" href="#">Editar</a>
                                   <a class="btn btn-danger" href="#">Borrar</a>
                                </td>      
                                <td>
                                   <?php echo $node->fecha; ?>

                                </td>
                                <td>
                                    <?php echo $node->nro_doc; ?>

                                </td>
                                <td>
                                    <?php echo $node->tipo_doc; ?>

                                </td>
                                <td>
                                   <?php echo $node->tipo_egreso; ?>

                                </td>
                                <td>
                                    <?php echo number_format($node->egreso_total,0,',','.'); ?>

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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

$('.aranduka').click(function(){
    $.ajax({
    url: '<?php echo route('admin.irp.aranduka.exportar',['ci'=>$contribuyente[0]->ID,'pe'=>$_GET['p']]); ?>',
     type: "GET",
      dataType: 'binary'
        

});


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>