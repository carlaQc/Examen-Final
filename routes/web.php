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
    return view('welcome');
});

Auth::routes(['verify' => true]);


//intentos Login
Route::post('login','Auth\LoginController@login_attemps')->name('login_attemps');



Route::group(['middleware' => ['auth']], function(){
	//Pantall principal de login
	Route::get('/home', 'HomeController@index')->name('home');
	// Gestion de Usuarios que son Administradores de Info-Sport
	Route::get('GestionUsuario','UserGestionController@getUserAdmin')->name('userAdmin.get');
	Route::get('GestionUsuario/Nuevo','UserGestionController@createUserAdmin')->name('userAdmin.create');
	Route::post('GestionUsuario','UserGestionController@storeUserAdmin')->name('userAdmin.store');
	Route::get('GestionUsuario/{id}','UserGestionController@editUserAdmin')->name('userAdmin.edit');
	Route::put('GestionUsuario/{id}/Actualizar','UserGestionController@updateUserAdmin')->name('userAdmin.update');
	Route::put('GestionUsuario/Desactivar/{id}','UserGestionController@deactiveUserAdmin')->name('userAdmin.deactive');
	Route::put('GestionUsuario/Activar/{id}','UserGestionController@activeUserAdmin')->name('userAdmin.active');

	/************************************MODULO USUARIOS DE CENTROS DEPORTIVOS***********************************///  Gestion de Usuarios que son administradores de los centros deportivos
	Route::get('Usuario','UserController@getUser')->name('user.get');
	Route::get('Usuario/nuevo-centro','UserController@getUserCenter')->name('userCenter.create');
	Route::get('Usuario/Nuevo/{center_id}','UserController@createUser')->name('user.create');
	Route::post('Usuario/Nuevo/Guardar/{center_id}','UserController@storeUser')->name('user.store');
	Route::post('Usuario/Nuevo/Guardar-centro','UserController@storeCenter')->name('centerUser.store');
	Route::get('Usuario/{id}','UserController@editUser')->name('user.edit');
	Route::get('/actualizar-centro/{id}','UserController@editUserCenter')->name('userCenter.edit');
	Route::put('Usuario/{id}/Actualizar','UserController@updateUser')->name('user.update');
	Route::put('centro/{id}/Actualizar','UserController@updateUserCenter')->name('userCenter.update');
	Route::put('usuario/activar/{id}','UserController@activateUser')->name('user.active');
	Route::put('usuario/desactivar/{id}','UserController@deactivateUser')->name('user.deactive');
	Route::put('centro-deportivo/estado/{id}','UserController@stateCenter')->name('center.state');
	/*********************************************************************************************************************/

	//  Gestion de empleados de los centros deportivos
	Route::get('empleados','EmployeeController@getEmployee')->name('employee.get');
	Route::get('Usuarios_Centro_Deportivo/Desactivados','EmployeeController@getEmployeeDeactive')->name('employee.disable');
	Route::get('Empleado/Nuevo','EmployeeController@createEmployee')->name('employee.create');
	Route::post('Empleado/Nuevo/Guardar','EmployeeController@storeEmployee')->name('employee.store');
	Route::get('empleado/actualizar/{id}','EmployeeController@editEmployee')->name('employee.edit');
	Route::put('Empleado/Actualizar/{id}','EmployeeController@updateEmployee')->name('employee.update');
	Route::put('empleado/activar/{id}','EmployeeController@activateEmployee')->name('employee.active');
	Route::put('empleado/desactivar/{id}','EmployeeController@deactivateEmployee')->name('employee.deactive');
	Route::put('Empleado/Eliminar/{id}','EmployeeController@deleteEmployee')->name('employee.delete');
	/************************************************************************************************************/

	/************************************MODULO CANCHAS***********************************/
	// Gestion de Canchas de los centro deportivos
	Route::get('centro-deportivo/cancha','FieldController@getField')->name('field.get');
	Route::get('Centro_Deportivo/Cancha/Nuevo','FieldController@createField')->name('field.create');
	Route::post('Centro_Deportivo/Cancha/Nuevo/Guardar','FieldController@storeField')->name('field.store');
	Route::get('Centro_Deportivo/Cancha/{id}','FieldController@editField')->name('field.edit');
	Route::put('Centro_Deportivo/Cancha/{id}/Actualizar','FieldController@updateField')->name('field.update');
	Route::post('Centro_Deportivo/Cancha/Fotografia/{id}','FieldController@addPhotosField')->name('fieldPhotos.store');
	Route::get('Centro_Deportivo/Cancha/Nuevo/Fotografia/{field_id}','FieldController@getPhotosField')->name('fieldPhotos.get');

	Route::get('Centro_Deportivo/Canchas/{center_id}','FieldController@getFieldCenter')->name('fieldCenter.get');

	Route::get('campo/actualizar/{id}/{state}','FieldController@stateField')->name('state.field');
	/************************************M**************************************************/



	/************************************MODULO PERFIL DE USUARIOS***********************************/
	// Perfil de todos los usuarios registrados
	Route::get('Perfil','ProfileController@getProfile')->name('profile.get');
	Route::get('Perfil/Editar','ProfileController@editProfile')->name('profile.edit');
	Route::put('Perfil/Editar/Actualizar','ProfileController@updateProfile')->name('profile.update');
	/************************************************************************************************/



	/************************************MODULO CENTROS DEPORTIVOS***********************************/
	// Lista de toos los centros deportivos
	Route::get('centros-deportivos','CenterController@getCenters')->name('centers.get');
	// Detalles de centro deportivo del administrador 
	Route::get('Centro_Deportivo','CenterController@getCenter')->name('center.get');
	Route::get('Centro_Deportivo/Editar','CenterController@editCenter')->name('center.edit');
	Route::put('Centro_Deportivo/Actualizar','CenterController@updateCenter')->name('center.update');
	// Listar todos los centros deportivos
	Route::get('Centros_Deportivos','CenterController@getCentersReservation')->name('center.profile');
	/************************************************************************************************/




	/************************************MODULO CALENDARIO***********************************/
	// Gestionar Calendario (CRUD) //Administradores de los centros deportivos
	Route::get('Calendario','ScheduleController@getSchedule')->name('schedule.get');

	// Reservar cancha //CLientes
	Route::get('Centro_Deportivo/Reserva/Cancha/{field_id}','ScheduleController@getScheduleReservation')->name('scheduleReserve.get');
	// Reservar cancha //Administradores de los centros deportivos
	Route::get('Centro_Deportivo/Reserva/{center_id}','ScheduleController@getScheduleReservationAdmin')->name('scheduleReserveAdmin.get');

	// Se creara un horario automaticamente
	Route::get('Calendario/Guardar/{field_id}','ScheduleController@storeSchedule')->name('schedule.store');
	// Redirige a la vista que creara la reserva
	Route::get('Calendario/Nuevo/{field_id}/{day}/{hour}','ScheduleController@createScheduleReservation')->name('scheduleReserve.create');
	// Alamcena datos que se hizo en la reserva
	Route::post('Calendario/Nuevo/{field_id}/{rol_id}/{day}/{hour}','ScheduleController@storeScheduleReservation')->name('scheduleReserve.store');

	// Solo puede ver el administrador y empleado
	Route::get('Calendario/Reserva/Cliente/{id}','ScheduleController@editScheduleReservation')->name('scheduleStateReservation.edit');

	Route::put('Calendario/Reserva/Cliente/Actualizar/{id}/{field_id}','ScheduleController@updateScheduleReservation')->name('scheduleStateReservation.update');


	Route::get('Calendario/Horario/Configuración/{field_id}','ScheduleController@updateScheduleState')->name('scheduleUpdate.get');

	/***********************************************************************************************************/

	// Excel
	Route::get('exportar-excel/{start_date}/{end_date}/{field}','ScheduleController@excel')->name('get.reportExcel');


	// ****************************************PROMOCIONES CENTROS DEPORTIVOS************************************************
	Route::get('Centro_Deportivo/Promocion','PromotionController@getPromotion')->name('promotion.get');
	Route::get('Centro_Deportivo/Promocion/Nuevo','PromotionController@createPromotion')->name('promotion.create');
	Route::post('Centro_Deportivo/Promocion/Nuevo/Guardar','PromotionController@storePromotion')->name('promotion.store');
	Route::put('promocion/accion/{id}','PromotionController@deletePromotion')->name('promotion.action');
	// *********************************************************************************************************************

	Route::get('payment-campos/{field_id}','FieldController@getPayment')->name('payment.get');

	// Modulo de reporte
	Route::get('centro-deportivo/reporte','ReportController@getReport')->name('report.get');
	Route::post('centro-deportivo/reporte-filtrado','ReportController@filterReport')->name('report.filter');

	// Dashboar
	Route::get('dashboard','DashboardController@getDashboard')->name('dashboard');
});
