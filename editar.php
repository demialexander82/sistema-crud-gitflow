<?php
include 'plantilla.php';

$mensaje = '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Obtener datos del personaje
$sql = "SELECT * FROM personajes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$personaje = $result->fetch_assoc();
$stmt->close();

if (!$personaje) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = limpiarDatos($_POST['nombre']);
    $color = limpiarDatos($_POST['color']);
    $tipo = limpiarDatos($_POST['tipo']);
    $nivel = intval($_POST['nivel']);
    
    $sql = "UPDATE personajes SET nombre = ?, color = ?, tipo = ?, nivel = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $nombre, $color, $tipo, $nivel, $id);
    
    if ($stmt->execute()) {
        $mensaje = '<div class="alert alert-success">Personaje actualizado correctamente</div>';
        // Actualizar los datos mostrados
        $personaje['nombre'] = $nombre;
        $personaje['color'] = $color;
        $personaje['tipo'] = $tipo;
        $personaje['nivel'] = $nivel;
    } else {
        $mensaje = '<div class="alert alert-danger">Error al actualizar el personaje: ' . $conn->error . '</div>';
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Personaje</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Editar Personaje</h2>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php echo $mensaje; ?>
                
                <form action="editar.php?id=<?php echo $id; ?>" method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" 
                               value="<?php echo htmlspecialchars($personaje['nombre']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="color" class="form-label">Color:</label>
                        <input type="color" class="form-control form-control-color" id="color" name="color" 
                               value="<?php echo htmlspecialchars($personaje['color']); ?>" title="Elige un color" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo:</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" 
                               value="<?php echo htmlspecialchars($personaje['tipo']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nivel" class="form-label">Nivel:</label>
                        <input type="number" class="form-control" id="nivel" name="nivel" 
                               value="<?php echo intval($personaje['nivel']); ?>" min="1" max="100" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="index.php" class="btn btn-secondary">Volver al listado</a>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
