<?php

define('TEMPLATES_URL', __DIR__.'/templates');
define('FUNCIONES_URL', __DIR__.'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'].'/imagenes/');

function incluirTemplate( string $nombre, bool $inicio = false, string $arreglo = '') {
    include TEMPLATES_URL."/{$nombre}.php";
}

function estaAutenticado() {
    session_start();
    
    
   if (!$_SESSION['login']) {
    header('Location:/index.php');
  }
}

function s($html) : string {
  $s= htmlspecialchars($html);

  return $s;
}
function validarTipo($tipo) {
  $tipos = ['vendedor','propiedad'] ;

  return in_array($tipo,$tipos);
}

function mostraralerta($codigo) {
  $mensaje = '';

  switch ($codigo) {
    case 1:
      $mensaje = 'Creado correctamente';
      break;
    case 2:
      $mensaje = 'Actualizado correctamente';
      break;
    case 3:
      $mensaje = 'Eliminado correctamente';
      break;
    
    default:
      $mensaje = false;
      break;
  }
  return $mensaje;
}

function validarORedireccionar(string $url) {
  $id = $_GET['id'];

  $id= filter_var($id, FILTER_VALIDATE_INT);

  if (!$id) {
    header("Location:{$url}");
  }
  return $id;
}

?>