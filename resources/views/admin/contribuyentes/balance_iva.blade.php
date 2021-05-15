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
                <div class="card-header"><h4> {!! strtoupper($contribuyente[0]->CONTRIBUYENTE) !!}  </h4></div>

                <div class="card-body" style="align-self: center">
                        {!! BootForm::open()->get() !!}
                        {!! BootForm::hidden('empresa_id')->value($empresa) !!}   
                        {!! BootForm::hidden('cliente_id')->value($contribuyente[0]->ID) !!}   
                        {!! BootForm::select('A&ntilde;o','y')->options(['2020'=>'2020','2021'=>'2021'])->select($_GET['y']) !!}
                        {!! BootForm::select('Mes','m')->options(['01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre'])->select($_GET['m']) !!}
                        {!! BootForm::submit('Filtrar')->addClass('btn btn-primary') !!}
                             <a class="btn btn-primary" href="{!! route('admin.iva.ventas.cargar',['id'=>$contribuyente[0]->ID]) !!}">Cargar Ventas</a>
                         <a class="btn btn-primary" href="{!! route('admin.iva.compras.cargar',['id'=>$contribuyente[0]->ID]) !!}">Cargar Compras</a>
                          <a class="btn btn-primary" href="{!! route('admin.iva.hechauka.exportar',['id'=>$contribuyente[0]->ID]) !!}">Exportar a Hechauka</a>
 
                       
                        <br> 
                          <br>       

                        
                    <table class="table table-responsive table-striped"> 
                        <thead>
                            <tr>
                               
                                <th>Ventas</th>
                                <th>Compras</th>
                                <th>Neto</th>
                                <th>IVA(10%)</th>
                           </tr>
                        </thead>
                               
                        <tbody> 
                             <tr align="right">  
                              
                                    <td>  {!!number_format($ventas_total, 0, ',', '.')!!}  </td>
                                     <td>  {!!number_format($compras_total,0,',','.')!!}  </td>
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
                <div class="card-header"><B>Ventas</B></div>

                <div class="card-body">
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                        
                                <th>Fecha</th>
                                <th>Nro Doc</th>
                                <th>Tipo Doc</th>
                
                                <th>Monto Total</th>
                                    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ventas as $node)
                            <tr>
                                        <td>
                                   {!! $node->fecha!!}
                                </td>
                                <td>
                                    {!! $node->doc_nro !!}
                                </td>
                                <td>
                                    {!! $node->doc_tipo !!}
                                </td>
                              
                                <td>
                                    {!! number_format($node->total,0,',','.') !!}
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
                <div class="card-header"><B>Compras</B></div>

                <div class="card-body">
                  <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                     
                                <th>Fecha</th>
                                <th>Nro Doc</th>
                                <th>Tipo Doc</th>
                                
                                <th>Monto Total</th>
                                    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($compras as $node)
                            <tr>
                              
                                <td>
                                   {!! $node->fecha!!}
                                </td>
                                <td>
                                    {!! $node->doc_nro !!}
                                </td>
                                <td>
                                    {!! $node->doc_tipo !!}
                                </td>
                               
                                <td>
                                    {!! number_format($node->total,0,',','.') !!}
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



@endsection