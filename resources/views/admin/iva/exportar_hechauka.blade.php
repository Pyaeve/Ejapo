@extends('layouts.app')

@section('content')
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		{{ Breadcrumbs::render('home') }}
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Exportar Hechauka</div>

                <div class="card-body">
                    {!! BootForm::open()->action(route('admin.iva.hechauka.exportar_procesar')) !!}
                    {!! BootForm::hidden('empresa_id')->value($empresa) !!}   
                    {!! BootForm::hidden('cliente_id')->value($cliente[0]->ID) !!}   
                    {!! BootForm::select('A&ntilde;o','y')->options(['2020'=>'2020']) !!}
                    {!! BootForm::select('Mes','m')->options(['01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre']) !!}
                    {!! BootForm::select('Libro','libro')->options(['Ventas'=>'Ventas','Compras'=>'Compras']) !!}
                    {!! BootForm::select('Declaraci&oacute;n','ddjj')->options(['Original'=>'Original','Rectificacion'=>'Rectificacion']) !!}
                    {!! BootForm::submit('Exportar a Hechauka')->addClass('btn btn-primary') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
