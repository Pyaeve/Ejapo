<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});


// Home > About
Breadcrumbs::for('admin_dashboard', function ($trail) {
   /*	$user =Auth::user()->id;
   	mp=DB::select("CALL PRO_VER_EMPRESA('".$user."');");
	$emp=$emp[0];
	*/
    $trail->push('Home', route('admin.dashboard.home'));
});


Breadcrumbs::for('admin_perfil', function ($trail) {
    $trail->parent('admin_dashboard');
    $trail->push('Perfil', '#');
});
Breadcrumbs::for('admin_contribuyentes_resumen', function ($trail) {
    $trail->parent('admin_dashboard');
    $trail->push('Contribuyentes', route('admin.contribuyentes.resumen'));
});

Breadcrumbs::for('admin_contribuyentes_cargar', function ($trail) {
    $trail->parent('admin_contribuyentes_resumen');
    $trail->push('Cargar', '#');
});
Breadcrumbs::for('admin_contribuyentes_editar', function ($trail) {
    $trail->parent('admin_contribuyentes_resumen');
    $trail->push('Editar', '#');
});



Breadcrumbs::for('admin_irp', function ($trail) {
    $trail->parent('home');
    $trail->push('IRP',"#");
});
Breadcrumbs::for('admin_irp_ingresos_cargar', function ($trail) {
    $trail->parent('admin_irp');
    $trail->push('Cargar Ingresos', '#');
});
Breadcrumbs::for('admin_irp_ingresos_clientes', function ($trail) {
    $trail->parent('admin_irp_ingresos_cargar');
    $trail->push('Seleccione un Cliente', '#');
});

Breadcrumbs::for('admin_irp_egresos_cargar', function ($trail) {
    $trail->parent('admin_irp');
    $trail->push('Cargar Egresos', '#');
});
Breadcrumbs::for('admin_irp_egresos_clientes', function ($trail) {
    $trail->parent('admin_irp_egresos_cargar');
    $trail->push('Seleccione un Cliente', '#');
});


Breadcrumbs::for('admin_iva', function ($trail) {
    $trail->parent('home');
    $trail->push('IVA',"#");
});
Breadcrumbs::for('admin_iva_ventas_cargar', function ($trail) {
    $trail->parent('admin_iva');
    $trail->push('Cargar Ventas', '#');
});
Breadcrumbs::for('admin_iva_ventas_clientes', function ($trail) {
    $trail->parent('admin_iva_ventas_cargar');
    $trail->push('Seleccione un Cliente', '#');
});

Breadcrumbs::for('admin_iva_compras_cargar', function ($trail) {
    $trail->parent('admin_iva');
    $trail->push('Cargar Egresos', '#');
});
Breadcrumbs::for('admin_iva_compras_clientes', function ($trail) {
    $trail->parent('admin_iva_compras_cargar');
    $trail->push('Seleccione un Cliente', '#');
});


Breadcrumbs::for('admin_iva_ventas_importar', function ($trail) {
    $trail->parent('admin_iva_ventas_cargar');
    $trail->push('Seleccione un Cliente', '#');
});