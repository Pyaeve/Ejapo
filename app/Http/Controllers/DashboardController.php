<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use  DB;
use File;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DashboardController extends Controller
{
    //

    function hom2e(){

    	/*$user=User::find(1);

    	$role = Role::create(['name'=>'Admin']);
    	$perm =Permission::create(['name' => 'cargar_contribuyente']);
    	$role->givePermissionTo('cargar_contribuyente');
    	$perm =Permission::create(['name' => 'editar_contribuyente']);
    	$role->givePermissionTo('editar_contribuyente');
    	$perm =Permission::create(['name' => 'borrar_contribuyente']);
    	$role->givePermissionTo('borrar_contribuyente');
    	$perm =Permission::create(['name' => 'listar_contribuyente']);
    	$role->givePermissionTo('listar_contribuyente');
    	$user->assignRole('Admin');*/
    	return view('admin.dashboard.home');
    }


    function resumen(){

            $data=DB::select('CALL PRO_LISTAR_CONTRIBUYENTES_WEB_FISICOS();');

            foreach ($data as $node) {
                # code...

            }
    }

  
    public function home(){

        
       $ingresos=DB::select('CALL PRO_VER_INGRESOS();');
        $aranduka=[];
     

    $aranduka['ingresos']=$ingresos;
    $data = json_encode($aranduka);

 $file = "aranduka_".time() .rand(). '.json';
      $destinationPath=public_path().'/';
      
      File::put($destinationPath.$file,$data);
      return response()->download($destinationPath.$file);
    

    
    }

    function panel_principal(){

        $user_id=Auth::user()->id;
        $emp_id=DB::select("SELECT FNC_DAME_EMPRESA_ID('".$user_id."') AS empresa_id");
        $emp_id=$emp_id[0]->empresa_id;
        $total_clientes=DB::select("SELECT FNC_DAME_TOTAL_CLIENTES('".$emp_id."','todos','todos') AS total");
        $total_clientes=$total_clientes[0]->total;
        $total_clientes_fisicos=DB::select("SELECT FNC_DAME_TOTAL_CLIENTES('".$emp_id."','f','todos') AS total");
        $total_clientes_fisicos=$total_clientes_fisicos[0]->total;
        $total_clientes_juridicos=DB::select("SELECT FNC_DAME_TOTAL_CLIENTES('".$emp_id."','j','todos') AS total");
        $total_clientes_juridicos=$total_clientes_juridicos[0]->total;
        $total_clientes_iva=DB::select("SELECT FNC_DAME_TOTAL_CLIENTES('".$emp_id."','todos','iva') AS total");
        $total_clientes_irp=$total_clientes_iva[0]->total;
        $total_clientes_irp=DB::select("SELECT FNC_DAME_TOTAL_CLIENTES('".$emp_id."','fisicos','irp') AS total");
        $total_clientes_irp=$total_clientes_irp[0]->total;
        return view('admin.panel.home',['total_clientes'=>$total_clientes,
                                    'total_clientes_fisicos'=>$total_clientes_fisicos,
                                    'total_clientes_juridicos'=>$total_clientes_juridicos,
                                    'total_clientes_iva'=>$total_clientes_iva,
                                    'total_clientes_irp'=>$total_clientes_irp]);
    }
}
