<?php
require_once __DIR__ . "/../models/Autor.php";
require_once __DIR__ . "/../../config/database.php";

class AutorController {
    public function index() {
        $db = Database::connect();
        $result = $db->query("SELECT * FROM autores");
        $autores = $result->fetchAll(PDO::FETCH_ASSOC);
        include __DIR__ . "/../../views/autores/index.php";
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['nombre'])) {
            $db = Database::connect();
            $stmt = $db->prepare("INSERT INTO autores (nombre) VALUES (:nombre)");
            $stmt->execute(['nombre' => $data['nombre']]);

            echo json_encode(["success" => true, "message" => "Autor agregado exitosamente"]);
        } else {
            echo json_encode(["success" => false, "message" => "Faltan datos"]);
        }
    }

    public function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM autores WHERE id = :id");
        $stmt->execute(['id' => $id]);

        echo json_encode(["success" => true, "message" => "Autor eliminado correctamente"]);
    }
}
?>
