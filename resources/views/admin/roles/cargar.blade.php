@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-8">
                {{ Breadcrumbs::render('home') }}
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cargar Rol</div>

                <div class="card-body">
                   {!! BootForm::open()->action(route('admin.roles.guardar')) !!}
                   {!! BootForm::text('Nombre del Role','name') !!}
                   {!! BootForm::submit('Guardar')->addClass('btn btn-success') !!}
                   <a href="{!! route('admin.roles.resumen') !!}" class="btn btn-primary">Cancelar</a>
                   {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
