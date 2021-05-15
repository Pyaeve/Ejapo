<?php $__env->startSection('content'); ?>
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		<?php echo e(Breadcrumbs::render('home')); ?>

        </div>
        <div class="col-md-8">
                <?php echo $__env->make('admin.empresas.membrete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                <?php if(auth()->check() && auth()->user()->hasRole('Developer')): ?>
                    Cargar Usuario
                   <?php elseif(auth()->check() && auth()->user()->hasRole('Contador')): ?>
                    Cargar Colaborador
                <?php endif; ?>
            </div>

                <div class="card-body">
                    <?php echo BootForm::open()->action(route('admin.usuarios.guardar')); ?>

                   
                    <?php if(auth()->check() && auth()->user()->hasRole('Developer')): ?>
                     <?php echo BootForm::select('Role','role')->options($roles)->addClass('rol'); ?>  
                        <?php 
                            $empresas = DB::select("SELECT * FROM empresas");
                            $empresas_data=[];
                             foreach ($empresas as $node) {
                                    # code...
                                 $empresas_data[$node->id]=$node->desc;
                                }   
                        ?>
                        <?php echo BootForm::select('Empresa','empresa_id')->options($empresas_data)->addClass('empresas'); ?>  
                    <?php elseif(auth()->check() && auth()->user()->hasRole('Admin')): ?>
                     <?php echo BootForm::select('Role','role')->options($roles)->addClass('rol'); ?>  
                     <?php 
                            $empresas = DB::select("SELECT * FROM empresas");
                            $empresas_data=[];
                             foreach ($empresas as $node) {
                                    # code...
                                 $empresas_data[$node->id]=$node->desc;
                                }   
                        ?>
                        <?php echo BootForm::select('Empresa','empresa_id')->options($empresas_data)->addClass('empresas'); ?>  
                    <?php elseif(auth()->check() && auth()->user()->hasRole('Contador')): ?>
                     <?php echo BootForm::hidden('role')->value('Colaborador'); ?>  
                     <?php 
                            $empresas = DB::select("SELECT * FROM empresas");
                            $empresas_data=[];
                             foreach ($empresas as $node) {
                                    # code...
                                 $empresas_data[$node->id]=$node->desc;
                                }   
                        ?>
                      <?php echo BootForm::hidden('empresa_id')->value($empresa); ?>

                
                     
                    <?php endif; ?>
                    
                    <?php echo BootForm::text('Nombre','name')->required(); ?>

                    <?php echo BootForm::text('Apellido','sername')->required(); ?>

                    <?php echo BootForm::text('Email','email')->required(); ?>

                    <?php echo BootForm::password('Contrase&ntilde;a','password'); ?>

                    <?php echo BootForm::password('Confirm','password_confirmation')->id('password-confirm'); ?>

                    <?php echo BootForm::submit('Cargar')->addClass('btn btn-primary'); ?>

                    <?php echo BootForm::close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>