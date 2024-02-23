<?php 
namespace Controllers;
use MVC\Router;
use Models\Vendedores;

class VendedorController{
    public static function crear(Router $router) {
        $vendedor = new Vendedores();
        $errores = Vendedores::getErrores();

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $vendedor = new Vendedores($_POST['vendedor']);
        
            //generar nombre unico
           
              $errores = $vendedor->validar();
        
           // insertar en la base de datos
        
            if (empty($errores)) {
                
                $vendedor->guardar();
                
            
            }
        }

        $router->render('vendedores/crear',[
            
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');
        $vendedor = Vendedores::find($id);
        $errores = Vendedores::getErrores();
            
        if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {

            $args = $_POST['vendedor'];

            $vendedor->sincronizar($args);
            
            $errores = $vendedor->validar();
            
            // insertar en la base de datos
            
            if (empty($errores)) {
            
                $vendedor->guardar();    
                
            }
        }

        $router->render('vendedores/actualizar',[
            
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $id = $_POST['id'];
          
            $id = filter_var($id, FILTER_VALIDATE_INT);
          
            if ($id) {
          
              $tipo = $_POST['tipo'];
          
              if (validarTipo($tipo)) {
                $vendedor= Vendedores::find($id);
                $vendedor->eliminar();
               
              }
            }
          }
    }
}



?>