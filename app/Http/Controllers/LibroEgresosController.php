<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\LibroEgresos;

class LibroEgresosController extends Controller
{

     function cargar($id){
     	//obtenemos la empresa 
      	$emp=DB::select("SELECT FNC_DAME_CONTRIBUYENTE_EMPRESA_ID('".$id."') AS empresa_id;");
        $emp=$emp[0]->empresa_id;
        //obtenemos el cliente
      	$cliente=DB::select("CALL PRO_VER_CONTRIBUYENTE('".$emp."','".$id."');");
       // dd($cliente);
      	//obtnemos los contribuyentes
        $contribuyentes=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_NO_CLIENTES_TODOS('".$emp."');");
        $contribuyentes_data=[];
        foreach ($contribuyentes as $node) {
          $contribuyentes_data[$node->id]=$node->contribuyente;
        }
        //obtenemos los tipos de docuemente de egreso
        $tipo_doc=DB::select("CALL PRO_LISTAR_TIPO_DOC_EGRESO();");
        $tipo_doc_data=[];
        foreach ($tipo_doc as $node) {
          $tipo_doc_data[$node->codigo]=$node->desc;
        }
        //obtenemos los tipos de egresos
        $tipo_egreso=DB::select("CALL PRO_LISTAR_TIPO_EGRESO();");
        $tipo_egreso_data=[];
        foreach ($tipo_egreso as $node) {
          $tipo_egreso_data[$node->codigo]=$node->desc;
        }
        //obtenemos los subtipo de egresos
        $subtipo_egreso = DB::select("CALL PRO_LISTAR_SUBTIPO_EGRESO('gasto');");
        $subtipo_egreso_data=[];
        foreach ($subtipo_egreso as $node) {
          $subtipo_egreso_data[$node->codigo]=$node->desc;
        }
        return view('admin.irp.cargar_egresos',['cliente'=>$cliente,'contribuyentes'=>$contribuyentes_data,'empresa'=>$emp,'tipo_doc'=>$tipo_doc_data,'tipo_egreso'=>$tipo_egreso_data,'subtipo_egreso'=>$subtipo_egreso_data]);
    }

    function guardar(Request $req){

      $data=$req->all();
    // dd($data);
    



      $tipo_texto=DB::select("SELECT FNC_DAME_TIPO_EGRESO_TEXTO('".$data['tipo']."') AS 'tipo_texto'");


      $tipo_texto=$tipo_texto[0]->tipo_texto;
      $rel_ruc=DB::select("SELECT FNC_DAME_RUC('".$data['contribuyente']."') AS 'rel_ruc'");
       $rel_ruc= $rel_ruc[0]->rel_ruc;

       $rel_nombre=DB::select("SELECT FNC_DAME_CONTRIBUYENTE_NOMBRE('".$data['contribuyente']."') AS 'rel_nombre'");
       $rel_nombre= $rel_nombre[0]->rel_nombre;
       $d=date_create($data['fecha']);

       $p=date_format($d,'Y');

      $le=new LibroEgresos();
      $le->empresa_id=$data['empresa_id'];
      $le->cliente_id=lcfirst($data['cliente_id']);
      $le->tipo=$data['tipo'];
      $le->periodo=$p;
      $le->tipo_texto=$tipo_texto;
      $le->sub_tipo_egreso=$data['subtipoEgreso'];
      $le->fecha=$data['fecha'];
      $le->ruc=$data['cliente_ruc'];
      $le->tipo_egreso=$data['tipoEgreso'];
      $le->tipo_egreso_texto=" ";
      $le->egreso_monto_total=str_replace(".", "", $data['egresoTotal']);
      $le->timbrado_condicion=lcfirst($data['condicion']);
      $le->timbrado_documento=$data['doc_nro'];
      $le->timbrado_numero=$data['timbrado'];
      $le->relacionado_tipo_identificacion="RUC";
      $le->relacionado_numero_identificacion=$rel_ruc;
      $le->relacionado_nombres=$rel_nombre;
      $le->save();  
      return redirect(route('admin.contribuyentes.balance',['id'=>$data['cliente_id'],'p'=>date('Y')]));
    }
    function listar_clientes(){
    	$user_id=Auth::user()->id;
    	$emp_id=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user_id."') AS empresa_id");
    	$emp_id=$emp_id[0]->empresa_id;
      $data=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_WEB_CLIENTES_TODOS('".$emp_id."','IRP');");
    
        return view('admin.irp.cargar_egresos_para',['data'=>$data]);
    }

    function ajax_subtipo($codigo){

    	$subtipo_egreso = DB::select("CALL PRO_LISTAR_SUBTIPO_EGRESO('".$codigo."');");
        
        return $subtipo_egreso;
    }
    function editar($id){
      $le=LibroEgresos::find($id);
      $user=Auth::user()->id;
      //obtenemos la empresa 
        $emp=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user."') AS empresa_id;");
        $emp=$emp[0]->empresa_id;
        //obtenemos el cliente
        $cliente=DB::select("CALL PRO_VER_CONTRIBUYENTE('".$emp."','".$user."');");
       // dd($cliente);
        //obtnemos los contribuyentes
        $contribuyentes=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_NO_CLIENTES_TODOS('".$emp."');");
        $contribuyentes_data=[];
        foreach ($contribuyentes as $node) {
          $contribuyentes_data[$node->id]=$node->contribuyente;
        }
        //obtenemos los tipos de docuemente de egreso
        $tipo_doc=DB::select("CALL PRO_LISTAR_TIPO_DOC_EGRESO();");
        $tipo_doc_data=[];
        foreach ($tipo_doc as $node) {
          $tipo_doc_data[$node->codigo]=$node->desc;
        }
        //obtenemos los tipos de egresos
        $tipo_egreso=DB::select("CALL PRO_LISTAR_TIPO_EGRESO();");
        $tipo_egreso_data=[];
        foreach ($tipo_egreso as $node) {
          $tipo_egreso_data[$node->codigo]=$node->desc;
        }
        //obtenemos los subtipo de egresos
        $subtipo_egreso = DB::select("CALL PRO_LISTAR_SUBTIPO_EGRESO('gasto');");
        $subtipo_egreso_data=[];
        foreach ($subtipo_egreso as $node) {
          $subtipo_egreso_data[$node->codigo]=$node->desc;
        }
        
        return view('admin.irp.editar_egresos',['data'=>$le,'cliente'=>$cliente,'contribuyentes'=>$contribuyentes_data,'empresa'=>$emp,'tipo_doc'=>$tipo_doc_data,'tipo_egreso'=>$tipo_egreso_data,'subtipo_egreso'=>$subtipo_egreso_data]);
    }

 

 function borrar($id){
        $data=LibroEgresos::find($id);

        $cliente= $data['cliente_id'];
        $data->destroy($id);
        return redirect(route('admin.contribuyentes.balance',['id'=>$cliente]));       
    }

  }