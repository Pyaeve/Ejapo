<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\LibroVentas;
use App\Contribuyentes;
use File;
use Carbon\Carbon;
class LibroVentasController extends Controller
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
    	
    	
    	return view('admin.iva.cargar_ventas',['cliente'=>$cliente,'contribuyentes'=>$contribuyentes_data,'empresa'=>$emp]);
    }

    function guardar(Request $req){

    	$data=$req->all();
        
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
      

        $lv=new LibroVentas();
        $lv->empresa_id=$data['empresa_id'];
        $lv->cliente_id=$data['cliente_id'];
        $lv->proveedor=$data['contribuyente'];
        $lv->ruc=$contribuyente_ruc;
        $lv->doc_tipo=1;
        $lv->doc_nro=$data['factura_nro'];
        $lv->fecha=$data['fecha'];
        $lv->gravadas_10=$data['total_gravadas_10'];
        $lv->gravadas_total_10=$data['total_gravadas_total_10'];
        $lv->gravadas_5=$data['total_gravadas_5'];
        $lv->gravadas_total_5=$data['total_gravadas_total_5'];
        $lv->total_exentas=$data['total_exentas'];
        $lv->total=$data['total_importe'];
        if($data['condicion']=='contado'){
            $lv->condicion_de_ventas=1;

        }elseif($data['condicion']=='credito'){
            $lv->condicion_de_ventas=2;
        }
        $lv->cuotas=$data['cuotas'];
        $lv->timbrado=$data['timbrado'];
        $lv->save();
        $url =route('admin.contribuyentes.balance.iva',['id'=>$data['cliente_id']]);
        $url .="?y=2020&m=05";
        return redirect($url);


    
    }

    function listar_clientes(){
          $user=Auth::user()->id;
        $emp=DB::select("SELECT  FNC_DAME_EMPRESA_ID('".$user."') AS empresa_id");
        $emp=$emp[0]->empresa_id;
      $data=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_WEB_CLIENTES_TODOS('".$emp."','IVA');");
    
        return view('admin.iva.cargar_ventas_para',['data'=>$data]);
    }

 function listar_clientes_importar(){
          $user=Auth::user()->id;
        $emp=DB::select("SELECT  FNC_DAME_EMPRESA_ID('".$user."') AS empresa_id");
        $emp=$emp[0]->empresa_id;
      $data=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_WEB_CLIENTES_TODOS('".$emp."','IVA');");
    
        return view('admin.iva.importar_ventas_para',['data'=>$data]);
    }
    function importar($id){   
        $user=Auth::user()->id;
        $emp=DB::select("SELECT  FNC_DAME_EMPRESA_ID('".$user."') AS empresa_id");
        $emp=$emp[0]->empresa_id;
        $es_cliente=DB::select("SELECT FNC_CONTRIBUYENTE_ES_CLIENTE('".$emp."','".$id."') AS es_cliente");
       
        $es_cliente=$es_cliente[0]->es_cliente;
        //si no es cliente los redireccionamso
        if($es_cliente=='No'){
            return redirect(route('admin.iva.importar.ventas.clientes'));
        }
        $cliente=DB::select("CALL PRO_VER_CONTRIBUYENTE('".$emp."','".$id."');");
            return view('admin.iva.importar_ventas',['cliente'=>$cliente,'empresa'=>$emp]);
    }
     function importar_txt(Request $req){

      /*      $contents = File::get(request()->file('file_importar_ventas'));
        dd($contents);*/
       // dd($req->all());
        $data=$req->all();

        $numlinea=1;
        $archivo = fopen(request()->file('file_importar_ventas'),'r');
        while ($linea = fgets($archivo)) {
            // echo $linea.'<br/>';
             $aux[] = explode("\t",$linea);    
             $numlinea++;
        }
         fclose($archivo);
         $detalle=[];
         foreach ($aux as $key => $value) {
            # code...
            if($key==0 ){
                continue;
            }
            $detalle[$key-1]=$value;
        }
        $cabecera=$aux[0];
        $cabecera;
        echo "Contribuyente: ".$cabecera[7]."<br>";
        echo "RUC: ".$cabecera[5]."-".$cabecera[6]."<br>";
        echo "A&ntilde;o: ".substr($cabecera[1], 0,4)."<br>";
        echo "Mes: ".substr($cabecera[1], -2)."<br>";
        echo "Cantidad de Registros: ".$cabecera[11]."<br>";
        echo "Importe total: ".$cabecera[12];
        /*$newDate=Carbon::createFromFormat('d/m/Y', $aux[1][6])->format('Y-m-d');
        echo "Fecha".$newDate;*/
        echo "<HR>";
        echo "<pre>";
      
        print_r($detalle);
        echo "</pre>";
       


    }
}
