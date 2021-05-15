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
                <div class="card-header"><h4> <?php echo strtoupper($contribuyente[0]->CONTRIBUYENTE); ?>  </h4></div>

                <div class="card-body" style="align-self: center">
                        <?php echo BootForm::open()->get(); ?>

                        <?php echo BootForm::hidden('empresa_id')->value($empresa); ?>   
                        <?php echo BootForm::hidden('cliente_id')->value($contribuyente[0]->ID); ?>   
                        <?php echo BootForm::select('A&ntilde;o','y')->options(['2020'=>'2020','2021'=>'2021'])->select($_GET['y']); ?>

                        <?php echo BootForm::select('Mes','m')->options(['01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre'])->select($_GET['m']); ?>

                        <?php echo BootForm::submit('Filtrar')->addClass('btn btn-primary'); ?>

                             <a class="btn btn-primary" href="<?php echo route('admin.iva.ventas.cargar',['id'=>$contribuyente[0]->ID]); ?>">Cargar Ventas</a>
                         <a class="btn btn-primary" href="<?php echo route('admin.iva.compras.cargar',['id'=>$contribuyente[0]->ID]); ?>">Cargar Compras</a>
                          <a class="btn btn-primary" href="<?php echo route('admin.iva.hechauka.exportar',['id'=>$contribuyente[0]->ID]); ?>">Exportar a Hechauka</a>
 
                       
                        <br> 
                          <br>       

                        
                    <table class="table table-responsive table-striped"> 
                        <thead>
                            <tr>
                               
                                <th>Ventas</th>
                                <th>Compras</th>
                                <th>Neto</th>
                                <th>IVA(10%)</th>
                           </tr>
                        </thead>
                               
                        <tbody> 
                             <tr align="right">  
                              
                                    <td>  <?php echo number_format($ventas_total, 0, ',', '.'); ?>  </td>
                                     <td>  <?php echo number_format($compras_total,0,',','.'); ?>  </td>
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
                <div class="card-header"><B>Ventas</B></div>

                <div class="card-body">
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                        
                                <th>Fecha</th>
                                <th>Nro Doc</th>
                                <th>Tipo Doc</th>
                
                                <th>Monto Total</th>
                                    
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $ventas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                        <td>
                                   <?php echo $node->fecha; ?>

                                </td>
                                <td>
                                    <?php echo $node->doc_nro; ?>

                                </td>
                                <td>
                                    <?php echo $node->doc_tipo; ?>

                                </td>
                              
                                <td>
                                    <?php echo number_format($node->total,0,',','.'); ?>

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
                <div class="card-header"><B>Compras</B></div>

                <div class="card-body">
                  <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                     
                                <th>Fecha</th>
                                <th>Nro Doc</th>
                                <th>Tipo Doc</th>
                                
                                <th>Monto Total</th>
                                    
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $compras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              
                                <td>
                                   <?php echo $node->fecha; ?>

                                </td>
                                <td>
                                    <?php echo $node->doc_nro; ?>

                                </td>
                                <td>
                                    <?php echo $node->doc_tipo; ?>

                                </td>
                               
                                <td>
                                    <?php echo number_format($node->total,0,',','.'); ?>

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



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>