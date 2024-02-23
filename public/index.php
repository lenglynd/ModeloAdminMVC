 <?php 
 require_once __DIR__.'/../includes/app.php';

use Controllers\LoginController;
use Controllers\PaginasController;
use MVC\Router;
 use Controllers\PropiedadController;
 use Controllers\VendedorController;

 $router = new Router();

  
// zona privada
 $router->get('/admin',[PropiedadController::class, 'index']);
 $router->get('/propiedades/crear',[PropiedadController::class, 'crear']);
 $router->get('/propiedades/actualizar',[PropiedadController::class, 'actualizar']);
 $router->get('/vendedores/crear',[VendedorController::class, 'crear']);
 $router->get('/vendedores/actualizar',[VendedorController::class, 'actualizar']);
 
 
 $router->post('/propiedades/crear',[VendedorController::class, 'crear']);
 $router->post('/propiedades/actualizar',[VendedorController::class, 'actualizar']);
 $router->post('/propiedades/eliminar',[VendedorController::class, 'eliminar']);
 $router->post('/vendedores/crear',[VendedorController::class, 'crear']);
 $router->post('/vendedores/actualizar',[VendedorController::class, 'actualizar']);
 $router->post('/vendedores/eliminar',[VendedorController::class, 'eliminar']);
 
// zona publica
$router->get('/',[PaginasController::class,'index']);
$router->get('/nosotros',[PaginasController::class,'nosotros']);
$router->get('/anuncios',[PaginasController::class,'propiedades']);
$router->get('/anuncio',[PaginasController::class,'propiedad']);
$router->get('/blog',[PaginasController::class,'blog']);
$router->get('/entrada',[PaginasController::class,'entrada']);
$router->get('/contacto',[PaginasController::class,'contacto']);
$router->post('/contacto',[PaginasController::class,'contacto']);

//Login y autenticacion

$router->get('/login',[LoginController::class, 'login']);
$router->get('/logout',[LoginController::class, 'logout']);
$router->post('/login',[LoginController::class, 'login']);

 $router->comprobarRutas();
 ?>