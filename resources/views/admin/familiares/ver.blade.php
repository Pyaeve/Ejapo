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
            <div class="card">
                <div class="card-header">Familiales de <b>{!! $cliente[0]->CONTRIBUYENTE !!}</b></div>

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
                                    Nombre
                                </th>
                                <TH>
                                    Identificacion
                                </TH>
                                <th>
                                    Vinculo
                                </th>
                                 <th>
                                    Regimen
                                </th>
                                <th>
                                    Fecha Nac
                                </th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($familiares as $node)

                                <tr>
                                    <td>
                                        <a href="{!! route('admin.familiares.editar',['id'=>$node->id])!!}" class="btn btn-primary  ">Editar</a>         
                                        <a href="@#" class="btn btn-danger ">Borrar</a>          
                                    </td> 
                                    </td>
                                    <td>
                                        {!! $node->id!!}
                                    </td>
                                   
                                   <td>
                                        {!! $node->nombre !!}
                                    </td>
                                       <td>
                                        {!! $node->identificacion!!}
                                    </td>
                                
                                   <td>
                                        {!! $node->vinculo_texto !!}
                                    </td>
                                     <td>
                                        {!! $node->regimen_texto !!}
                                    </td>
                                   <td>
                                        {!! $node->fecha !!}
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
