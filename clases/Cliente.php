<?php 

namespace App;

class Cliente {

    //BASE DE DATOS
    protected static $db;
    protected static $columnasDB = ['nombre', 'apellido', 'telefono_principal', 'telefono_secundario', 'cedula', 'direccion', 'asesor_id', 'fecha_registro', 'estado'];

    //validar datos
    protected static $errores = [];

    //declarar variables espejo de la bdd
        public $id;
        public $nombre;
        public $apellido;
        public $telefono_principal;
        public $telefono_secundario;
        public $cedula;
        public $direccion;
        public $asesor_id;
        public $fecha_registro;
        public $estado; 

    // definir conexion a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono_principal = $args['telefono_principal'] ?? '';
        $this->telefono_secundario = $args['telefono_secundario'] ?? '';
        $this->cedula = $args['cedula'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->asesor_id = $args['asesor_id'] ?? '';
        $this->fecha_registro = date('Y-m-d');
        $this->estado = "Activo";
    }

    public function guardar(){

        //sanitizar entrada de datos
        $atributos = $this->sanitizarAtributos();

        //insertar en la base de datos
        $query = "INSERT INTO clientes ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ')";

        $resultado = self::$db->query($query);
        if ($resultado) {   
            registroGuardado();
        }
    }

    //identificar los datos de la base de datos
    public function atributos(){
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    //sanitizar los datos de la base de datos
    public function sanitizarAtributos (){

        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public static function getErrores(){
        return self::$errores;
    }

    //validar datos
    public function validar(){
        if(!$this->nombre){
            self::$errores[] = "El nombre es obligatorio";
        }
        if(!$this->apellido){
            self::$errores[] = "El apellido es obligatorio";
        }
        if(!$this->telefono_principal){
            self::$errores[] = "El teléfono es obligatorio";
        }
        if(!$this->cedula){
            self::$errores[] = "La cédula es obligatoria";
        }
        if(!$this->direccion){
            self::$errores[] = "La dirección es obligatoria";
        }
        if(!$this->asesor_id){
            self::$errores[] = "El asesor es obligatorio";
        }
        return self::$errores;
    }
}