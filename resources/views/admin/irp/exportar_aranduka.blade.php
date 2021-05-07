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
                <div class="card-header"><h4><i class="fa fa-cloud-download"></i> Exportar DDJJ a Aranduka</h4> </div>

                <div class="card-body">
                   <div class="container">
                     
                           <div class="col-md-12">
                               
                               {!! BootForm::open()->action(route('admin.irp.aranduka.exportar.procesar')) !!}
                               {!! BootForm::hidden('empresa_id')->value($empresa) !!}
                          {!! BootForm::select('Cliente','cliente_id')->options($clientes) !!}     
                        {!! BootForm::select('Periodo','periodo')->options(['2020'=>'2020']) !!}
                         
                          {!! BootForm::submit('Exportar a Aranduka')->addClass('btn btn-primary') !!}

                        {!! BootForm::close() !!}
                       
                        <br>       

                        
                    
                  
                    
                          
                       </dir>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
