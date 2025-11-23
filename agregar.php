<?php
include 'plantilla.php';

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = limpiarDatos($_POST['nombre']);
    $color = limpiarDatos($_POST['color']);
    $tipo = limpiarDatos($_POST['tipo']);
    $nivel = intval($_POST['nivel']);
    
    $sql = "INSERT INTO personajes (nombre, color, tipo, nivel) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $color, $tipo, $nivel);
    
    if ($stmt->execute()) {
        $mensaje = '<div class="alert alert-success">Personaje agregado correctamente</div>';
    } else {
        $mensaje = '<div class="alert alert-danger">Error al agregar el personaje: ' . $conn->error . '</div>';
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Personaje</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Agregar Nuevo Personaje</h2>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php echo $mensaje; ?>
                
                <form action="agregar.php" method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="color" class="form-label">Color:</label>
                        <input type="color" class="form-control form-control-color" id="color" name="color" 
                               value="#000000" title="Elige un color" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo:</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nivel" class="form-label">Nivel:</label>
                        <input type="number" class="form-control" id="nivel" name="nivel" min="1" max="100" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php" class="btn btn-secondary">Volver al listado</a>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
