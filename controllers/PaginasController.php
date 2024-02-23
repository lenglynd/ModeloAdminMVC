<?php 
namespace Controllers;

use Models\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router) {
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('paginas/index',[
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router) {
        $router->render('paginas/nosotros');
    }
    public static function propiedades(Router $router) {
        $propiedades = Propiedad::get(10);
        
        $router->render('paginas/anuncios',[
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router) {
        $anuncioId= validarORedireccionar('/anuncios');
        
        $propiedad = Propiedad::find($anuncioId);
        $router->render('paginas/anuncio',[
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router) {
        $router->render('paginas/blog');
    }
    public static function entrada(Router $router) {
        $router->render('paginas/entrada');
    }
    public static function contacto(Router $router) {
        
        $mensaje = false;

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            
            $respuestas = $_POST['contacto'];

        //envio de correos configuracion 
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '9db21fe8304360';
            $mail->Password = 'f8d3eb2ed42e2b';
            $mail->SMTPSecure = 'tls';
            
            //configurar eel contenido

            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices3.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';
            //habilitar html


            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            //Definir contenido del mail
            
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: '.$respuestas['nombre'].'</p>';

                if ($respuestas['contacto']==='telefono') {
                    $contenido .= '<p>Prefiere ser contactado por: '.$respuestas['contacto'].'</p>';
                    
                $contenido .= '<p>Teléfono: '.$respuestas['telefono'].'</p>';
                    $contenido .= '<p>Fecha: '.$respuestas['fecha'].'</p>';
                    $contenido .= '<p>Hora: '.$respuestas['hora'].'</p>';
                   
                } else {
                    $contenido .= '<p>Prefiere ser contactado por: '.$respuestas['contacto'].'</p>';
                    $contenido .= '<p>Email: '.$respuestas['email'].'</p>';
                
                }
            $contenido .= '<p>Mensaje:'.$respuestas['mensaje'].'</p>';
            $contenido .= '<p>Venta o Compra:'.$respuestas['tipo'].'</p>';
            $contenido .= '<p>Precio o Presupuesto: $ '.$respuestas['precio'].'</p>';
          
           
            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = 'Texto altenativo sin HTML';
            //enviar correo
            if ($mail->send()) {
                $mensaje = 'Mensaje enviado correctamente';
            }


        }
        
        
        $router->render('paginas/contacto',[
            'mensaje' => $mensaje
        ]);
        
    }
}


?>