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
          <div class="col-md-12" style="margin-bottom:25px">               
            <div class="card">
                <div class="card-header"><h4><i class="fa fa-user"></i><b> {!! strtoupper($contribuyente[0]->NRODOC) !!} | {!! strtoupper($contribuyente[0]->CONTRIBUYENTE) !!}   </b>  </h4></div>

                <div class="card-body" style="align-self: center">
                        {!! BootForm::open()->get() !!}
                               
                        {!! BootForm::select('Periodo','p')->options(['2020'=>'2020','2021'=>'2021']) !!}
                         
                          {!! BootForm::submit('Filtrar')->addClass('btn btn-primary') !!}

                             <a class="btn btn-primary" href="{!! route('admin.irp.ingresos.cargar',['id'=>$contribuyente[0]->ID]) !!}"><i class="fa fa-plus"></i> Cargar Ingresos</a>
                         <a class="btn btn-primary" href="{!! route('admin.irp.egresos.cargar',['id'=>$contribuyente[0]->ID]) !!}"><i class="fa fa-plus"></i> Cargar Egresos</a>
                            <a class="btn btn-primary aranduka" href="{!! route('admin.irp.aranduka.exportar',['ci'=>$contribuyente[0]->ID,'pe'=>$_GET['p']]) !!}"><i class="fa fa-cloud-download">  </i> Exportar a Aranduka</a>
                        {!! BootForm::close() !!}
                       
                        <br>       

                        
                    <table class="table table-responsive table-striped"> 
                        <thead>
                            <tr>
                               
                                <th>Ingresos</th>
                                <th>Egresos</th>
                                <th>Total Residuo</th>
                                <th>Liquicacion del IRP(8%)</th>
                           </tr>
                        </thead>
                               
                        <tbody> 
                             <tr align="right">  
                              
                                    <td>  {!!number_format($ingresos_total, 0, ',', '.')!!}  </td>
                                     <td>  {!!number_format($egresos_total,0,',','.')!!}  </td>
                                     <td>   {!! number_format($total,0,',','.')!!}</td>
                                     <td>   {!! number_format($impuesto,0,',','.') !!}</td>
                                </tr>
                        </tbody>
                    </table>
                  
                    
                </div>    
            </div>
          </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><B><i class="fa fa-plus">    </i> Ingresos</B></div>

                <div class="card-body">
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                        <TH>    </TH>
                                <th>Fecha</th>
                                <th>Nro Doc</th>
                                <th>Tipo Doc</th>
                                <th>Tipo Ingreso</th>
                                <th>Monto Total</th>
                                    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ingresos as $node)
                            <tr>
                            <td>
                                   <a class="btn btn-primary" href="{!! route('admin.irp.ingresos.editar',['id'=>$node->id])!!}"><i class="fa fa-pencil">    </i> Editar</a>
                                   <a class="btn btn-danger" href="{!! route('admin.irp.ingresos.borrar',['id'=>$node->id])!!}"><i class="fa fa-trash"></i> Borrar</a>
                                </td>                                <td>
                                   {!! $node->fecha!!}
                                </td>
                                <td>
                                    {!! $node->nro_doc !!}
                                </td>
                                <td>
                                    {!! $node->tipo_doc !!}
                                </td>
                                <td>
                                   {!! $node->tipo_ingreso !!}
                                </td>
                                <td>
                                    {!! number_format($node->ingreso_total,0,',','.') !!}
                                </td>
                             
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><B><i class="fa fa-minus">    </i> Egresos</B></div>

                <div class="card-body">
                  <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                        <TH>    </TH>
                                <th>Fecha</th>
                                <th>Nro Doc</th>
                                <th>Tipo Doc</th>
                                <th>Tipo Egreso</th>
                                <th>Monto Total</th>
                                    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($egresos as $node)
                            <tr>
                                 <td>
                                   <a class="btn btn-primary" href="#">Editar</a>
                                   <a class="btn btn-danger" href="#">Borrar</a>
                                </td>      
                                <td>
                                   {!! $node->fecha!!}
                                </td>
                                <td>
                                    {!! $node->nro_doc !!}
                                </td>
                                <td>
                                    {!! $node->tipo_doc !!}
                                </td>
                                <td>
                                   {!! $node->tipo_egreso !!}
                                </td>
                                <td>
                                    {!! number_format($node->egreso_total,0,',','.') !!}
                                </td>
                               
                            </tr>
                            @endforeach

                           </tbody>
                    </table>
                </div>
            </div>
        </div>

                     </div>

             
      
</div>
@endsection
@section('scripts')

$('.aranduka').click(function(){
    $.ajax({
    url: '{!! route('admin.irp.aranduka.exportar',['ci'=>$contribuyente[0]->ID,'pe'=>$_GET['p']]) !!}',
     type: "GET",
      dataType: 'binary'
        

});


@endsection