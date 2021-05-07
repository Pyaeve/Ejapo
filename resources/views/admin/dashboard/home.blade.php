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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Cargar Egresos</div>

                <div class="card-body">
                  
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Cargar Egresos</div>

                <div class="card-body">
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
