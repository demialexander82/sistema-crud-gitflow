<?php
include 'plantilla.php';
include 'conexion/db_conexion.php';

// Verificar si la tabla personajes existe, si no, redirigir al instalador
if (!file_exists('conexion/db_conexion.php')) {
    header("Location: instalador.php");
    exit();
}

$result = $conn->query("SELECT * FROM personajes");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD con Git Flow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Listado de Personajes</h2>
        <a href="agregar.php" class="btn btn-success mb-3">Agregar Personaje</a>
        
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Tipo</th>
                    <th>Nivel</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td style="color: <?php echo htmlspecialchars($row['color']); ?>">
                        <?php echo htmlspecialchars($row['color']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['tipo']); ?></td>
                    <td><?php echo htmlspecialchars($row['nivel']); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="eliminar.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" 
                           onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</a>
                        <a href="descargar_pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">PDF</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
