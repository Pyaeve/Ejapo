@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-12">
                {{ Breadcrumbs::render('admin_contribuyentes_cargar') }}
        </div>
    </div>
     <div class="row justify-content-center">
        <div class="col-md-8">
               @include('admin.empresas.membrete')
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cargar Empresa</div>

                <div class="card-body">
                    {!! BootForm::open()->action(route('admin.empresas.guardar'))!!}
                    {!! BootForm::checkbox('Es Exportador','exportador') !!}
                    {!! BootForm::text('Descripcion','desc')->addClass('desc') !!}
                    {!! BootForm::select('Tipo Documento','tipo_doc')->options($tipo_doc_data) !!}
                    {!! BootForm::text('Documento Nro','nro_doc')->required() !!}
                    {!! BootForm::text('Ciudad','ciudad')->required() !!}
                    {!! BootForm::text('Barrio','barrio')->required() !!}
                    {!! BootForm::text('Direccion','direccion')->required() !!}
                    {!! BootForm::text('Tel','tel')->required() !!}
                    {!! BootForm::email('Correo','email')->required() !!}
                    {!! BootForm::text('Timbrado Nro','timbrado_codigo')->required() !!}
                    {!! BootForm::date('Timbrado Inicio','timbrado_inicio')->required()->addClass('timbrado_inicio')->placeholder('asdasd') !!}
                    {!! BootForm::date('Timbrado Fin','timbrado_fin')->required()->addClass('timbrado_fin') !!}
                    {!! BootForm::submit('Cargar')->addClass('btn btn-primary') !!}
                     <a class="btn btn-default" href="{!! route('admin.contribuyentes.resumen') !!}">Cancelar</a>
                    {!! BootForm::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
   

 
@endsection