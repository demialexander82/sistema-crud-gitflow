<?php
include 'plantilla.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Verificar si se proporcionó un ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Configurar la consulta según si se proporcionó un ID
if ($id > 0) {
    // Obtener un solo personaje
    $sql = "SELECT * FROM personajes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $personajes = $result->fetch_all(MYSQLI_ASSOC);
    $titulo = "Detalles del Personaje";
} else {
    // Obtener todos los personajes
    $result = $conn->query("SELECT * FROM personajes");
    $personajes = $result->fetch_all(MYSQLI_ASSOC);
    $titulo = "Listado de Personajes";
}

// Crear el contenido HTML del PDF
$html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>' . $titulo . '</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #333; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .color-box { 
            display: inline-block; 
            width: 20px; 
            height: 20px; 
            margin-right: 5px; 
            vertical-align: middle; 
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <h1>' . $titulo . '</h1>
    <p>Generado el: ' . date('d/m/Y H:i:s') . '</p>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Tipo</th>
                <th>Nivel</th>
            </tr>
        </thead>
        <tbody>';

foreach ($personajes as $personaje) {
    $html .= '<tr>
                <td>' . $personaje['id'] . '</td>
                <td>' . htmlspecialchars($personaje['nombre']) . '</td>
                <td>
                    <div class="color-box" style="background-color: ' . htmlspecialchars($personaje['color']) . '"></div>
                    ' . htmlspecialchars($personaje['color']) . '
                </td>
                <td>' . htmlspecialchars($personaje['tipo']) . '</td>
                <td>' . $personaje['nivel'] . '</td>
            </tr>';
}

$html .= '</tbody>
    </table>
</body>
</html>';

// Configurar Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Generar el nombre del archivo
$filename = $id > 0 ? 'personaje_' . $id . '.pdf' : 'todos_los_personajes.pdf';

// Descargar el PDF
$dompdf->stream($filename, array("Attachment" => true));

exit();
?>
