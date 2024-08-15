<?php
include 'config/db.php';
include 'models/Curso.php';

$curso = new Curso($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case 'crear':
            $curso->crear($_POST['nombre'], $_POST['descripcion'], $_POST['fecha_inicio'], $_POST['fecha_fin']);
            break;
        case 'actualizar':
            $curso->actualizar($_POST['curso_id'], $_POST['nombre'], $_POST['descripcion'], $_POST['fecha_inicio'], $_POST['fecha_fin']);
            break;
        case 'eliminar':
            $curso->eliminar($_POST['curso_id']);
            break;
    }
}

$cursos = $curso->leerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Cursos</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <header>
        <h1>Gestión de Cursos</h1>
    </header>
    <main>
        <section>
            <h2>Agregar Curso</h2>
            <form action="index.php" method="POST">
                <input type="hidden" name="accion" value="crear">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>
                
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" required>
                
                <label for="fecha_fin">Fecha de Fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin" required>
                
                <button type="submit">Agregar Curso</button>
            </form>
        </section>

        <section>
            <h2>Lista de Cursos</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cursos as $curso): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($curso['curso_id']); ?></td>
                        <td><?php echo htmlspecialchars($curso['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($curso['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($curso['fecha_inicio']); ?></td>
                        <td><?php echo htmlspecialchars($curso['fecha_fin']); ?></td>
                        <td>
                            <!-- Botones para Editar y Eliminar -->
                            <a href="index.php?editar=<?php echo htmlspecialchars($curso['curso_id']); ?>">Editar</a>
                            <a href="index.php?eliminar=<?php echo htmlspecialchars($curso['curso_id']); ?>">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <?php if (isset($_GET['editar'])): ?>
        <?php
        $cursoEditar = $curso->leerPorId($_GET['editar']);
        ?>
        <section>
            <h2>Actualizar Curso</h2>
            <form action="index.php" method="POST">
                <input type="hidden" name="accion" value="actualizar">
                <input type="hidden" name="curso_id" value="<?php echo htmlspecialchars($cursoEditar['curso_id']); ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cursoEditar['nombre']); ?>" required>
                
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($cursoEditar['descripcion']); ?></textarea>
                
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo htmlspecialchars($cursoEditar['fecha_inicio']); ?>" required>
                
                <label for="fecha_fin">Fecha de Fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo htmlspecialchars($cursoEditar['fecha_fin']); ?>" required>
                
                <button type="submit">Actualizar Curso</button>
            </form>
        </section>
        <?php endif; ?>

        <?php if (isset($_GET['eliminar'])): ?>
        <?php
        $curso->eliminar($_GET['eliminar']);
        header("Location: index.php"); 
        exit;
        ?>
        <?php endif; ?>
    </main>
</body>
</html>

