<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use  Carbon\Carbon;
use File;
class HechaukaController extends Controller
{
    //

    function mostrar(){

    	return view('admin.iva.mostrar_hechauka');

    }

    function exportar($id){

    //dd($id);
      
          $user_id=Auth::user()->id;
        $emp_id=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user_id."') AS empresa_id");
        $emp_id=$emp_id[0]->empresa_id;
       
         $cliente=DB::select("CALL PRO_VER_CONTRIBUYENTE('".$emp_id."','".$id."')");
        //dd($contribuyente);
      
                return view('admin.iva.exportar_hechauka',
                                    ['cliente'=>$cliente,
                                    'empresa'=>$emp_id,
                                 ]);
    }

    

    

    function exportar_hechauka(Request $req){
        File::delete(File::glob(public_path().'/hechauka*.json'));
    		$data=$req->all();
    		
                 $dt = Carbon::now();
        $dt->year = $data['y'];
        $dt->month = $data['m'];             // would force year++ and month = 1

        $dt->day = 1;
        $f2="";
        $f1=$data['y']."-".$data['m']."-01";
      
                # code...
        $f2=$data['y']."-".$data['m']."-".$dt->daysInMonth;
        
        $ruc=DB::select("SELECT FNC_DAME_RUC('".$data['cliente_id']."') AS ruc");
        $ruc=$ruc[0]->ruc;
         $cliente=DB::select("CALL PRO_VER_CONTRIBUYENTE('".$data['empresa_id']."','".$data['cliente_id']."')");
        $ruc=explode("-", $ruc);
     
       
        
        $tipo="1";
        $obligacion="921";
        $form="221";
        if($data['ddjj']=='Original'){
             $tipo="1";
        }elseif ($data['ddjj']=='Rectificacion') {
            # code...
             $tipo="1";
        }
        if($data['libro']=='Ventas'){
            $obligacion="921";
            $form="221";
            $detalle=DB::select("CALL PRO_HECHAUKA_VENTAS_DETALLES('".$data['empresa_id']."','".$data['cliente_id']."','".$f1."','".$f2."');");
            $regs=count($detalle);
            $total=0;
            foreach ($detalle as $node) {
            # code...
              $total+=$node->total;
            }
             $txt="1\t".$data['y'].$data['m']."\t".$tipo."\t".$obligacion."\t".$form."\t".$ruc[0]."\t".$ruc[1]."\t".$cliente[0]->CONTRIBUYENTE."\t0\t0\t0\t".$regs."\t".$total."\t2\r\n";
             foreach ($detalle as $node) {
            # code...
                $txt.=$node->TipoReg."\t";
                $txt.=$node->RUC."\t";
                $txt.=$node->DV."\t";
                $txt.=$node->Proveedor."\t";
                $txt.=$node->doc_tipo."\t";
                $txt.=$node->doc_nro."\t";
                $txt.=Carbon::createFromFormat('Y-m-d', $node->fecha)->format('d/m/Y')."\t";
                $txt.=$node->gravadas_10."\t";
                $txt.=$node->gravadas_total_10."\t";
                $txt.=$node->gravadas_5."\t";
                $txt.=$node->gravadas_total_5."\t";
                $txt.=$node->total_exentas."\t";
                $txt.=$node->total."\t";
                $txt.=$node->condicion_de_ventas."\t";
                $txt.=$node->cuotas."\t";
                $txt.=$node->timbrado."\r\n";
              
            }
            $file="hechauka_libro_ventas_".$data['empresa_id']."_".$data['cliente_id']."_".time()."_" .rand(). '.txt';
        }elseif ($data['libro']=='Compras') {
            # code...
            $obligacion="911";
            $form="211";
            $detalle=DB::select("CALL PRO_HECHAUKA_COMPRAS_DETALLES('".$data['empresa_id']."','".$data['cliente_id']."','".$f1."','".$f2."');");
             $regs=count($detalle);
            $total=0;
            foreach ($detalle as $node) {
            # code...
              $total+=$node->total;
            }
             $txt="1\t".$data['y'].$data['m']."\t".$tipo."\t".$obligacion."\t".$form."\t".$ruc[0]."\t".$ruc[1]."\t".$cliente[0]->CONTRIBUYENTE."\t0\t0\t0\t".$regs."\t".$total."\tNo\t2\r\n";
             foreach ($detalle as $node) {
            # code...
                  $txt.=$node->TipoReg."\t";
                $txt.=$node->ruc."\t";
                $txt.=$node->dv."\t";
                $txt.=$node->Proveedor."\t";
                $txt.=$node->timbrado."\t";
                $txt.=$node->doc_tipo."\t";
                $txt.=$node->doc_nro."\t";
                $txt.=Carbon::createFromFormat('Y-m-d', $node->fecha)->format('d/m/Y')."\t";
                $txt.=$node->gravadas_10."\t";
                $txt.=$node->gravadas_total_10."\t";
                $txt.=$node->gravadas_5."\t";
                $txt.=$node->gravadas_total_5."\t";
                $txt.=$node->exentas."\t";
                $txt.="0\t";
                $txt.=$node->condicion."\t";
                $txt.=$node->cuotas."\r\n";
              
            }
            $file="hechauka_libro_compras_".$data['empresa_id']."_".$data['cliente_id']."_".time()."_" .rand(). '.txt';
        }
      
        $destinationPath=public_path().'/';
      File::put($destinationPath.$file,$txt);

      return response()->download($destinationPath.$file);

    }


}
