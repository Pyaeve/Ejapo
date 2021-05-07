<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Empresas;
use App\EmpresasUsuarios;
use App\Contribuyentes;
use DB;
use Auth;
use Hash;
use Mail;
class EmpresasController extends Controller
{
    //
     function cargar(){

	 
		$tipo_doc_data = DB::select('CALL PRO_LISTAR_TIPO_DOC_IDENT();');
	 	$tipo_doc_array=array();

	 	foreach ($tipo_doc_data as $node) {
	 		$tipo_doc_array[$node->id]=$node->desc;
	 	}

	 	//dd($tipo_doc_array);
    	return view('admin.empresas.cargar',['tipo_doc_data'=>$tipo_doc_array]);
   

    }

     function guardar(Request $req){

    	$data=$req->all();
    	//dd($data);
    	$emp=new Empresas();
    	
		if ($req->has('exportador')) {
   			$emp->exportador=1;

		}else{
			$emp->exportador=0;
		}
		
		$emp->desc=$data['desc'];
		$emp->tipo_doc_id=$data['tipo_doc'];
		$emp->tipo_doc_id_codigo=$data['nro_doc'];
		$emp->cel=$data['tel'];
		$emp->email=$data['email'];
		$emp->direccion=$data['direccion'];
		$emp->barrio=$data['barrio'];
		$emp->ciudad=$data['ciudad'];
		$emp->timbrado_codigo=$data['timbrado_codigo'];
		$emp->timbrado_fin=$data['timbrado_fin'];
		$emp->timbrado_inicio=$data['timbrado_inicio'];
		$emp->save();	

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
		$cont->tipo_contribuyente=2;
		$cont->desc=$data['desc'];
		$cont->empresa_id=$emp->id;
		$cont->nombre='';
		$cont->apellido='';
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

        $eu = new EmpresasUsuarios();
        $eu->empresa_id=$emp->id;
      	$eu->user_id=Auth::user()->id;
      	$eu->save();
        return redirect(route('admin.empresas.ver',['id'=>$emp->id]));
    }
    function ver($id){

    	$data=DB::select("CALL PRO_VER_EMPRESA('".$id."');");
    	//dd($data);
        return view('admin.empresas.ver',['data'=>$data[0]]);

    }
    function resumen(){
    	//$data=Contribuyentes::all();
    
		$data=DB::select('CALL PRO_LISTAR_EMPRESAS();');
    	return view('admin.empresas.resumen',['data'=>$data]);
    }

  function form_registro(){

  	return view('frontend.empresas.form_registro');
  }

  function registrar(Request $req){
  		$req->validate([
            'name' => 'required|string|max:255',
            'sername' => 'required|string|max:255',
            'empresa'=>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    
    	$data=$req->all();
    	$emp=new Empresas();
    	$emp->desc=$data['empresa'];
    	$emp->save();
      $data['activation_code']=str_random(20);
      $user=User::create([
            'name' => $data['name'],
            'sername' => $data['sername'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'password_text'=>$data['password'],
            'activation_code'=>$data['activation_code'],
            'activation_status'=>0
        ]);
        $user->assignRole('Contador');
        EmpresasUsuarios::create(['empresa_id'=>$emp->id,'user_id'=>$user->id]);
      
      Mail::send('emails.activation_code', $data, function($message) use ($data) {
        $message->to($data['email'], $data['name'])->subject('Por favor confirma tu correo');
    });
        return redirect('/');
    	
  }

  function confirmar_registro($code){
     $user = User::where('activation_code', $code)->first();

    if (! $user)
        return redirect('/');

    $user->activation_status = 1;
    $user->activation_code = null;
    $user->save();
    
      Mail::send('emails.activation_status_ok', $data, function($message) use ($data) {
        $message->to($user->email, $user->name)->subject($user->name.' Gracias Por favor confirmar tu registr');
    });
    return redirect('/admin/home')->with('notification', 'Has confirmado correctamente tu correo!');
  }

    

}
