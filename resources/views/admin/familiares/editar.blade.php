

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
                <div class="card-header">Editar Familiar de <b>{!! $contribuyente[0]->CONTRIBUYENTE !!}</b></div>

                <div class="card-body">
                   

                    {!! BootForm::open()->action(route('admin.familiares.actualizar'))!!}
                {!! BootForm::hidden('empresa_id')->value($empresa) !!}
                 {!! BootForm::hidden('cliente_id')->value($contribuyente[0]->ID) !!}
                 {!! BootForm::hidden('cliente_ruc')->value($contribuyente[0]->NRODOC) !!}
                 {!! BootForm::select('Periodo','periodo')->options(['2020'=>'2020','2021'=>'2021','2022'=>'2022','2023'=>'2023','2024'=>'2024','2025'=>'2025'])->addClass('periodo')->select($familiar['periodo']) !!}  
                    {!! BootForm::select('Tipo Vinculo','vinculo')->options($vinculos)->addClass('vinculo')->select($familiar['vinculo'])!!}                        
                     {!! BootForm::select('Regimen Matrimonial','regimen')->options($regimenes)->addClass('regimen') !!}                        
                  
                    {!! BootForm::text('Nombre','nombre')->addClass('nombre')->value($familiar['nombre']) !!}
                    {!! BootForm::text('Identificacion','identificacion')->addClass('identificacion')->value($familiar['identificacion'])  !!}
                    {!! BootForm::date('Fecha Nac','fecha_nac')->addClass('desc')->value($familiar['fecha_nacimiento'])  !!}
                   
                    {!! BootForm::submit('Actualizar')->addClass('btn btn-primary') !!}
                     <a class="btn btn-default" href="{!! route('admin.contribuyentes.resumen') !!}">Cancelar</a>
                    {!! BootForm::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
  	
  	@if($familiar['vinculo']=='1')
  		  $('.regimen').show();
    $("label[for='regimen']").show();
  	@else
  	  $('.regimen').hide();
    $("label[for='regimen']").hide();
  	@endif
  
    $('.vinculo').change(function(e){
        var $this =  $('.vinculo').val();
        if($this==1){
            $('.regimen').show();
            $("label[for='regimen']").show();
        }else {
            $('.regimen').hide();
             $("label[for='regimen']").hide();
        }
    });

 
@endsection