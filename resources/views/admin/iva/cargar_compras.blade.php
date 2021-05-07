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
                @include('admin.empresas.membrete')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header"><h4><i class="fa fa-plus">  </i> Cargar Compras para <b><i class="fa fa-user">  </i> {!!$cliente[0]->NRODOC !!} | {!!$cliente[0]->CONTRIBUYENTE !!}</b>  </h4> 
                </div>
                <div class="card-body">
                     {!! BootForm::open()->action(route('admin.iva.compras.guardar')) !!}
                      {!! BootForm::hidden('cliente_id')->value($cliente[0]->ID) !!} 
                            {!! BootForm::hidden('empresa_id')->value($empresa) !!}
                            {!! BootForm::hidden('cliente_ruc')->value($cliente[0]->NRODOC) !!} 
                     <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                               
                                {!! BootForm::select('Contribuyente','contribuyente')->options($contribuyentes)->addClass('contribuyente') !!} 
                                 
                   
                     {!! BootForm::text('Total Gravadas 10%','total_gravadas_10')->addClass('total_gravadas_10') !!}
                      {!! BootForm::text('Total Debito 10%','total_gravadas_total_10')->addClass('total_gravadas_total_10') !!}
                     {!! BootForm::text('Total Gravadas 5%','total_gravadas_5')->addClass('total_gravadas_5') !!}
                     {!! BootForm::text('Total Debito 5%','total_gravadas_total_5')->addClass('total_gravadas_total_5') !!}
                        {!! BootForm::text('Total Exentas','total_exentas')->addClass('total_exentas') !!}
 {!! BootForm::text('Importe Total','total_importe')->addClass('total_importe') !!}
                    
                            </div>
                             <div class="col-md-6">
                                {!! BootForm::date('Fecha','fecha') !!}
                                {!! BootForm::text('Factura Nro','factura_nro') !!}
                    {!! BootForm::label('Condicion de Venta') !!}<br>
                    {!! BootForm::radio('Contado','condicion','contado')->inline()->addClass('contado')->selected() !!}
                    {!! BootForm::radio('Credito','condicion','credito')->inline()->addClass('credito') !!}<br><br>
                     {!! BootForm::text('Timbrado','timbrado')->required() !!}
                       {!! BootForm::text('Cuotas','cuotas')->value('0')->addClass('cuotas') !!}
                            </div>
   
                        </div>
                     </div>
                   
                   
                   
                  
                   
                   
                    
                    {!! BootForm::submit('Cargar')->addClass('btn btn-primary') !!}
                    {!! BootForm::close() !!}
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    $('.cliente').change(function(e){
        var v =  $('.cliente').val();
        
        var url='{!! env('APP_URL') !!}/admin/contribuyentes/ajax/ruc/'+v;
        $.ajax({
            url: url,
            success: function(res) {
                
                $('.cliente_ruc').val(res)
             },
            error: function() {
                alert("No se ha podido obtener la información");
            }
        });
    });
    $('.contribuyente').change(function(e){
        var v =  $('.contribuyente').val();
        
        var url='{!! env('APP_URL') !!}/admin/contribuyentes/ajax/ruc/'+v;
        $.ajax({
            url: url,
            success: function(res) {
               
                $('.contribuyente_ruc').val(res)
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
function calcularImporte(){
        var gravadas_10=parseInt($('.total_gravadas_10').val());
        var gravadas_total_10=parseInt($('.total_gravadas_total_10').val());
        var gravadas_5=parseInt($('.total_gravadas_5').val());
        var gravadas_total_5=parseInt($('.total_gravadas_total_5').val());
        var gravadas_exentas=parseInt($('.total_exentas').val());
        var gravadas_total=gravadas_10+gravadas_5+gravadas_exentas;
        $('.total_importe').val(gravadas_total);
    
}
$('.total_gravadas_10').change(function(){
    $('.total_gravadas_total_10').val(parseInt($('.total_gravadas_10').val())*10/100);
   calcularImporte();
});
$('.total_gravadas_5').change(function(){
    $('.total_gravadas_total_5').val(parseInt($('.total_gravadas_5').val())*5/100);
  calcularImporte
});
$('.total_exentas').change(function(){
    
   calcularImporte();
});


$('.total_gravadas_10').val(0);
$('.total_gravadas_5').val(0);
$('.total_gravadas_total_10').val(0);
$('.total_gravadas_total_5').val(0);
$('.total_exentas').val(0);
$('.total_importe').val(0);
$('.contado').click(function(){
    if($(this).prop("checked") == true){
          $('label[for=cuotas]').hide();
          $('.cuotas').hide();
    }
    else if($(this).prop("checked") == false){
                $('label[for=cuotas]').show();
          $('.cuotas').show();      
    }
});
$('.credito').click(function(){
    if($(this).prop("checked") == true){
          $('label[for=cuotas]').show();
          $('.cuotas').show();
    }
    else if($(this).prop("checked") == false){
                $('label[for=cuotas]').hide();
          $('.cuotas').hide();      
    }
});

@endsection
