<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Auth;
class ArandukaController extends Controller
{
    //
    function mostrar(){
    	return view('admin.iva.mostrar_aranduka');
    }
    

    public function exportar($ci,$pe){
      $user_id=Auth::user()->id;
      $emp_id=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user_id."') AS empresa_id");
      $emp_id=$emp_id[0]->empresa_id;
      File::delete(File::glob(public_path('aranduka*.json')));
      $ruc=DB::select("SELECT FNC_DAME_RUC('".$ci."') AS ruc");
      $ruc=$ruc[0]->ruc;
      $ruc=explode("-", $ruc);
      $ingresos=DB::select("CALL PRO_VER_INGRESOS('".$pe."','".$ci."');");
      $egresos=DB::select("CALL PRO_VER_EGRESOS('".$pe."','".$ci."');");
      $aranduka=[];
      $aranduka['informante']['ruc']=$ruc[0];
      $aranduka['identificacion']['periodo']=$pe;
      $aranduka['ingresos']=$ingresos;
      $aranduka['egresos']=$egresos;
      $aranduka['familiares']=[];
      $data=json_encode($aranduka);
      $file="aranduka_".$emp_id."_".$ci."_".time()."_" .rand(). '.json';
      $destinationPath=public_path().'/';
      File::put($destinationPath.$file,$data);

      return response()->download($destinationPath.$file);
    

   }
   public function exportar_aranduka_form(){
        $user_id=Auth::user()->id;
        $emp_id=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user_id."') AS empresa_id");
        $emp_id=$emp_id[0]->empresa_id;
       
        $clientes=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_WEB_CLIENTES_TODOS('".$emp_id."','irp')");
       $clientes_data=[];
       foreach ($clientes as $node) {
       	# code...$
       		$clientes_data[$node->ID]=$node->NRODOC.' | '.$node->CONTRIBUYENTE;
       }
     	return view('admin.irp.exportar_aranduka',['clientes'=>$clientes_data,'empresa'=>$emp_id]);
    

   }
   public function exportar_aranduka_procesar(Request $req){
    	$data=$req->all();
    	dd($data);
    

   }
}
