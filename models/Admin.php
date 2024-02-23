<?php 
namespace Models;


class Admin extends ActiveRecord{
    // base de datos

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','email','password'];


    public $id;
    public $email;
    public $password;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {
        if (!$this->email) {
           self::$errores[] = 'El email es obligatorio o no válido';
        }if (!$this->password) {
            self::$errores[] = 'La clave es obligatoria';
            
        }
        return self::$errores;
    }
    public function existeUsuario() {
        //revisar la existencia
        $query = "SELECT * FROM ".self::$tabla." WHERE EMAIL = '".$this->email."' LIMIT 1;";

        $resultado = self::$db->query($query);
        
        if (!$resultado->num_rows) {
            self::$errores[] = 'El usuario no existe';
        }
        return $resultado;
    }

    public function comprobarPass($resultado) {
        $usuario = $resultado->fetch_object();

        $autenticado = password_verify($this->password,$usuario->password);
        if(!$autenticado){
            self:$errores[]='El password es incorrecto';


        }
        return $autenticado;
    }
    public function autenticarUsuario() {
        session_start();

        $_SESSION['usuario']=$this->email;
        $_SESSION['login']=true;

        header('Location:/admin');

    }

}

?>