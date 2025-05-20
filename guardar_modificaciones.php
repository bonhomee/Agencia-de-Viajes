<?php
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Recoger datos del formulario
        $id_usuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];

        // 1. Actualizar usuario
        $stmt = $conn->prepare("UPDATE usuario SET nombre = ?, apellidos = ?, email = ? WHERE id_usuario = ?");
        $stmt->execute([$nombre, $apellidos, $email, $id_usuario]);

        // Comprobar si se ha proporcionado número de pasaporte
        if (!empty($_POST['numero']) && !empty($_POST['pais_exp']) && !empty($_POST['fecha_validez'])) {
            $numero = $_POST['numero'];
            $pais_exp = $_POST['pais_exp'];
            $fecha_validez = $_POST['fecha_validez'];

            // Comprobar si ya existe pasaporte para este usuario
            $stmt_check = $conn->prepare("SELECT COUNT(*) FROM pasaporte WHERE id_usuario = ?");
            $stmt_check->execute([$id_usuario]);
            $existe = $stmt_check->fetchColumn();

            if ($existe > 0) {
                // Actualizar pasaporte existente
                $stmt_update = $conn->prepare("UPDATE pasaporte SET numero = ?, pais_exp = ?, fecha_validez = ? WHERE id_usuario = ?");
                $stmt_update->execute([$numero, $pais_exp, $fecha_validez, $id_usuario]);
            } else {
                // Insertar nuevo pasaporte
                $stmt_insert = $conn->prepare("INSERT INTO pasaporte (numero, pais_exp, fecha_validez, id_usuario) VALUES (?, ?, ?, ?)");
                $stmt_insert->execute([$numero, $pais_exp, $fecha_validez, $id_usuario]);
            }
        }

        header("Location: listado_usuarios.php?mensaje=ok");
        exit;

    } catch (PDOException $e) {
        echo "Error al guardar: " . $e->getMessage();
    }
} else {
    echo "Acceso no permitido.";
}
