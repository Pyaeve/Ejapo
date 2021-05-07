@extends('layouts.app')

@section('content')
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		{{ Breadcrumbs::render('home') }}
        </div>
        <div class="col-md-8">
                @include('admin.empresas.membrete')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                @role('Developer')
                    Cargar Usuario
                   @elserole('Contador')
                    Cargar Colaborador
                @endrole
            </div>

                <div class="card-body">
                    {!! BootForm::open()->action(route('admin.usuarios.guardar')) !!}
                   
                    @role('Developer')
                     {!! BootForm::select('Role','role')->options($roles)->addClass('rol') !!}  
                        <?php 
                            $empresas = DB::select("SELECT * FROM empresas");
                            $empresas_data=[];
                             foreach ($empresas as $node) {
                                    # code...
                                 $empresas_data[$node->id]=$node->desc;
                                }   
                        ?>
                        {!! BootForm::select('Empresa','empresa_id')->options($empresas_data)->addClass('empresas') !!}  
                    @elserole('Admin')
                     {!! BootForm::select('Role','role')->options($roles)->addClass('rol') !!}  
                     <?php 
                            $empresas = DB::select("SELECT * FROM empresas");
                            $empresas_data=[];
                             foreach ($empresas as $node) {
                                    # code...
                                 $empresas_data[$node->id]=$node->desc;
                                }   
                        ?>
                        {!! BootForm::select('Empresa','empresa_id')->options($empresas_data)->addClass('empresas') !!}  
                    @elserole('Contador')
                     {!! BootForm::hidden('role')->value('Colaborador') !!}  
                     <?php 
                            $empresas = DB::select("SELECT * FROM empresas");
                            $empresas_data=[];
                             foreach ($empresas as $node) {
                                    # code...
                                 $empresas_data[$node->id]=$node->desc;
                                }   
                        ?>
                      {!! BootForm::hidden('empresa_id')->value($empresa) !!}
                
                     
                    @endrole
                    
                    {!! BootForm::text('Nombre','name')->required() !!}
                    {!! BootForm::text('Apellido','sername')->required() !!}
                    {!! BootForm::text('Email','email')->required() !!}
                    {!! BootForm::password('Contrase&ntilde;a','password') !!}
                    {!! BootForm::password('Confirm','password_confirmation')->id('password-confirm') !!}
                    {!! BootForm::submit('Cargar')->addClass('btn btn-primary') !!}
                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
