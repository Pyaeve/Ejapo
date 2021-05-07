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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Resumen de Roles</div>

                <div class="card-body">
                   <table class="table table-responsive table-striped table-hover">  
                        <thead> 
                            <tr> 
                                <th></th>
                                <th>#</th>
                                <th>Rol</th> 
                                <th>Ambito</th>
                            </tr>
                           
                        </thead>
                            
                        <tbody> 
                            @foreach($data as $node)
                            <tr> 
                                <td>
                                    <a href="#" class="btn btn-primary">Editar</a>
                                    <a href="#" class="btn btn-danger">Borrar</a>
                              </td>
                                <td>{!! $node->id !!}</td>   
                                 <td>{!! $node->name !!}</td>   
                                 <td>{!! $node->guard_name !!}</td>  
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
