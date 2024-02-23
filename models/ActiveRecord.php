<?php 
namespace Models;

class ActiveRecord{
    
    protected static $db;
    protected static $columnasDB = [];

    protected static $tabla = '';
    
    protected static $errores = [];


    
    public static function setDB($database) {
            self::$db = $database;
        }
    
    
    public function guardar(){
        if(!is_null($this->id)){
         $this->actualizar();
        }else{
          $this->crear();
        }

       


    }
    
    public function crear() {
        
        $datos=$this->sanitizarDatos();
    
        $query = "INSERT INTO ".static::$tabla." ( ";
        $query .= join(', ',array_keys($datos));
        $query .= " ) VALUES ('";
        $query .= join("','",array_values($datos));
        $query .= "');";
        
        $resultado= self::$db->query($query);
        
        if ($resultado) {
            //redireccionar al usuario 
            header('Location:/admin?resultado=1');
          }
    }
    public function actualizar() {
        $datos=$this->sanitizarDatos();

        $valores = [];

        foreach ($datos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        
        $query = "UPDATE ".static::$tabla." SET ";
        $query .=join(', ',$valores);
        $query .= " WHERE ID = '".self::$db->escape_string($this->id)."' ";
        $query .= "LIMIT 1 ;";

        

        $resultado = self::$db->query($query);

        if ($resultado) {
            //redireccionar al usuario 
            header('Location:/admin?resultado=2');
          }
    }
  
    public function eliminar() {
        $query = "DELETE FROM ".static::$tabla." WHERE ID = '".self::$db->escape_string($this->id)."' LIMIT 1 ;";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
            header('Location:/admin?resultado=3');
          }
    }
    public function datos() {
        $datos = [];
    

        foreach (static::$columnasDB as $columna) {
            
            if ($columna === 'id') continue;
                $datos[$columna] = $this->$columna;

            }
     
            return $datos;
    }
        

    
    public function sanitizarDatos() {
        $datos = $this->datos();
        $sanitizados = [];
        
        foreach ($datos as $key => $value) {
            $sanitizados[$key] = self::$db->escape_string($value);  
        }

        return $sanitizados;
    }

    public static function getErrores() {
        return static::$errores;
    }
    public function borrarImagen() {
             
        $existe = file_exists(CARPETA_IMAGENES.$this->imagen);
        if ($existe) {
            unlink(CARPETA_IMAGENES.$this->imagen);
        
        }
    }

    public function setImagen($imagen) {
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }
        if ($imagen) {
            $this->imagen = $imagen;
            
        }
    }

    public function validar() {
        
        static::$errores = [];
        
        return  self::$errores;
     
     
    }
    public static function all() {
        $query = "SELECT * FROM ".static::$tabla;
        
        $resultado = self::consultarSQL($query);

        return $resultado;
    }
    public static function get($cantidad) {
        $query = "SELECT * FROM ".static::$tabla." LIMIT ".$cantidad;
        
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function find($id) {
        $query = "SELECT * FROM ".static::$tabla." WHERE ID = {$id};";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }



    public static function consultarSQL($query) {
        $resultado=self::$db->query($query);

        $array= [];

        while ($registro = $resultado->fetch_assoc()) {
          
            $array[] = static::crearObjeto($registro);
        }
        
        $resultado->free();
        
        return $array;
    }
    
    protected static function crearObjeto($registro) {
        $objeto = new static;
        
        foreach ($registro as $key => $value) {
            if (property_exists( $objeto, $key )) {
                $objeto->$key = $value;
                
            }
            
        }
       
        return $objeto;
    }

    //sincronizar los cambios en la app con la base de datos

    public function sincronizar($datos = [] ) {
        foreach ($datos as $key => $value) {
            if (property_exists($this,$key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
?>