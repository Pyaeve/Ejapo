<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisosController extends Controller
{
    //
    function cargar(){

    	return view('admin.permisos.cargar');
    }

    function guardar(Request $req){

    	$data=$req->all();
    	dd($data);
    }

    function resumen(){

    	
    }

}
