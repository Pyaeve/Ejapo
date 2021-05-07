@extends('layouts.app')
 <?php 
                date_default_timezone_set("America/Asuncion");
setlocale(LC_TIME, 'es_PY.UTF-8');
              ?>
@section('content')
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12"><br>
            <i class="float-right">{!! date('l d, F \d\e\l Y')!!}</i>
        		{{ Breadcrumbs::render('home') }}

                
        </div>
    </divY
      <div class="row justify-content-center">
        <div class="col-md-12">
                @include('admin.empresas.membrete')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><h4><i class="fa fa-users"></i> Clientes</h4></div>

                <div class="card-body">
                    <h5><b><span class="count">{!! $total_clientes !!}</span></b> en Total</h5>
                    <h5><b><span class="count">{!! $total_clientes_fisicos !!}</span></b> son Fisicos </h5> 
                    <h5><b><span class="count">{!! $total_clientes_juridicos !!}</span></b> son Juridicos</h5> 
                    <a href="{!!  route('admin.contribuyentes.cargar')!!}" class="btn btn-success"><i class="fa fa-plus"></i> Cargar</a>
                    <a href="{!!  route('admin.contribuyentes.resumen')!!}" class="btn btn-success"><i class="fa fa-list"></i> Resumen</a>
                      <a href="{!!  route('admin.contribuyentes.importar')!!}" class="btn btn-success"><i class="fa fa-cloud-upload"></i> Importar</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Contribuyentes</div>

                <div class="card-body">
                   <span class="count">1250</span>  en Total
                    <a href="{!!  route('admin.contribuyentes.cargar')!!}" class="btn btn-success">Cargar</a>
                     <a href="{!!  route('admin.contribuyentes.resumen')!!}" class="btn btn-success">Resumen</a>
                </div>
            </div>
        </div>
         <div class="col-md-4">
            <div class="card">
                <div class="card-header">IRP</div>

                <div class="card-body">
                   <a href="{!!  route('admin.irp.ingresos.clientes')!!}" class="btn btn-success">Cargar Ingresos</a>
                    <a href="{!!  route('admin.irp.egresos.clientes')!!}" class="btn btn-success">Cargar Egresos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
@endsection
