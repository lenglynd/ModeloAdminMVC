<?php 
namespace  Controllers;
use MVC\Router;
use Models\Propiedad;
use Models\Vendedores;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{

    public static function index(Router $router) {
        
        $propiedades = Propiedad::all();
        $vendedores = Vendedores::all();
        $mensaje = $_GET['resultado'] ?? null;
        $router->render('propiedades/admin',[
            'propiedades' => $propiedades,
            'mensaje' => $mensaje,
            'vendedores' => $vendedores

        ]);
    }
    public static function crear(Router $router) {
        $propiedad = new Propiedad();
        $vendedor = Vendedores::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $propiedad = new Propiedad($_POST['propiedad']);
        
            //generar nombre unico
            $nombreImagen = md5(uniqid(rand(),true)).'.jpg';
            // subir la imagen
            
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
        
              $errores = $propiedad->validar();
        
           // insertar en la base de datos
        
            if (empty($errores)) {
                
                
                //subida de archivos
                
                if (!is_dir(CARPETA_IMAGENES)) {
                    
                    mkdir(CARPETA_IMAGENES);
                }
                $image->save(CARPETA_IMAGENES.$nombreImagen);
                
                $propiedad->guardar();
                
            
            }
        }

        $router->render('propiedades/crear',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedor,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedor = Vendedores::all();
        $errores = Propiedad::getErrores();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
            $args = $_POST['propiedad'];
        
            $propiedad->sincronizar($args);
            
            $errores = $propiedad->validar();
               //generar nombre unico
               $nombreImagen = md5(uniqid(rand(),true)).'.jpg';
               // subir la imagen
               
               if ($_FILES['propiedad']['tmp_name']['imagen']) {
                   $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                   $propiedad->setImagen($nombreImagen);
               }
            
              if (empty($errores)) {
                
                $propiedad->guardar();
        
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image->save(CARPETA_IMAGENES.$nombreImagen);
                }
                  
                  
                  
                }
              }
            
              
             

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedor,
        ]);
    }
    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $id = $_POST['id'];
          
            $id = filter_var($id, FILTER_VALIDATE_INT);
          
            if ($id) {
          
              $tipo = $_POST['tipo'];
          
              if (validarTipo($tipo)) {
                $propiedad= Propiedad::find($id);
                $propiedad->eliminar();
               
              }
            }
          }

       
    }
}


?>