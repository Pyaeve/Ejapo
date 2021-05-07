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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">  @role('Developer')
                    Resumen de Usuarios
                   @elserole('Contador')
                    Resumen de Colaboradores
                @endrole</div>

                <div class="card-body">
                   <table class="table table-responsive table-striped table-hover">  
                        <thead> 
                            <tr> 
                                <th></th>
                                <th>#</th>
                                <th>Nombre</th> 
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Direcci&oacute;n</th>
                                <th>Ciudad</th>
                                <th>Tel/Cel</th>
                                <th>Email</th>
                                <th>Timbrado Nro</th>
                                <th>Timbrado Inicio</th>
                                <th>Timbrado Vence</th>

                            </tr>
                           
                        </thead>
                            
                        <tbody> 
                            @foreach($data as $node)
                            <tr> 
                                <td>
                                    <a href="#" class="btn btn-primary">Editar</a>
                                    <a href="#" class="btn btn-danger">Borrar</a>
                              </td>
                                <td>{!! $node->ID !!}</td>   
                                <td>{!! $node->EMPRESA !!}</td>   
                                <td>{!! $node->TIPODOC !!}</td> 
                                <td>{!! $node->NRODOC !!}</td> 
                                <td>{!! $node->DIRECCION !!}</td> 
                                <td>{!! $node->CIUDAD !!}</td>  
                                <td>{!! $node->TEL !!}</td>  
                                <td>{!! $node->EMAIL !!}</td>  
                                <td>{!! $node->TIMBRADO_NRO !!}</td>
                                <td>{!! $node->TIMBRADO_INICIO !!}</td>  
                                <td>{!! $node->TIMBRADO_FIN !!}</td>    
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
 $('.table').DataTable( {
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    } );
@endsection 
