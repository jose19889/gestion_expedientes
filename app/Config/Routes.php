<?php

use CodeIgniter\Router\RouteCollection;
$routes->setAutoRoute(true);

/**
 * @var RouteCollection $routes
 */


//////////////////////////////////////////////////////////////////////
/////////////default routes
$routes->get('/', function() {
    return redirect()->to('/sign-in');
   
});


///////////////////////////////////////////////
//EXPEDIENTES

$routes->group('', ['filter' => 'auth'], function($routes) {
$routes->get('create-dossier', 'Dossiers::create');
$routes->post('dossier-insert', 'Dossiers::store');
$routes->get('dossiers', 'Dossiers::index');
$routes->get('dossier-edit/(:num)', 'Dossiers::edit/$1');
$routes->post('dossier-update/(:num)', 'Dossiers::update/$1');
//$routes->get('update', 'Dossiers::update');
$routes->post('move-update/(:num)', 'Dossiers::UpdateMovement/$1');
$routes->get('move-dossier/(:num)', 'Dossiers::mover/$1');
$routes->get('download-pdf/(:num)', 'Dossiers::descargar/$1');
$routes->get('assign-edit/(:num)', 'Dossiers::assign/$1'); // formulario de asignación
$routes->post('asign-save/(:num)', 'Dossiers::assign_save/$1'); // envío del formulario
$routes->get('view-dossier/(:num)', 'Dossiers::view/$1'); // envío del formulario

});
////////////////////////////////////
//BACK-END
///////////////////////////////////

////////LOGIN
$routes->get('/sign-in', 'Login::sign_in');
$routes->post('login-auth', 'Login::auth');
$routes->get('quit', 'Login::logout');
///////////////////////////////////
//////resgister
$routes->get('sign-form', 'Register::index');

/////////////////////////////////////////////////////

///////////     XNFER DATA FROM WP DB TO CODEGNITER DB  ////////////
$routes->get('transfer', 'DataTransfer::transfer');

$routes->get('transferData', 'DataTransferController::transferData');//test purposes
$routes->post('transferData', 'DataTransferController::transferData');


$routes->get('reports', 'DataTransferController::reports');
$routes->get('reports-edit/(:num)', 'DataTransferController::edit/$1');
$routes->get('reports-exportpdf/(:num)', 'DataTransferController::exportPdf/$1');

$routes->get('reports-assign/(:num)', 'DataTransferController::assign/$1');
$routes->post('reports-update', 'DataTransferController::update');
$routes->post('reports-assign-save', 'DataTransferController::assig_save');
$routes->get('reports-assigned', 'DataTransferController::assigned');
$routes->get('reports-stats', 'DataTransferController::statistics');

//////////////////////////////////
/////////// HOME
$routes->get('home', 'Dashboard::index');


//////////////////////////////////
/////////// USERS
$routes->get('users-list', 'Users::index');
$routes->get('users-create', 'Users::create');
$routes->post('users-insert', 'Users::insert');
$routes->get('users-edit/(:num)', 'Users::edit/$1');
$routes->post('users-update', 'Users::update');
$routes->get('users-delete/(:num)', 'Users::delete/$1');
$routes->get('users-changePass', 'Users::changePass'); 
$routes->post('users-changePass', 'Users::changePass'); 
$routes->get('users-uploadphoto', 'Users::upload_userImage');
$routes->post('users-changephoto', 'Users::update_photo');
$routes->post('user-reset-password', 'Users::reset_password');



//////////////////////////////////
/////////// ROLES
$routes->get('roles-list', 'Roles::index');
$routes->get('roles-create', 'Roles::create');
$routes->post('roles-insert', 'Roles::insert');
$routes->get('roles-edit/(:num)', 'Roles::edit/$1');
$routes->post('roles-update', 'Roles::update');
$routes->get('roles-delete/(:num)', 'Roles::delete/$1');



/////////////////////////////////
/////////// FILES
/////////////// files front-nd
$routes->get('files-upload', 'FileController::get_form');
$routes->get('files', 'FileController::index');
$routes->post('files-save', 'FileController::upload');
$routes->get('file-display/(:num)', 'FileController::display_file/$1');

////////////files back-end
$routes->get('files_view', 'FileController::files_backend');
$routes->match(['get', 'post'], 'file/create', 'FileController::create');
$routes->match(['get', 'post'], 'file/file_edit/(:num)', 'FileController::file_edit/$1');
$routes->post('file/file_remove/(:num)', 'FileController::delete/$1');
// Cambia (:any) por (:num) si el ID es numérico, es más preciso
//$routes->get('file-display/(:num)', 'FileController::display_file/$1');

/************************************************
 * MODULO D ERESTAURACION
 */$routes->group('migration', function($routes) {
    $routes->get('/', 'Migration::index');                       // Lista de backups
    $routes->post('create-db', 'Migration::backupDB');          // Crear backup BD
    $routes->post('create-files', 'Migration::backupFiles');    // Crear backup archivos
    $routes->get('download/(:any)', 'Migration::download/$1');  // Descargar backup
    $routes->post('delete/(:any)','Migration::delete/$1');      // Borrar backup
    $routes->post('restore/(:any)', 'Migration::restore/$1');   // Restaurar backup
    $routes->post('create-all', 'Migration::backupAll');
});

///////////////////////////////////////////////////////////////
///////////API REST ROUTES
$routes->group('api/v1', ['namespace' => 'App\Controllers\Api' , 'filter' => 'apiAuth'], function($routes) {
   
    $routes->resource('denuncias', ['controller' => 'DenunciasController']);

});



