<?php
include 'plantilla.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Eliminar el personaje
    $sql = "DELETE FROM personajes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['mensaje'] = '<div class="alert alert-success">Personaje eliminado correctamente</div>';
    } else {
        $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al eliminar el personaje: ' . $conn->error . '</div>';
    }
    
    $stmt->close();
}

// Redirigir de vuelta al listado
header("Location: index.php");
exit();
?>
