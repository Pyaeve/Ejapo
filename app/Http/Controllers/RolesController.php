<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
class RolesController extends Controller
{
    //
     function cargar(){
        
    	return view('admin.roles.cargar');
    }

    function guardar(Request $req){

    	$data=$req->all();
    	Role::create(['name'=>$data['name']]);
        return redirect(route('admin.roles.resumen'));
    }

    function resumen(){

    	$data=Role::all();
		//dd($data);
    	return view('admin.roles.resumen',['data'=>$data]);
    }
}
