<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use Menu;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */ 
    public function handle($request, Closure $next)
    {

        if (Auth::check()){
             $user=User::findOrFail(Auth::user()->id);

        if($user->hasRole('Admin')){
            Menu::make('BackeckAdminNavBar', function ($menu) {
                 $menu->add('Empresas','#')->prepend('<span class="fa fa-users"></span> ');
                 $menu->empresas->add('Cargar ', route('admin.empresas.cargar'));
                  $menu->empresas->add('Resumen ', route('admin.empresas.resumen'));
                 $menu->add('Usuarios', '#');
                 $menu->usuarios->add('Cargar ', route('admin.usuarios.cargar'));
                 $menu->usuarios->add('Resumen ', route('admin.usuarios.resumen'));
                 $menu->add('Contribuyentes', '#');
                 $menu->contribuyentes->add('Cargar ', route('admin.contribuyentes.cargar'));
                 $menu->contribuyentes->add('Importar ', route('admin.contribuyentes.importar'));
                 $menu->contribuyentes->add('Resumen ', route('admin.contribuyentes.resumen'));
                 $menu->add('Familiares', '#');
                 $menu->familiares->add('Cargar ', route('admin.familiares.clientes'));
                
                 $menu->add('Iva', '#');
                 $menu->iva->add('Cargar Compras', route('admin.iva.compras.clientes'));
                 $menu->iva->add('Cargar Ventas', route('admin.iva.ventas.clientes'));
                  $menu->iva->add('Importar Ventas', route('admin.iva.importar.ventas.clientes'));
                 $menu->add('Irp', '#');
                 $menu->irp->add('Cargar Ingresos', route('admin.irp.ingresos.clientes'));
                 $menu->irp->add('Cargar Egresos', '#');
            });

        }elseif($user->hasRole('Developer')){
             Menu::make('BackeckAdminNavBar', function ($menu) {
                 $menu->add('Empresas','#')->prepend('<span class="fa fa-briefcase"></span> ');
                 $menu->empresas->add('Cargar ', route('admin.empresas.cargar'))->prepend('<span class="fa fa-plus"></span> ');
                  $menu->empresas->add('Resumen ', route('admin.empresas.resumen'));
                 $menu->add('Usuarios', '#')->prepend('<span class="fa fa-users"></span> ');
                 $menu->usuarios->add('Cargar ', route('admin.usuarios.cargar'))->prepend('<span class="fa fa-plus"></span> ');
                 $menu->usuarios->add('Resumen ', route('admin.usuarios.resumen'))->prepend('<span class="fa fa-list"></span> ');
                 $menu->add('Contribuyentes', '#')->prepend('<span class="fa fa-users"></span> ');
                 $menu->contribuyentes->add('Cargar ', route('admin.contribuyentes.cargar'))->prepend('<span class="fa fa-plus"></span> ');
                    $menu->contribuyentes->add('Importar ', route('admin.contribuyentes.importar'))->prepend('<span class="fa fa-cloud-upload"></span> ');
                 $menu->contribuyentes->add('Resumen ', route('admin.contribuyentes.resumen'))->prepend('<span class="fa fa-list"></span> ');
                 $menu->add('Familiares', ['url'=>'#','parent'=>$menu->contribuyentes->id]);
                 $menu->familiares->add('Cargar ', route('admin.familiares.clientes'))->prepend('<span class="fa fa-plus"></span> ');
                
                 $menu->add('Iva', '#')->prepend('<span class="fa fa-book"></span> ');
                 $menu->iva->add('Cargar Compras', route('admin.iva.compras.clientes'))->prepend('<span class="fa fa-plus"></span> ');
                 $menu->iva->add('Cargar Ventas', route('admin.iva.ventas.clientes'))->prepend('<span class="fa fa-plus"></span> ');
                $menu->iva->add('Importar desde Hechauka', route('admin.iva.importar.ventas.clientes'))->prepend('<span class="fa fa-cloud-upload"></span> ');
                 $menu->iva->add('Exportar a Hechauka', '#')->prepend('<span class="fa fa-cloud-download"></span> ');
                 $menu->add('Irp', '#')->prepend('<span class="fa fa-book"></span> ');
                 $menu->irp->add('Cargar Ingresos', route('admin.irp.ingresos.clientes'))->prepend('<span class="fa fa-plus"></span> ');
                 $menu->irp->add('Cargar Egresos', route('admin.irp.egresos.clientes'))->prepend('<span class="fa fa-plus"></span> ');
            });
        }elseif($user->hasRole('Contador')){
            Menu::make('BackeckAdminNavBar', function ($menu) {
                 $menu->add('Colaboradores', '#');
                 $menu->colaboradores->add('Cargar ', route('admin.usuarios.cargar'));
                 $menu->colaboradores->add('Resumen ', route('admin.usuarios.resumen'));
                 $menu->add('Contribuyentes', '#');
                 $menu->contribuyentes->add('Cargar ', route('admin.contribuyentes.cargar'));
                    $menu->contribuyentes->add('Importar ', route('admin.contribuyentes.importar'));
                 $menu->contribuyentes->add('Resumen ', route('admin.contribuyentes.resumen'));
                 //$menu->contribuyentes->add('Familiares', '#')->add('Cargar ', route('admin.familiares.clientes'));
               
               
                 
              
                 $menu->add('Irp', ['url'=>'#','id'=>'irp','title'=>'IRP']);
                 $menu->irp->add('Cargar Ingresos', route('admin.irp.ingresos.clientes'));
                 $menu->irp->add('Cargar Egresos', route('admin.irp.egresos.clientes'));
                  $menu->add('Iva', '#')->prepend('<span class="fa fa-book"></span> ');
                 $menu->iva->add('Cargar Compras', route('admin.iva.compras.clientes'))->prepend('<span class="fa fa-plus"></span> ');
                 $menu->iva->add('Cargar Ventas', route('admin.iva.ventas.clientes'))->prepend('<span class="fa fa-plus"></span> ');
                $menu->iva->add('Importar desde Hechauka', route('admin.iva.importar.ventas.clientes'))->prepend('<span class="fa fa-cloud-upload"></span> ');
                 $menu->iva->add('Exportar a Hechauka', '#')->prepend('<span class="fa fa-cloud-download"></span> ');
            });
        }elseif($user->hasRole('Colaborador')){
            Menu::make('BackeckAdminNavBar', function ($menu) {          
                 $menu->add('Contribuyentes', '#');
                 $menu->contribuyentes->add('Cargar ', route('admin.contribuyentes.cargar'));
                 $menu->contribuyentes->add('Importar ', route('admin.contribuyentes.importar'));
                 $menu->contribuyentes->add('Resumen ', route('admin.contribuyentes.resumen'));
                 $menu->add('Familiares', '#');
                 $menu->familiares->add('Cargar ', route('admin.familiares.clientes'));
                /* $menu->add('Iva', '#');
                 $menu->iva->add('Cargar Compras', route('admin.iva.compras.clientes'));
                 $menu->iva->add('Cargar Ventas', route('admin.iva.ventas.clientes'));
                */ $menu->add('Irp', '#');
                 $menu->irp->add('Cargar Ingresos', route('admin.irp.ingresos.clientes'));
                 $menu->irp->add('Cargar Egresos',  route('admin.irp.egresos.clientes'));
            });
        }
        }
       
       

    return $next($request);
    }
}
