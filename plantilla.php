<?php
// Plantilla común para las páginas
session_start();

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_gitflow";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para limpiar datos de entrada
function limpiarDatos($datos) {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}

// Verificar si la tabla personajes existe
$tabla_existe = $conn->query("SHOW TABLES LIKE 'personajes'");
if ($tabla_existe->num_rows == 0) {
    // Crear la tabla si no existe
    $sql = "CREATE TABLE IF NOT EXISTS personajes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        color VARCHAR(50) NOT NULL,
        tipo VARCHAR(50) NOT NULL,
        nivel INT NOT NULL,
        fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql) === FALSE) {
        die("Error al crear la tabla: " . $conn->error);
    }
}
?>
