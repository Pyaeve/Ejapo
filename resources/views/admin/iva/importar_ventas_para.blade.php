@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-12">
                {{ Breadcrumbs::render('admin_iva_ventas_importar') }}
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
                <div class="card-header">Selecione un cliente</div>

                <div class="card-body ">
                   
             

                    <table class="table table-striped table-hover table-condensed table-responsive">
                        <thead>
                            <tr>
                                <TH>
                                    
                                </TH>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Contribuyente
                                </th>
                                <TH>
                                    Tipo
                                </TH>
                                <th>Regimen</th>
                                <th>
                                    Tipo Doc
                                </th>
                                <th>
                                    Nro Doc
                                </th>
                                <th>
                                    Direccion
                                </th>
                                <th>
                                    Ciudad
                                </th>
                                <th>
                                    Tel/Cel
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Timbrado Nro
                                </th>
                                <th>
                                    Timbrado Inicio
                                </th>
                                <th>
                                    Timbrado Fin
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $node)
                                @if($node->REGIMEN=='IVA')
                                <tr>
                                    <td>
                                        <a href="{!! route('admin.iva.importar.ventas',['id'=>$node->ID])!!}" class="btn btn-primary  ">Seleccionar&nbsp;</a>
                                        
                                         </td>
                                    <td>
                                        {!! $node->ID!!}
                                    </td>
                                   <td>
                                        {!! $node->CONTRIBUYENTE !!}
                                    </td>
                                   <td>
                                        {!! $node->TIPO !!}
                                    </td>
                                    <td>
                                        {!! $node->REGIMEN !!}
                                    </td>
                                   <td>
                                        {!! $node->TIPODOC !!}
                                    </td>
                                  
                                   <td>
                                        {!! $node->NRODOC !!}
                                    </td>
                                  
                                   <td>
                                        {!! $node->DIRECCION!!}
                                    </td>
                                  
                                   <td>
                                        {!! $node->CIUDAD!!}
                                    </td>
                                  
                                   <td>
                                        {!! $node->TEL!!}
                                    </td>
                                  
                                   <td>
                                        {!! $node->EMAIL!!}
                                    </td>
                                   <td>
                                        {!! $node->TIMBRADO_NRO!!}
                                    </td>
                                   <td>
                                        {!! $node->TIMBRADO_INICIO!!}
                                    </td>
                                   <td>
                                        {!! $node->TIMBRADO_FIN!!}
                                    </td>
                                
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                   
                
       
                </div>

                </div>
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
@endsection