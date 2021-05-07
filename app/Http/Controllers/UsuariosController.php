<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\EmpresasUsuarios;
use DB;
use Auth;
class UsuariosController extends Controller
{
    //
    function cargar(){

        $user=User::findOrFail(Auth::user()->id);

        if($user->hasRole('Developer')){
    	   $roles=Role::all();
    	   $roles_data=[];
    	       foreach ($roles as $rol) {
    		      $roles_data[$rol->name]=$rol->name;
    	       }

        }elseif ($user->hasRole('Admin')) {
             $roles=Role::all();
            $roles_data=[];
               foreach ($roles as $rol) {
                  $roles_data[$rol->name]=$rol->name;
               }
        }  elseif ($user->hasRole('Contador')) {
             $roles=Role::all();
            $roles_data=[];
               foreach ($roles as $rol) {
                  $roles_data[$rol->name]=$rol->name;
               }
        

       } else{
            $roles_data['4']='Colaborador';
        }
        $user=Auth::user()->id;
        $emp=DB::select("select FNC_DAME_EMPRESA_ID('".$user."') AS empresa ");
    	return view('admin.usuarios.cargar',['roles'=>$roles_data,'empresa'=>$emp[0]->empresa]);
    }

    function editar($id){

    	$roles=Role::all();
    	$roles_data=[];
    	foreach ($roles as $rol) {
    		$roles_data[$rol->name]=$rol->name;
    	}
    	$data=User::findOrFail($id);
    	$rol=$data->roles;
    	
    	return view('admin.usuarios.editar',['roles'=>$roles_data,'data'=>$data,'rol'=>$rol[0]]);
    }
    
    function guardar(Request $req){
    	$req->validate([
            'name' => 'required|string|max:255',
            'sername' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    
    	$data=$req->all();
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
    	$user->assignRole($data['role']);
        EmpresasUsuarios::create(['empresa_id'=>$data['empresa_id'],'user_id'=>$user->id]);
    	return redirect(route('admin.usuarios.resumen'));
    }

    function actualizar(Request $req){
    	$req->validate([
            'name' => 'required|string|max:255',
            'sername' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            
        ]);
    
    	$data=$req->all();
    	$user=User::findOrFail($data['id']);
    	$rol=$data->roles;
    	$user->removeRole($rol[0]->name);
    	$user->update();
    	$user->name=$data['name'];
    	$user->sername=$data['sername'];
    	$user->email=$data['email'];
    	$user->update();
    	$user->assignRole($data['role']);
    	$user->update();
    	return redirect(route('admin.usuarios.resumen'));
    }

    function resumen(){
        $user=Auth::user()->id;
        $emp=DB::select("select FNC_DAME_EMPRESA_ID('".$user."') AS empresa ");
        $emp=$emp[0]->empresa;
    	$data=DB::select("CALL PRO_LISTAR_COLABORADORES('".$emp."');");
    	dd($data);
    }

    function perfil(){
         $user=Auth::user();
         return view('admin.usuarios.perfil',['data'=>$user]);
    }

    
}
