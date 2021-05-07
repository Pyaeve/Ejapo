<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contribuyentes;
use App\Imports\ContribuyentesImport;
use DB;
use Auth;
use Excel;
use Carbon\Carbon;
class ContribuyentesController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }

	 function cargar(){
	 	$user_id=Auth::user()->id;
    	$emp_id=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user_id."') AS empresa_id");
    	$emp_id=$emp_id[0]->empresa_id;
	 	//
	 	$tipo_doc_data = DB::select('CALL PRO_LISTAR_TIPO_DOC_IDENT();');
	 	$tipo_doc_array=array();

	 	foreach ($tipo_doc_data as $node) {
	 		$tipo_doc_array[$node->id]=$node->desc;
	 	}

	 	//dd($tipo_doc_array);
    	return view('admin.contribuyentes.cargar',['tipo_doc_data'=>$tipo_doc_array,'empresa'=>$emp_id]);
   

    }

    function guardar(Request $req){

    	$data=$req->all();
    	//dd($data);
    	$cont=new Contribuyentes();
    	if ($req->has('cliente')) {
   			$cont->cliente=1;
		}else{
			$cont->cliente=0;
		}

		if ($req->has('exportador')) {
   			$cont->exportador=1;
		}else{
			$cont->exportador=0;
		}
        if($data['regimen']==1){
            $cont->regimen = "IRP";
        }elseif($data['regimen']==2){
            $cont->regimen = "IVA";
        }
		$cont->empresa_id=$data['empresa_id'];
		$cont->tipo_contribuyente=$data['tipo_contribuyente'];
        $cont->desc=$data['desc'];
		$cont->tipo_doc_id=$data['tipo_doc'];
		$cont->tipo_doc_id_codigo=$data['nro_doc'];
		$cont->cel=$data['tel'];
		$cont->email=$data['email'];
		$cont->direccion=$data['direccion'];
		$cont->barrio=$data['barrio'];
		$cont->ciudad=$data['ciudad'];
		$cont->timbrado_codigo=$data['timbrado_codigo'];
		$cont->timbrado_fin=$data['timbrado_fin'];
		$cont->timbrado_inicio=$data['timbrado_inicio'];
		$cont->save();	
        return redirect(route('admin.contribuyentes.resumen'));
    }

    
    function actualizar(Request $req){

    	$data=$req->all();
    	//dd($data);
    	$cont= Contribuyentes::findOrFail($data['id']);
    	if ($req->has('cliente')) {
   			$cont->cliente=1;
            $cont->regimen=$data['regimen'];
		}else{
			$cont->cliente=0;
            $cont->regimen='ALL';
		}

		if ($req->has('exportador')) {
   			$cont->exportador=1;

		}else{
			$cont->exportador=0;
		}
		$cont->tipo_contribuyente=$data['tipo_contribuyente'];
		if($data['tipo_contribuyente']=='1'){
			$cont->desc='';
			$cont->nombre=$data['nombre'];
			$cont->apellido=$data['apellido'];
		}else{
			$cont->desc=$data['desc'];
			$cont->nombre='';
			$cont->apellido='';
		}

		$cont->tipo_doc_id=$data['tipo_doc'];
		$cont->tipo_doc_id_codigo=$data['nro_doc'];
		$cont->cel=$data['tel'];
		$cont->email=$data['email'];
		$cont->direccion=$data['direccion'];
		$cont->barrio=$data['barrio'];
		$cont->ciudad=$data['ciudad'];
		$cont->timbrado_codigo=$data['timbrado_codigo'];
		$cont->timbrado_fin=$data['timbrado_fin'];
		$cont->timbrado_inicio=$data['timbrado_inicio'];
		$cont->update();	
        return redirect(route('admin.contribuyentes.resumen'));
    }

    function resumen(){
    	//$data=Contribuyentes::all();
    	$user_id=Auth::user()->id;
    	$emp_id=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user_id."') AS empresa_id");
    	$emp_id=$emp_id[0]->empresa_id;
    	//$data1=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_WEB_FISICOS('".$emp_id."','Todos');");
         $data1=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_WEB_CLIENTES_TODOS('".$emp_id."','Todos');");
		$data2=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_WEB_NO_CLIENTES_TODOS('".$emp_id."','Todos');");
    	return view('admin.contribuyentes.resumen_clientes',['data1'=>$data1,'data2'=>$data2]);
    }
