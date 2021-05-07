<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmpresasUsuarios;
use App\LibroIngresos;
use DB;
use Auth;
class LibroIngresosController extends Controller
{
    //
      function cargar($id){
         $user=Auth::user()->id;
        $emp=DB::select("SELECT  FNC_DAME_EMPRESA_ID('".$user."') AS empresa_id");
        $emp=$emp[0]->empresa_id;
         $es_cliente=DB::select("SELECT FNC_CONTRIBUYENTE_ES_CLIENTE('".$emp."','".$id."') AS es_cliente");
        $es_cliente=$es_cliente[0]->es_cliente;
        //si no es cliente los redireccionamso
        if($es_cliente=='No'){
            return redirect(route('admin.irp.ingresos.clientes'));
        }
      	$cliente=DB::select("CALL PRO_VER_CONTRIBUYENTE('".$emp."','".$id."');");
       // dd($cliente);
        $contribuyentes=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_TODOS_MENOS('".$emp."','".$id."');");
        $contribuyentes_data=[];
        foreach ($contribuyentes as $node) {
          $contribuyentes_data[$node->id]=$node->contribuyente;
        }
        $tipo_doc=DB::select("CALL PRO_LISTAR_TIPO_DOC_INGRESO();");
        $tipo_doc_data=[];
        foreach ($tipo_doc as $node) {
          $tipo_doc_data[$node->codigo]=$node->desc;
        }
        $tipo_ingreso=DB::select("CALL PRO_LISTAR_TIPO_INGRESO();");
        $tipo_ingreso_data=[];
        foreach ($tipo_ingreso as $node) {
          $tipo_ingreso_data[$node->codigo]=$node->desc;
        }
        
        return view('admin.irp.cargar_ingresos',['cliente'=>$cliente,'contribuyentes'=>$contribuyentes_data,'empresa'=>$emp,'tipo_doc'=>$tipo_doc_data,'tipo_ingreso'=>$tipo_ingreso_data]);
    }

    function guardar(Request $req){

    	$data=$req->all();
     dd($data);
      $tipo_texto=DB::select("SELECT FNC_DAME_TIPO_INGRESO_TEXTO('".$data['tipo']."') AS 'tipo_texto'");
      $tipo_texto=$tipo_texto[0]->tipo_texto;

      $rel_ruc=DB::select("SELECT FNC_DAME_RUC('".$data['contribuyente']."') AS 'rel_ruc'");
       $rel_ruc= $rel_ruc[0]->rel_ruc;

       $rel_nombre=DB::select("SELECT FNC_DAME_CONTRIBUYENTE_NOMBRE('".$data['contribuyente']."') AS 'rel_nombre'");
       $rel_nombre= $rel_nombre[0]->rel_nombre;
$d=date_create($data['fecha']);

       $p=date_format($d,'Y');
      $li=new LibroIngresos();
      $li->empresa_id=$data['empresa_id'];
      $li->cliente_id=$data['cliente_id'];
      $li->tipo=$data['tipo'];
      $li->periodo=$p;
      $li->tipo_texto=$tipo_texto;
      $li->fecha=$data['fecha'];
    	$li->ruc=$data['cliente_ruc'];
      $li->tipo_ingreso=$data['tipoIngreso'];
      $li->tipo_ingresotexto=$tipo_texto;
      $li->ingreso_monto_gravado=$data['ingresoGravado'];
      $li->ingreso_monto_nogravado=$data['ingresoNoGravado'];
      $li->ingreso_monto_total=$data['ingresoTotal'];
      if($data['tipo']==1 ||  $data['tipo']==1 ){
         $li->timbrado_condicion=lcfirst($data['condicion']);
         $li->timbrado_documento=$data['doc_nro'];
       
      }elseif($data['tipo']==5){
         $d=date_create($data['fecha']);

         $m=date_format($d,'m');

         $li->mes=$m;
         $li->timbrado_documento=0;
      }
       $li->timbrado_numero=$data['timbrado'];
     
      $li->relacionado_tipo_identificacion="RUC";
      $li->relacionado_numero_identificacion=$rel_ruc;
      $li->relacionado_nombre=$rel_nombre;
      $li->save();  
      return redirect(route('admin.contribuyentes.balance',['id'=>$data['cliente_id'],'p'=>date('Y')]));
    }

