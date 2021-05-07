 
 <div class="card">
 	<div class="card-body">
 		<div class="container">	
 			<div class="col-md-12">
				<?php 
		$user =Auth::user()->id;
		$emp=DB::select("CALL PRO_VER_EMPRESA('".$user."');");
		$emp=$emp[0];
	?>
		<h2><?php echo $emp->EMPRESA; ?>	</h2>
		<?php if(Request::is('admin/perfil')): ?>
				<a href="#" class="btn btn-primary "><i class="fa fa-pencil"></i> Editar</a>
		<?php endif; ?>
 	</div>
 				</div>
 		</div>
 	
 </div>
 <br>	