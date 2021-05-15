<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Familiares;
class FamiliaresController extends Controller
{
    //
     function cargar($id){
     	$emp=DB::select("SELECT FNC_DAME_CONTRIBUYENTE_EMPRESA_ID('".$id."') AS empresa_id");
     	$emp=$emp[0]->empresa_id;
     	$vinculos = DB::select('CALL  PRO_LISTAR_TIPO_VINCULO()');
     	$vinculos_data=[];
     	foreach ($vinculos as $node) {
     		$vinculos_data[$node->id]=$node->desc;
     	}
     	$regimen = DB::select('CALL PRO_LISTAR_REGIMEN_MATRIMONIAL()');
     	$regimen_data=[];
		foreach ($regimen as $node) {
     		$regimen_data[$node->id]=$node->desc;
     	}
     	$cont=DB::select("CALL  PRO_VER_CONTRIBUYENTE('".$emp."','".$id."');");
    	return view('admin.familiares.cargar',['vinculos'=>$vinculos_data,'empresa'=>$emp,'contribuyente'=>$cont,'regimenes'=>$regimen_data]);
    }
    function editar($id){
    	$user=DB::select("SELECT FNC_DAME_CONTRIBUYENTE_ID_FAMILIAR('".$id."') AS user_id");
    	$user=$user[0]->user_id;
     	$emp=DB::select("SELECT FNC_DAME_CONTRIBUYENTE_EMPRESA_ID('".$user."') AS empresa_id");
     	$emp=$emp[0]->empresa_id;
     	$vinculos = DB::select('CALL  PRO_LISTAR_TIPO_VINCULO()');
     	$vinculos_data=[];
     	foreach ($vinculos as $node) {
     		$vinculos_data[$node->id]=$node->desc;
     	}
     	$regimen = DB::select('CALL PRO_LISTAR_REGIMEN_MATRIMONIAL()');
     	$regimen_data=[];
		foreach ($regimen as $node) {
     		$regimen_data[$node->id]=$node->desc;
     	}

     	$cont=DB::select("CALL  PRO_VER_CONTRIBUYENTE('".$emp."','".$id."');");
     	$familiares=Familiares::find($id);
    	return view('admin.familiares.editar',['vinculos'=>$vinculos_data,'empresa'=>$emp,'contribuyente'=>$cont,'regimenes'=>$regimen_data,'familiar'=>$familiares]);
    }
      function guardar(Request $req){
      		$data=$req->all();

      		$familiares=new Familiares();
      		$familiares->empresa_id=$data['empresa_id'];
      		$familiares->cliente_id=$data['cliente_id'];
      		$familiares->identificacion=$data['identificacion'];
      		$familiares->nombre=$data['nombre'];
      		if($data['vinculo']=='1'){ 			
      			$familiares->regimen=$data['regimen'];
      		}      		
      		$familiares->vinculo=$data['vinculo'];
      		$familiares->ruc=$data['cliente_ruc'];
      		$familiares->fecha_nacimiento=$data['fecha_nac'];
      		$familiares->periodo=$data['periodo'];
      		$familiares->save();
      		return redirect(route('admin.familiares.ver',['id'=>$data['cliente_id']]));
      }

      function ver($id){
      	$emp=DB::select("SELECT FNC_DAME_CONTRIBUYENTE_EMPRESA_ID('".$id."') AS empresa_id");
     	$emp=$emp[0]->empresa_id;
      	$cliente=DB::select("CALL PRO_VER_CONTRIBUYENTE('".$emp."','".$id."');");
      	$familiares=DB::select("CALL PRO_LISTAR_FAMILIARES('".$id."');");     
      	return view('admin.familiares.ver',['cliente'=>$cliente,'familiares'=>$familiares]);
    }
      
      function actualizar(Request $req){
      	$data=$req->all();
      	dd($data);
      }
       function listar_clientes(){
    	$user_id=Auth::user()->id;
    	$emp_id=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user_id."') AS empresa_id");
    	$emp_id=$emp_id[0]->empresa_id;
      $data=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_WEB_CLIENTES_TODOS('".$emp_id."','".$user_id."');");
    
        return view('admin.familiares.seleccionar',['data'=>$data]);
    }
}
