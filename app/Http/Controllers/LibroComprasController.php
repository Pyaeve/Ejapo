<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Contribuyentes;
use App\LibroCompras;

class LibroComprasController extends Controller
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
            return redirect(route('admin.iva.ventas.clientes'));
        }
        $cliente=DB::select("CALL PRO_VER_CONTRIBUYENTE('".$emp."','".$id."');");
        $contribuyentes=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_TODOS_MENOS('".$emp."','".$id."');");
        $contribuyentes_data=[];
        foreach ($contribuyentes as $node) {

            $contribuyentes_data[$node->id]=$node->contribuyente;

        }
        
        
        return view('admin.iva.cargar_compras',['cliente'=>$cliente,'contribuyentes'=>$contribuyentes_data,'empresa'=>$emp]);
    }

    function guardar(Request $req){

    	$data=$req->all();
    	//dd($data);
        $data=$req->all();
        $rel_ruc=DB::select("SELECT FNC_DAME_RUC('".$data['contribuyente']."') AS 'rel_ruc'");
        $rel_ruc= $rel_ruc[0]->rel_ruc;
        $rel_nombre=DB::select("SELECT FNC_DAME_CONTRIBUYENTE_NOMBRE('".$data['contribuyente']."') AS 'rel_nombre'");
        //dd($data);
        $cliente=Contribuyentes::find($data['cliente_id']);
        if(is_null($cliente->timbrado_codigo)){
                $cliente->timbrado_codigo=$data['timbrado'];
                $cliente->update();
        }
        $contribuyente_ruc=DB::select("SELECT FNC_DAME_RUC('".$data['contribuyente']."') AS ruc;");
        $contribuyente_ruc=$contribuyente_ruc[0]->ruc;
       
        $contribuyente_desc=DB::select("SELECT FNC_DAME_CONTRIBUYENTE_NOMBRE('".$data['contribuyente']."') AS contribuyente;");
         $contribuyente_desc= $contribuyente_desc[0]->contribuyente;
      

        $lc=new LibroCompras();
        $lc->empresa_id=$data['empresa_id'];
        $lc->cliente_id=$data['cliente_id'];
        $lc->contribuyente=$data['contribuyente'];
        $lc->ruc=$contribuyente_ruc;
        $lc->doc_tipo=1;
        $lc->doc_nro=$data['factura_nro'];
        $lc->fecha=$data['fecha'];
        $lc->gravadas_10=$data['total_gravadas_10'];
        $lc->gravadas_total_10=$data['total_gravadas_total_10'];
        $lc->gravadas_5=$data['total_gravadas_5'];
        $lc->gravadas_total_5=$data['total_gravadas_total_5'];
        $lc->total_exentas=$data['total_exentas'];
        $lc->total=intval($data['total_gravadas_10'])+intval($data['total_gravadas_5'])+intval($data['total_exentas']);
        if($data['condicion']=='contado'){
            $lc->condicion_compras=1;

        }elseif($data['condicion']=='credito'){
            $lc->condicion_compras=2;
        }
        $lc->tipo_operacion=0;
        $lc->cuotas=$data['cuotas'];
        $lc->timbrado=$data['timbrado'];
        $lc->save();
        return redirect(route('admin.contribuyentes.balance.iva',['id'=>$data['cliente_id']]));



    }
       function listar_clientes(){
          $user=Auth::user()->id;
        $emp=DB::select("SELECT  FNC_DAME_EMPRESA_ID('".$user."') AS empresa_id");
        $emp=$emp[0]->empresa_id;
      $data=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_WEB_CLIENTES_TODOS('".$emp."','IVA');");
    
        return view('admin.iva.cargar_compras_para',['data'=>$data]);
    }
}
