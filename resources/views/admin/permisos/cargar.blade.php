@extends('layouts.app')

@section('content')
<div class="container">
	 <div class="row justify-content-center">
        <div class="col-md-8">
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
                <div class="card-header">Cargar Permiso</div>

                <div class="card-body">
                   {!! BootForm::open()->action(route('admin.permisos.guardar')) !!}
                   {!! BootForm::text('Nombre del Permiso','name') !!}
                   {!! BootForm::submit('Cargar')->addClass('btn btn-success') !!}

                   {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
