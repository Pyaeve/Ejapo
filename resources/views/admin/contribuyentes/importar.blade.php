@extends('layouts.app')

@section('content')
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-12">
        		{{ Breadcrumbs::render('admin_contribuyentes_resumen') }}
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
                <div class="card-header"><h3><i class="fa fa-cloud-upload">  </i> Importar  Contribuyentes<!-- <span class="float-right"><a href="{!! route('admin.contribuyentes.cargar') !!}" class="btn btn-success">Cargar Contribuyente</a></span>--></h3> </div>

                <div class="card-body ">
                   
                    
                        {!! BootForm::open()->action(route('admin.contribuyentes.importar_excel'))->enctype('multipart/form-data') !!}
                       {!! BootForm::label('Seleccione un Archivo de Excel o Calc para Importar hasta 500 Contribuyentes')!!}
                        {!! BootForm::file('','file_importar_contribuyentes') !!}
                        {!! BootForm::submit(' Importar Contribuyentes','submit')->addClass('btn btn-primary fa fa-cloud-upload') !!}
                        {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal-confirm-drop" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pyaeve.com</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Desea borrar este Contribuyente?</p>
        <input class="modal-data" type="hidden" name="cid" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-drop btn btn-primary">Borrar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')

     $('.table').DataTable( {
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    } );


    $('.btn-drop').click(function(){
        

        var v= $("#modal-confirm-drop .modal-data").val();
        
                var url='{!! env('APP_URL') !!}/admin/contribuyentes/ajax/borrar/'+v;
        $.ajax({
            url: url,
            success: function(res) {
                
               alert(res);
             },
            error: function() {
                alert("No se ha podido obtener la información");
            }
        });
       
    });

    $('.btn-action-drop').click(function(){

        var btn =$(this);
        $("#modal-confirm-drop .modal-data").val(btn.data('id'));
        $("#modal-confirm-drop").modal('show');
    });
@endsection
