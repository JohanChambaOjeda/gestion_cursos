<?php


class Estudiante {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function crear($nombre, $apellido, $email, $fecha_nacimiento) {
        $stmt = $this->pdo->prepare("INSERT INTO Estudiantes (nombre, apellido, email, fecha_nacimiento) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $apellido, $email, $fecha_nacimiento]);
    }

    public function leerTodos() {
        $stmt = $this->pdo->query("SELECT * FROM Estudiantes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function leerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Estudiantes WHERE estudiante_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $apellido, $email, $fecha_nacimiento) {
        $stmt = $this->pdo->prepare("UPDATE Estudiantes SET nombre = ?, apellido = ?, email = ?, fecha_nacimiento = ? WHERE estudiante_id = ?");
        return $stmt->execute([$nombre, $apellido, $email, $fecha_nacimiento, $id]);
    }

    public function eliminar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Estudiantes WHERE estudiante_id = ?");
        return $stmt->execute([$id]);
    }
}
?>
