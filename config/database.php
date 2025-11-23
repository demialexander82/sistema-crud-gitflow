<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'crud_gitflow');

class Database {
    private $connection;
    private static $instance = null;

    private function __construct() {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($this->connection->connect_error) {
            die("Error de conexión: " . $this->connection->connect_error);
        }
        
        $this->connection->set_charset("utf8mb4");
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    // Prevenir la clonación del objeto
    private function __clone() {}

    // Prevenir la deserialización
    public function __wakeup() {
        throw new Exception("No se puede deserializar una conexión a la base de datos");
    }
}

// Crear la tabla de usuarios si no existe
function createTablesIfNotExist() {
    $db = Database::getInstance()->getConnection();
    
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        rol ENUM('admin', 'usuario') DEFAULT 'usuario',
        fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if ($db->query($sql) === FALSE) {
        die("Error al crear la tabla de usuarios: " . $db->error);
    }
}

// Llamar a la función para crear tablas
createTablesIfNotExist();

?>
