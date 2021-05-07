<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', function(){
	return view('about');
})->name('about');

// es el admin

Route::prefix('admin')->group(function() {
    

    //dashboard
    Route::get('home', 'DashboardController@panel_principal')->name('admin.dashboard.home');
    //iva 
     Route::get('perfil', 'UsuariosController@perfil')->name('admin.usuarios.perfil');
  
    Route::get('iva/compras/cargar/{id}', 'LibroComprasController@cargar')->name('admin.iva.compras.cargar');
    Route::get('iva/compras/clientes', 'LibroComprasController@listar_clientes')->name('admin.iva.compras.clientes');
    Route::post('iva/compras/guardar', 'LibroComprasController@guardar')->name('admin.iva.compras.guardar');
   
    Route::get('iva/ventas/cargar/{id}', 'LibroVentasController@cargar')->name('admin.iva.ventas.cargar');
    Route::get('iva/ventas/clientes', 'LibroVentasController@listar_clientes')->name('admin.iva.ventas.clientes');
	  Route::post('iva/ventas/guardar', 'LibroVentasController@guardar')->name('admin.iva.ventas.guardar');
    Route::get('iva/exportar/hechauka/{id}', 'HechaukaController@exportar')->name('admin.iva.hechauka.exportar');
    Route::post('iva/exportar/hechauka', 'HechaukaController@exportar_hechauka')->name('admin.iva.hechauka.exportar_procesar');
    Route::get('iva/importar/clientes', 'LibroVentasController@listar_clientes_importar')->name('admin.iva.importar.ventas.clientes');
	 Route::get('iva/importar/ventas/{id}', 'LibroVentasController@importar')->name('admin.iva.importar.ventas');
   Route::post('iva/importar/ventas_txt', 'LibroVentasController@importar_txt')->name('admin.iva.importar.ventas_txt');
  
    //irp
    Route::get('irp/egresos/cargar/{id}', 'LibroEgresosController@cargar')->name('admin.irp.egresos.cargar');
    Route::get('irp/egresos/editar/{id}', 'LibroEgresosController@editar')->name('admin.irp.egresos.editar');
    Route::get('irp/egresos/borrar/{id}', 'LibroEgresosController@borrar')->name('admin.irp.egresos.borrar');
   


    Route::get('irp/egresos/clientes', 'LibroEgresosController@listar_clientes')->name('admin.irp.egresos.clientes');
    Route::get('irp/egresos/ajax/subtipo/{codigo}', 'LibroEgresosController@ajax_subtipo')->name('admin.irp.egresos.ajax.subtipo');
    Route::post('irp/egresos/guardar', 'LibroEgresosController@guardar')->name('admin.irp.egresos.guardar');
     Route::post('irp/egresos/actualizar', 'LibroEgresosController@actualizar')->name('admin.irp.egresos.actualizar');

    Route::get('irp/ingresos/cargar/{id}', 'LibroIngresosController@cargar')->name('admin.irp.ingresos.cargar');
    Route::get('irp/ingresos/editar/{id}', 'LibroIngresosController@editar')->name('admin.irp.ingresos.editar');
    Route::get('irp/ingresos/borrar/{id}', 'LibroIngresosController@borrar')->name('admin.irp.ingresos.borrar');
   
    Route::get('irp/ingresos/clientes', 'LibroIngresosController@listar_clientes')->name('admin.irp.ingresos.clientes');
	Route::post('irp/ingresos/guardar', 'LibroIngresosController@guardar')->name('admin.irp.ingresos.guardar');
      Route::post('irp/ingresos/actualizar', 'LibroIngresosController@actualizar')->name('admin.irp.ingresos.actualizar');
 
    Route::get('irp/exportar/aranduka/{ci}/{pe}', 'ArandukaController@exportar')->name('admin.irp.aranduka.exportar');
   Route::get('irp/aranduka/exportar','ArandukaController@exportar_aranduka_form')->name('admin.irp.aranduka.exportar.form');
    Route::post('irp/aranduka/exportar/procesar','ArandukaController@exportar_aranduka_procesar')->name('admin.irp.aranduka.exportar.procesar');
   
    //contribuyentes
    Route::get('contribuyentes/resumen', 'ContribuyentesController@resumen')->name('admin.contribuyentes.resumen');
    Route::get('contribuyentes/cargar', 'ContribuyentesController@cargar')->name('admin.contribuyentes.cargar');
    Route::get('contribuyentes/ajax/ruc/{id}', 'ContribuyentesController@ajax_ruc')->name('admin.contribuyentes.ajax.ruc');
    Route::get('contribuyentes/ajax/timbrado/{id}', 'ContribuyentesController@ajax_timbrado')->name('admin.contribuyentes.ajax.timbrado');
    Route::get('contribuyentes/ajax/borrar/{id}', 'ContribuyentesController@ajax_borrar')->name('admin.contribuyentes.ajax.borrar');
    Route::get('contribuyentes/importar', 'ContribuyentesController@importar_contribuyentes')->name('admin.contribuyentes.importar');
    Route::post('contribuyentes/importar-excel', 'ContribuyentesController@importar_contribuyentes_excel')->name('admin.contribuyentes.importar_excel');
    Route::post('contribuyentes/actualizar', 'ContribuyentesController@actualizar')->name('admin.contribuyentes.actualizar');
    Route::post('contribuyentes/guardar', 'ContribuyentesController@guardar')->name('admin.contribuyentes.guardar');
  
    Route::get('contribuyentes/editar/{id}', 'ContribuyentesController@editar')->name('admin.contribuyentes.editar');
    Route::get('contribuyentes/borrar/{id}', 'ContribuyentesController@borrar')->name('admin.contribuyentes.borrar');
    Route::get('contribuyentes/balance/{id}', 'ContribuyentesController@balance')->name('admin.contribuyentes.balance');
    Route::get('contribuyentes/balance/iva/{id}', 'ContribuyentesController@balanceIVA')->name('admin.contribuyentes.balance.iva');
    //clientes
    Route::get('clientes/resumen', 'ContribuyentesController@resumen_clientes')->name('admin.clientes.resumen');
     Route::get('clientes/cargar', 'ContribuyentesController@cargar')->name('admin.clientes.cargar');
    Route::get('clientes/ajax/ruc/{id}', 'ContribuyentesController@ajax_ruc')->name('admin.contribuyentes.ajax.ruc');
    Route::get('clientes/ajax/timbrado/{id}', 'ContribuyentesController@ajax_timbrado')->name('admin.clientes.ajax.timbrado');
    Route::get('clientes/ajax/borrar/{id}', 'ContribuyentesController@ajax_borrar')->name('admin.clientes.ajax.borrar');
   
    Route::post('clientes/actualizar', 'ContribuyentesController@actualizar')->name('admin.clientes.actualizar');
    Route::post('clientes/guardar', 'ContribuyentesController@guardar')->name('admin.clientes.guardar');
  
    Route::get('clientes/editar/{id}', 'ContribuyentesController@editar')->name('admin.clientes.editar');
    Route::get('clientes/borrar/{id}', 'ContribuyentesController@borrar')->name('admin.clientes.borrar');
    Route::get('clientes/balance/{id}', 'ContribuyentesController@balance')->name('admin.clientes.balance');
    Route::get('clientes/balance/iva/{id}', 'ContribuyentesController@balanceIVA')->name('admin.clientes.balance.iva');
    //familiares
    Route::get('familiares/ver/{id}','FamiliaresController@ver')->name('admin.familiares.ver');
    Route::get('familiares/cargar/{id}', 'FamiliaresController@cargar')->name('admin.familiares.cargar');
    Route::get('familiares/editar/{id}', 'FamiliaresController@editar')->name('admin.familiares.editar');
    Route::get('familiares/cliente', 'FamiliaresController@listar_clientes')->name('admin.familiares.clientes');
    Route::post('familiares/guardar', 'FamiliaresController@guardar')->name('admin.familiares.guardar');
    Route::post('familiares/actualizar', 'FamiliaresController@actualizar')->name('admin.familiares.actualizar');
   


    //Usuarios
    Route::get('usuarios/cargar','UsuariosController@cargar')->name('admin.usuarios.cargar');
    Route::get('usuarios/resumen','UsuariosController@resumen')->name('admin.usuarios.resumen');
    Route::post('usuarios/guardar','UsuariosController@guardar')->name('admin.usuarios.guardar');
    Route::post('usuarios/actualizar', 'UsuariosController@actualizar')->name('admin.usuarios.actualizar');
    Route::get('usuarios/editar/{id}', 'UsuariosController@editar')->name('admin.usuarios.editar');
    //Route::get('usuarios/borrar/{id}', 'UsuariosController@borrar')->name('admin.usuarios.borrar');
    
    //permisos
    Route::get('permisos/cargar','PermisosController@cargar')->name('admin.permisos.cargar');
    Route::post('permisos/guardar','PermisosController@guardar')->name('admin.permisos.guardar');

    //roles
    Route::get('roles/cargar','RolesController@cargar')->name('admin.roles.cargar');
    Route::get('roles/resumen','RolesController@resumen')->name('admin.roles.resumen');
    Route::post('roles/guardar','RolesController@guardar')->name('admin.roles.guardar');

      //Usuarios
    Route::get('empresas/cargar','EmpresasController@cargar')->name('admin.empresas.cargar');
     Route::get('empresas/resumen','EmpresasController@resumen')->name('admin.empresas.resumen');
    Route::get('empresas/ver/{id}','EmpresasController@ver')->name('admin.empresas.ver');
    Route::post('empresas/guardar','EmpresasController@guardar')->name('admin.empresas.guardar');
    //Route::post('empresas/actualizar', 'EmpresasController@actualizar')->name('admin.empresas.actualizar');
    //Route::get('empresas/editar/{id}', 'EmpresasController@editar')->name('admin.empresas.editar');
    Route::get('calendario/iva','CalendarioController@iva')->name('admin.calendario.iva');

    //clientes

});
Route::get('dv/{ruc}','ContribuyentesController@Calcular_DV');
Route::get('r/v/{code}', 'EmpresasController@confirmar_registro')->name('frontend.empresas.verificar');
Route::get('empresas/registro','EmpresasController@form_registro')->name('frontend.empresas.registro');
Route::post('empresas/registrar','EmpresasController@registrar')->name('frontend.empresas.registrar');
Route::get('qr', function () 
{
    $qr= QRCode::url('pyaeve.com')
                          ->setErrorCorrectionLevel('H')
                         ->setSize(10)
                         ->setMargin(2)
                         ->setOutfile('pyaeve-qr.png')
                         ->png();


return redirect('/pyaeve-qr.png');
});    