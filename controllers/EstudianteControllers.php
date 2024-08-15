<?php


include '../config/db.php';
include '../models/Estudiante.php';

$estudiante = new Estudiante($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'crear':
                $estudiante->crear($_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['fecha_nacimiento']);
                echo "Estudiante creado exitosamente.";
                break;
            case 'actualizar':
                $estudiante->actualizar($_POST['estudiante_id'], $_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['fecha_nacimiento']);
                echo "Estudiante actualizado exitosamente.";
                break;
            case 'eliminar':
                $estudiante->eliminar($_POST['estudiante_id']);
                echo "Estudiante eliminado exitosamente.";
                break;
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $estudianteDatos = $estudiante->leerPorId($_GET['id']);
        echo json_encode($estudianteDatos);
    } else {
        $estudiantes = $estudiante->leerTodos();
        echo json_encode($estudiantes);
    }
}
?>
