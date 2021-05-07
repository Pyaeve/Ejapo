@extends('layouts.app')

@section('content')
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		{{ Breadcrumbs::render('admin_irp_ingresos_cargar') }}
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
                <div class="card-header">Editar Ingresos para <b>{!!$cliente[0]->NRODOC !!} | {!!$cliente[0]->CONTRIBUYENTE !!}</b></div>

                <div class="card-body">
                     {!! BootForm::open()->action(route('admin.irp.ingresos.guardar')) !!}
                            {!! BootForm::hidden('cliente_id')->value($data['cliente_id']) !!} 
                            {!! BootForm::hidden('empresa_id')->value($data['empresa_id']) !!}
                            
                    <div class="container">
                        <div class="row">
                          
                           <div class="col-md-6">
                             
                              {!! BootForm::select('Contribuyente','contribuyente')->options($contribuyentes)->addClass('contribuyente') !!} 
                              {!! BootForm::select('Tipo Ingreso','tipoIngreso')->options($tipo_ingreso)->select($data['tipo_ingreso'])->addClass('tipoIngreso') !!} 
                            
                              {!! BootForm::text('Total Ingreso No Gravado','ingresoNoGravado')->value($data['ingreso_monto_nogravado'])->addClass('ingresoNoGravado') !!}
                              {!! BootForm::text('Total Ingreso Gravado','ingresoGravado')->value($data['ingreso_monto_gravado'])->addClass('ingresoGravado') !!}
                              {!! BootForm::text('Total Ingreso Neto','ingresoTotal')->value($data['ingreso_monto_total'])->addClass('ingresoTotal') !!}
                           </div>
                        
                           <div class="col-md-6">
                              {!! BootForm::select('Tipo Documento','tipo')->options($tipo_doc)->select($data['tipo'])->addClass('tipo_doc') !!}   
                            
                              {!! BootForm::date('Fecha','fecha')->value($data['fecha']) !!}
                              {!! BootForm::label('Condicion')->addClass('condicion') !!}<br>  
                              {!! BootForm::inlineRadio('Contado','condicion')->addClass('contado')  !!}
                              {!! BootForm::inlineRadio('Credito','condicion')->addClass('credito')  !!}<br><br>
                              {!! BootForm::text('Documento Nro','doc_nro')->value($data['timbrado_documento'])->addClass('doc_nro') !!}
                              {!! BootForm::text('Timbrado','timbrado')->value($data['timbrado_documento'])->addClass('timbrado_nro') !!}
                           </div>
                          
                           
                           {!! BootForm::submit('Cargar')->addClass('btn btn-primary') !!}
                            
                             
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

   
  

      $('.contribuyente').change(function(e){
        var v =  $('.contribuyente').val();
       
        var url1='{!! env('APP_URL') !!}/admin/contribuyentes/ajax/ruc/'+v;
        $.ajax({
            url: url1,
            success: function(res) {
                
                $('.contribuyente_ruc').val(res);
             },
            error: function() {
                alert("No se ha podido obtener la información");
            }
        });
        var url2='{!! env('APP_URL') !!}/admin/contribuyentes/ajax/timbrado/'+v;
        $.ajax({
            url: url2,
            success: function(res) {
                
                $('.timbrado_nro').val(res);
             },
            error: function() {
                alert("No se ha podido obtener la información");
            }
        });
    });
    $('.contribuyente').select2({
    theme: "bootstrap"
});
     $('.tipoIngreso').select2({
    theme: "bootstrap"
});
     $('.tipo_doc').select2({
    theme: "bootstrap"
});

var importe =0;
var total=0;
var subtotal=0;



$('.ingresoGravado').change(function(){
  
   importe=parseInt($('#ingresoGravado').val());
   subtotal=parseInt($('#ingresoNoGravado').val());
  
   total=(subtotal+ importe);
   $('#ingresoTotal').val(total);

});
$('.ingresoNoGravado').change(function(){
  
   importe=parseInt($('#ingresoGravado').val());
   subtotal=parseInt($('#ingresoNoGravado').val());
  
   total=(subtotal+ importe);
   $('#ingresoTotal').val(total);

});


$('.doc_nro').mask("999-999-9999999");
@endsection