    function actualizar(Request $req){

      $data=$req->all();
     //dd($data);
      $tipo_texto=DB::select("SELECT FNC_DAME_TIPO_INGRESO_TEXTO('".$data['tipo']."') AS 'tipo_texto'");
      $tipo_texto=$tipo_texto[0]->tipo_texto;
      $rel_ruc=DB::select("SELECT FNC_DAME_RUC('".$data['contribuyente']."') AS 'rel_ruc'");
      $rel_ruc= $rel_ruc[0]->rel_ruc;
      $rel_nombre=DB::select("SELECT FNC_DAME_CONTRIBUYENTE_NOMBRE('".$data['contribuyente']."') AS 'rel_nombre'");
      $rel_nombre= $rel_nombre[0]->rel_nombre;
      $d=date_create($data['fecha']);
      $p=date_format($d,'Y');
      $li=new LibroIngresos();
      $li->empresa_id=$data['empresa_id'];
      $li->cliente_id=$data['cliente_id'];
      $li->tipo=$data['tipo'];
      $li->periodo=$p;
      $li->tipo_texto=$tipo_texto;
      $li->fecha=$data['fecha'];
      $li->ruc=$data['cliente_ruc'];
      $li->tipo_ingreso=$data['tipoIngreso'];
      $li->tipo_ingresotexto=$tipo_texto;
      $li->ingreso_monto_gravado=$data['ingresoGravado'];
      $li->ingreso_monto_nogravado=$data['ingresoNoGravado'];
      $li->ingreso_monto_total=$data['ingresoTotal'];
      if($data['tipo']==1 ||  $data['tipo']==1 ){
        $li->timbrado_condicion=lcfirst($data['condicion']);
        $li->timbrado_documento=$data['doc_nro'];
        $li->timbrado_numero=$data['timbrado'];
      }elseif($data['tipo']==1){
        $d=date_create($data['fecha']);

       $m=date_format($d,'m');

        $li->mes=$m;
      }
     
      $li->relacionado_tipo_identificacion="RUC";
      $li->relacionado_numero_identificacion=$rel_ruc;
      $li->relacionado_nombre=$rel_nombre;
      $li->save();  
       return redirect(route('admin.contribuyentes.balance',['id'=>$data['cliente_id'],'p'=>date('Y')]));
    }
    function listar_clientes(){
    	$user_id=Auth::user()->id;
    	$emp_id=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user_id."') AS empresa_id");
    	$emp_id=$emp_id[0]->empresa_id;
      $data=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_WEB_CLIENTES_TODOS('".$emp_id."','IRP');");
    
        return view('admin.irp.cargar_ingresos_para',['data'=>$data]);
    }

    function editar($id){
      $user=Auth::user()->id;
        $emp=DB::select("SELECT  FNC_DAME_EMPRESA_ID('".$user."') AS empresa_id");
        $emp=$emp[0]->empresa_id;
        $li=LibroIngresos::find($id);
        //dd($li);
          $cliente=DB::select("CALL PRO_VER_CONTRIBUYENTE('".$emp."','".$id."');");
          $contribuyentes=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_TODOS_MENOS('".$emp."','".$id."');");
        $contribuyentes_data=[];
        foreach ($contribuyentes as $node) {
          $contribuyentes_data[$node->id]=$node->contribuyente;
        }
        $tipo_doc=DB::select("CALL PRO_LISTAR_TIPO_DOC_INGRESO();");
        $tipo_doc_data=[];
        foreach ($tipo_doc as $node) {
          $tipo_doc_data[$node->codigo]=$node->desc;
        }
        $tipo_ingreso=DB::select("CALL PRO_LISTAR_TIPO_INGRESO();");
        $tipo_ingreso_data=[];
        foreach ($tipo_ingreso as $node) {
          $tipo_ingreso_data[$node->codigo]=$node->desc;
        }
        
         return view('admin.irp.editar_ingresos',['contribuyentes'=>$contribuyentes_data,'tipo_doc'=>$tipo_doc_data,'tipo_ingreso'=>$tipo_ingreso_data,'data'=>$li,'cliente'=>$cliente]);
    }

    function borrar($id){
        $data=LibroIngresos::find($id);

        $cliente= $data['cliente_id'];
        $data->destroy($id);
        return redirect(route('admin.contribuyentes.balance',['id'=>$cliente]));       
    }

}
