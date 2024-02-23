<?php 
namespace Models;

class Vendedores extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id','nombre','apellido','telefono'];
    public  $id;
    public  $nombre ;
    public  $apellido ;
    public  $telefono ;
    
    public function __construct($arg =[])
    {
    $this->id= $arg['id'] ?? null;
    $this->nombre = $arg['nombre'] ?? '';
    $this->apellido = $arg['apellido'] ?? '';
    $this->telefono = $arg['telefono'] ?? '';
   
    }
    public function validar() {
        if (!$this->nombre) {
            self::$errores[]  = 'Debes añadir un nombre';       
        }
        if (!$this->apellido) {
            self::$errores[]  = 'Debes añadir un apellido';       
        }
        if (!$this->telefono) {
            self::$errores[]  = 'Debes añadir un telefono';       
        }
        if (!preg_match('/[0-9]{9}/',$this->telefono)) {
            self::$errores[]  = 'Formato no válido de telefono';       
        }

        return self::$errores;
    }
    
}

?>