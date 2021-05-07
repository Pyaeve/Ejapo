<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-4 col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-header"> <img height="42px" class="img-responsive" style="margin-top:20px;margin-left:20px; margin-bottom: 20px;"  src="<?php echo asset('images/logo.png'); ?>" align="center" /></div>

                <div class="card-body">
                  
                        <div class="col-md-12">
                           <h2 class="text-center"> <?php echo app('translator')->getFromJson('auth.login'); ?></h2> 
                        </div>
                       <div class="col-md-12">
                           <form method="POST" action="<?php echo e(route('login')); ?>" aria-label="<?php echo e(__('Login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-md-center"><?php echo app('translator')->getFromJson('auth.email'); ?></label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label text-md-center"><?php echo app('translator')->getFromJson('auth.password'); ?></label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                 <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo app('translator')->getFromJson('auth.forget-pass'); ?>
                                </a>
                                <div class="form-check text-center">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                    <label class="form-check-label" for="remember">
                                        <?php echo app('translator')->getFromJson('auth.rememberme'); ?>
                                    </label>
                                   
                                </div>
                               
                            </div>

                        </div>

                        <div class="form-group row ">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                   <?php echo app('translator')->getFromJson('auth.btn-login'); ?>
                                </button>
                                 
                               
                            </div>
                            
                        </div>
                    </form>
                       </div>
                    </div>
                     
                    
               
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>