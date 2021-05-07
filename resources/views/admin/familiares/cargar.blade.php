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
                <div class="card-header">Cargar Contribuyente</div>

                <div class="card-body">
                   

                    {!! BootForm::open()->action(route('admin.familiares.guardar'))!!}
                {!! BootForm::hidden('empresa_id')->value($empresa) !!}
                 {!! BootForm::hidden('cliente_id')->value($contribuyente[0]->ID) !!}
                 {!! BootForm::hidden('cliente_ruc')->value($contribuyente[0]->NRODOC) !!}
                 {!! BootForm::select('Periodo','periodo')->options(['2020'=>'2020','2021'=>'2021','2022'=>'2022','2023'=>'2023','2024'=>'2024','2025'=>'2025'])->addClass('periodo') !!}  
                    {!! BootForm::select('Tipo Vinculo','vinculo')->options($vinculos)->addClass('vinculo') !!}                        
                     {!! BootForm::select('Regimen Matrimonial','regimen')->options($regimenes)->addClass('regimen') !!}                        
                  
                    {!! BootForm::text('Nombre','nombre')->addClass('nombre') !!}
                    {!! BootForm::text('Identificacion','identificacion')->addClass('identificacion') !!}
                    {!! BootForm::date('Fecha Nac','fecha_nac')->addClass('desc') !!}
                   
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
  
    $('.regimen').hide();
    $("label[for='regimen']").hide();
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