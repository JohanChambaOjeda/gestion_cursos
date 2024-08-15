<?php

include '../config/db.php';
include '../models/Curso.php';

$curso = new Curso($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'crear':
                $curso->crear($_POST['nombre'], $_POST['descripcion'], $_POST['fecha_inicio'], $_POST['fecha_fin']);
                echo "Curso creado exitosamente.";
                break;
            case 'actualizar':
                $curso->actualizar($_POST['curso_id'], $_POST['nombre'], $_POST['descripcion'], $_POST['fecha_inicio'], $_POST['fecha_fin']);
                echo "Curso actualizado exitosamente.";
                break;
            case 'eliminar':
                $curso->eliminar($_POST['curso_id']);
                echo "Curso eliminado exitosamente.";
                break;
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $cursoDatos = $curso->leerPorId($_GET['id']);
        echo json_encode($cursoDatos);
    } else {
        $cursos = $curso->leerTodos();
        echo json_encode($cursos);
    }
}
?>
