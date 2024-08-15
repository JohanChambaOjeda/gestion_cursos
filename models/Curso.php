<?php


class Curso {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function crear($nombre, $descripcion, $fecha_inicio, $fecha_fin) {
        $stmt = $this->pdo->prepare("INSERT INTO Cursos (nombre, descripcion, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $descripcion, $fecha_inicio, $fecha_fin]);
    }

    public function leerTodos() {
        $stmt = $this->pdo->query("SELECT * FROM Cursos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function leerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Cursos WHERE curso_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $descripcion, $fecha_inicio, $fecha_fin) {
        $stmt = $this->pdo->prepare("UPDATE Cursos SET nombre = ?, descripcion = ?, fecha_inicio = ?, fecha_fin = ? WHERE curso_id = ?");
        return $stmt->execute([$nombre, $descripcion, $fecha_inicio, $fecha_fin, $id]);
    }

    public function eliminar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Cursos WHERE curso_id = ?");
        return $stmt->execute([$id]);
    }
}
?>
