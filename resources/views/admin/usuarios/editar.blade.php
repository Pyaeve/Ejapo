@extends('layouts.app')

@section('content')
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		{{ Breadcrumbs::render('home') }}
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
                @endrole</div>

                <div class="card-body">
                    {!! BootForm::open()->action(route('admin.usuarios.actualizar')) !!}
                    {!! BootForm::hidden('id')->value($data['id']) !!}
                   @role('Developer')
                    {!! BootForm::select('Role','role')->options($roles)->addClass('rol')->select($rol['name']) !!}  
                   @elserole('Contador')
                   {!! BootForm::hidden('role')->value('Colaborador') !!}  
                @endrole
                   
                    {!! BootForm::text('Nombre','name')->value($data['name']) !!}
                    {!! BootForm::email('Email','email')->value($data['email']) !!}   
                    {!! BootForm::submit('Actualizar')->addClass('btn btn-primary') !!}
                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
