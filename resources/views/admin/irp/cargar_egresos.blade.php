@extends('layouts.app')
@section('content')
<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-12">
                {{ Breadcrumbs::render('admin_irp_egresos_cargar') }}
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
                <div class="card-header">Cargar Egresos para <b>{!!$cliente[0]->NRODOC !!} | {!!$cliente[0]->CONTRIBUYENTE !!}</b></div>

                <div class="card-body">
                     {!! BootForm::open()->action(route('admin.irp.egresos.guardar')) !!}
                            {!! BootForm::hidden('cliente_id')->value($cliente[0]->ID) !!} 
                            {!! BootForm::hidden('empresa_id')->value($empresa) !!}
                            {!! BootForm::hidden('cliente_ruc')->value($cliente[0]->NRODOC) !!} 
                    <div class="container">
                        <div class="row">
                          
                           <div class="col-md-6">
                             
                              {!! BootForm::select('Contribuyente','contribuyente')->options($contribuyentes)->addClass('contribuyente') !!} 
                              {!! BootForm::select('Tipo Egreso','tipoEgreso')->options($tipo_egreso)->addClass('tipoEgreso') !!} 
                               {!! BootForm::select('Subtipo Egreso','subtipoEgreso')->options($subtipo_egreso)->addClass('subtipoEgreso') !!} 
                             
                                {!! BootForm::text('Total Egreso Neto','egresoTotal')->addClass('egresoTotal') !!}
                           </div>
                           <div class="col-md-6">
                              {!! BootForm::select('Tipo Documento','tipo')->options($tipo_doc)->addClass('tipo_doc')->addClass('tipo_doc') !!}   
                             
                              {!! BootForm::date('Fecha','fecha') !!}
                              {!! BootForm::label('Condicion') !!}<br>  
                              {!! BootForm::inlineRadio('Contado','condicion') !!}
                              {!! BootForm::inlineRadio('Credito','condicion') !!}<br><br>
                              {!! BootForm::text('Documento Nro','doc_nro')->addClass('doc_nro') !!}
                              {!! BootForm::text('Timbrado','timbrado') !!}
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

const et = document.querySelector('.egresoTotal');

function formatNumber (n) {
    n = String(n).replace(/\D/g, "");
  return n === '' ? n : Number(n).toLocaleString('es-PY',{'maximumFractionDigits':2});
}
et.addEventListener('keyup', (e) => {
    const element = e.target;
    const value = element.value;
  element.value = formatNumber(value);
});

 
    $('.doc_nro').mask("999-999-9999999");
    $('.tipoEgreso').change(function(e){
        let v =  $('.tipoEgreso').val();
        let dd = $('.subtipoEgreso');dd.empty();
        let url='{!! env('APP_URL') !!}/admin/irp/egresos/ajax/subtipo/'+v;
        $.ajax({
            url: url,
            success: function(r) {
                $.each(r, function (k, j) {
                    dd.append($('<option></option>').attr('value', j.codigo).text(j.desc));
                });
             },
            error: function() {
                alert("No se ha podido obtener la información");
            }
        });
    });
     $('.contribuyente').select2({
    theme: "bootstrap"
});
     $('.tipoEgreso').select2({
    theme: "bootstrap"
});
     $('.subtipoEgreso').select2({
    theme: "bootstrap"
});
     $('.tipo_doc').select2({
    theme: "bootstrap"
});
@endsection
