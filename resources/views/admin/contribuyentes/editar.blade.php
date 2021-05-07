@extends('layouts.app')

@section('content')
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		{{ Breadcrumbs::render('admin_contribuyentes_editar') }}
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
                <div class="card-header">Editar Contribuyente</div>

                <div class="card-body">
                    

                    {!! BootForm::open()->action(route('admin.contribuyentes.actualizar'))!!}
                     {!! BootForm::hidden('id',$data['id']) !!}
                   <div class="container">
                        <div class="row">
                            <div class="col-md-6" id="izq">
                              

                    {!! BootForm::text('Descripcion','desc')->value($data['desc'])->addClass('desc') !!}
                   
                    {!! BootForm::text('Ciudad','ciudad')->value($data['ciudad']) !!}
                    {!! BootForm::text('Barrio','barrio')->value($data['barrio']) !!}
                    {!! BootForm::text('Direccion','direccion')->value($data['direccion']) !!}
                    {!! BootForm::text('Tel','tel')->value($data['cel'])  !!}
                    {!! BootForm::email('Correo','email')->value($data['email'])  !!}
                            </div>
                            <div class="col-md-6" id="der">
                               {!! BootForm::select('Tipo Documento','tipo_doc')->options($tipo_doc_data)->select($data['tipo_doc_id']) !!}
                    {!! BootForm::text('Documento Nro','nro_doc')->value($data['tipo_doc_id_codigo']) !!}
                                @if($data['cliente']=='1')

                             {!! BootForm::checkbox('Es Cliente','cliente')->value($data['cliente'])->checked()->inline()!!}
                        @else
                             {!! BootForm::checkbox('Es Cliente','cliente')->inline() !!}
                        @endif

                       
                  
                         @if($data['exportador']=='1')
                         {!! BootForm::checkbox('Es Exportador','exportador')->value($data['exportador'])->checked()->inline() !!}
                         @else
                        {!! BootForm::checkbox('Es Exportador','exportador')->value($data['exportador'])->inline() !!}
                         @endif
                    @if($data['cliente']=='1')
                      {!! BootForm::select('Obligacion Tributaria','regimen')->options($regimen)->select($data['regimen']) !!}
                         
                          @endif
                    {!! BootForm::select('Tipo Contribuyente','tipo_contribuyente')->options(['1'=>'Fisico','2'=>'Jurico'])->addClass('tipo_contribuyente')->select($data['tipo']) !!}                        
                   {!! BootForm::text('Timbrado Nro','timbrado_codigo')->value($data['timbrado_codigo']) !!}
                    {!! BootForm::date('Timbrado Inicio','timbrado_inicio')->value($data['timbrado_inicio'])->addClass('timbrado_inicio')  !!}
                    {!! BootForm::date('Timbrado Fin','timbrado_fin')->value($data['timbrado_fin'])->addClass('timbrado_fin')  !!}
                            </div>
                      
                  
                  
                   
                    {!! BootForm::submit('Actualizar')->addClass('btn btn-primary') !!}
                 
                  </div>
                </div>
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
 
   
  
@endsection