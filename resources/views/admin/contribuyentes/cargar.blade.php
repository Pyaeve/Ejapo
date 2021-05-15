@extends('layouts.app')

@section('content')
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		{{ Breadcrumbs::render('admin_contribuyentes_cargar') }}
        </div>
    </div>
      <div class="row justify-content-center">
        <div class="col-md-12">
                @include('admin.empresas.membrete')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3><i class="fa fa-user"> </i> Cargar Contribuyente</h3></div>

                <div class="card-body">
                   

                    {!! BootForm::open()->action(route('admin.contribuyentes.guardar'))!!}
                   
                         {!! BootForm::hidden('empresa_id')->value($empresa) !!}
                        {!! BootForm::checkbox('Es Cliente','cliente')->addClass('es_cliente') !!}
                   
                         {!! BootForm::checkbox('Es Exportador','exportador') !!}
              
                    {!! BootForm::select('Tipo Contribuyente','tipo_contribuyente')->options(['1'=>'Fisico'])->addClass('tipo_contribuyente') !!}
                    {!! BootForm::select('Regimen Contribuyente','regimen')->options(['1'=>'IRP','2'=>'IVA'])->addClass('reg_tributario') !!}                             
                   
                    {!! BootForm::text('Denominacion, Nombre o Raz&oacute;n Social','desc')->addClass('desc') !!}
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
                    {!! BootForm::submit(' Cargar')->addClass('btn btn-primary fa fa-check') !!}
                     <a class="btn btn-default" href="{!! route('admin.contribuyentes.resumen') !!}"><i class="fa fa-return">  </i>Cancelar</a>
                    {!! BootForm::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('scripts')
   $('.timbrado_inicio').mask('9999-99-99');
     $('.timbrado_fin').mask('9999-99-99');
  $('.reg_tributario').hide();
$("label[for='regimen']").hide();
          
   
     $('.es_cliente').click(function(){
            if($(this).prop("checked") == true){
                  $('.reg_tributario').show();
     $("label[for='regimen']").show();
            }
            else if($(this).prop("checked") == false){
                 $('.reg_tributario').hide();
     $("label[for='regimen']").hide();
            }
        });


 
@endsection