function resumen_clientes(){
        //$data=Contribuyentes::all();      
        $user_id=Auth::user()->id;
        $emp_id=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user_id."') AS empresa_id");
        $emp_id=$emp_id[0]->empresa_id;
        $data1=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_WEB_CLIENTES_TODOS('1', 'Todos')('".$emp_id."','Todos');");
        $data2=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_WEB_JURIDICOS('".$emp_id."','Todos');");
        $data3=DB::select("CALL PRO_LISTAR_CONTRIBUYENTES_WEB_FISICOS('".$emp_id."','Todos');");
        return view('admin.contribuyentes.resumen_clientes',['todos'=>$data1,'fisicos'=>$data2,'juridicos'=>$data2]);
    }

    function ajax_ruc($id){
    	$data=DB::select("SELECT FNC_DAME_RUC('".$id."') AS RUC;");
    	return $data[0]->RUC;
    }

    function ajax_timbrado($id){
    	$data=DB::select("SELECT FNC_DAME_TIMBRADO('".$id."') AS TIMBRADO;");
    	return $data[0]->TIMBRADO;
    }

 function ajax_borrar($id){
      
        $data=Contribuyentes::findOrFail($id);
       
        $data->destroy($id);
        return "Ok";
    }

    function editar($id){
    	$data=Contribuyentes::findOrFail($id);
       $regimen= DB::select('CALL PRO_LISTART_REGIMEN_TRIBUTARIO();');

           	$tipo_doc_data = DB::select('CALL PRO_LISTAR_TIPO_DOC_IDENT();');
	 	$tipo_doc_array=array();

	 	foreach ($tipo_doc_data as $node) {
	 		$tipo_doc_array[$node->id]=$node->desc;
	 	}
        $regimen_data=[];
        foreach ($regimen as $node) {
            # code...
             $regimen_data[$node->codigo]=$node->codigo." - ".$node->desc;
        }
     
    	return view('admin.contribuyentes.editar',['data'=>$data,'tipo_doc_data'=>$tipo_doc_array, 'regimen'=>$regimen_data]);
    }

    function borrar($id){
    	$data=Contribuyentes::findOrFail($id);
    	$data->destroy();
    	return redirect(route('admin.contribuyentes.resumen'));
    }

    function balance($id){
   		//dd($_GET);
   		if(!isset($_GET['p']) or empty($_GET['p'])){
   			$_GET['p']=date('Y');
   		}
    	$egresos=DB::select("CALL PRO_VER_RESUMEN_EGRESOS('".$_GET['p']."','".$id."')");
    	$egresos_total=DB::select("SELECT FNC_DAME_EGRESO_TOTAL('".$_GET['p']."','".$id."') AS total");
    	$egresos_total=$egresos_total[0]->total;
    	$ingresos=DB::select("CALL PRO_VER_RESUMEN_INGRESOS('".$_GET['p']."','".$id."')");
    	$ingresos_total=DB::select("SELECT IFNULL(FNC_DAME_INGRESO_TOTAL('".$_GET['p']."','".$id."'),'0') AS total");
       
    	$ingresos_total=$ingresos_total[0]->total;
    	$user_id=Auth::user()->id;
    	$emp_id=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user_id."') AS empresa_id");
    	$emp_id=$emp_id[0]->empresa_id;
    	$contribuyente=DB::select("CALL PRO_VER_CONTRIBUYENTE('".$emp_id."','".$id."')");
    	//dd($contribuyente);
    	$total=($ingresos_total-$egresos_total);
    	$impuesto=($total*8)/100;
    	    	return view('admin.contribuyentes.balance',
    								['contribuyente'=>$contribuyente,
    								'ingresos'=>$ingresos,
    								'egresos'=>$egresos,
    								'egresos_total'=>$egresos_total,
    								'ingresos_total'=>$ingresos_total,
    								'total'=>$total,
    								'impuesto'=>$impuesto]);
    }

  function balanceIVA($id){
        //dd($_GET);
      
          $user_id=Auth::user()->id;
        $emp_id=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user_id."') AS empresa_id");
        $emp_id=$emp_id[0]->empresa_id;
        $dt = Carbon::now();
        $dt->year = $_GET['y'];
        $dt->month = $_GET['m'];             // would force year++ and month = 1

        $dt->day = 1;
        $f2="";
        $f1=$_GET['y']."-".$_GET['m']."-01";
      
                # code...
        $f2=$_GET['y']."-".$_GET['m']."-".$dt->daysInMonth;
         
        $compras=DB::select("CALL PRO_VER_RESUMEN_COMPRAS('".$emp_id."','".$id."','".$f1."','".$f2."')");
       // dd($compras);
        $compras_total=DB::select("SELECT FNC_DAME_COMPRAS_TOTAL('".$emp_id."','".$id."','".$f1."','".$f2."') AS total");
        $compras_total=$compras_total[0]->total;
        $ventas=DB::select("CALL PRO_VER_RESUMEN_VENTAS('".$emp_id."','".$id."','".$f1."','".$f2."');");
        $ventas_total=DB::select("SELECT FNC_DAME_VENTAS_TOTAL('".$emp_id."','".$id."','".$f1."','".$f2."') AS total");
        $ventas_total=$ventas_total[0]->total;
      
        $contribuyente=DB::select("CALL PRO_VER_CONTRIBUYENTE('".$emp_id."','".$id."')");
        //dd($contribuyente);
        $total=($ventas_total-$compras_total);
        $impuesto=($total*10)/100;
                return view('admin.contribuyentes.balance_iva',
                                    ['contribuyente'=>$contribuyente,
                                    'empresa'=>$emp_id,
                                    'ventas'=>$ventas,
                                    'compras'=>$compras,
                                    'compras_total'=>$compras_total,
                                    'ventas_total'=>$ventas_total,
                                    'total'=>$total,
                                    'impuesto'=>$impuesto]);
    }

    function Calcular_DV($ruc){

        $tl=strlen($ruc);
        $k= $tl+1;
       // dd($k);
        $l=0;
        $dv=0;
        $t=0;
        $_ruc=str_split($ruc);

        while ( $l<$tl) {
           
            $t+=($_ruc[$l]*$k);
            $k--;
          
            $l++;  
        }
        
        $dv=($t%11);
       if($dv>1){
            $dv=11- $dv;
        }else{
            $dv=0;
        }
       
        return $ruc."-".$dv;
    }

    function importar_contribuyentes(){
            return view('admin.contribuyentes.importar');
    }
    function importar_contribuyentes_excel(Request $req){
        $user_id=Auth::user()->id;
        $emp_id=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user_id."') AS empresa_id");
        $emp_id=$emp_id[0]->empresa_id;
        //
           $array = (new ContribuyentesImport)->toArray(request()->file('file_importar_contribuyentes'));
       $data=[];
        foreach ($array[0] as $key => $value) {
            # code...
            if($key==0 or $key==1){
                continue;
            }
            $data[$key-2]=$value;
        }
                    echo count($data)." Registros<br>";
                    $reg=0;
                 
                    $reg_duplicados_total=0;

       foreach ($data as $row) {
            # code...
            
               $ya_existe=DB::select("SELECT FNC_CONTRIBUYENTE_EXISTE('".$emp_id."','".$row[1]."') AS existe;");
               if($ya_existe=='Si'){
                    $reg_duplicados_total++;
                    continue;
               }
               /* if($this->Calcular_DV($row[1])!=$row[1]){
                     $reg_error[$reg+2]=$row[1].' | '.$row[1];
                    continue;
                }*/
                $contribuyentes=new Contribuyentes();
                $contribuyentes->empresa_id=$emp_id;
                $contribuyentes->desc=$row[0];
                $contribuyentes->tipo_doc_id=2;
                 $contribuyentes->tipo_doc_id_codigo=$row[1];
                 $contribuyentes->regimen=$row[3];
                 if($row[2]=='F' ){
                        $contribuyentes->tipo_contribuyente=1;
                 }elseif ($row[2]=='J') {
                     # code...
                        $contribuyentes->tipo_contribuyente=2;

                 }
                 if($row[4]=='S'){
                        $contribuyentes->cliente=1;
                 }elseif ($row[4]=='N') {
                     # code...
                        $contribuyentes->cliente=0;

                 }
                $contribuyentes->save();
                $reg++;
               
        } 
        echo $reg_duplicados_total." Duplicados <br>";
       
        die("<a href='".route('admin.contribuyentes.resumen')."'>Ver Contrbuyentes</a>");
        //return redirect(route('admin.contribuyentes.resumen'));
    }
}
    