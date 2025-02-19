<?php
require_once __DIR__ . "/../models/Libro.php";
require_once __DIR__ . "/../../config/database.php";

class LibroController {
    public function index() {
        $db = Database::connect();
        $result = $db->query("SELECT libros.id, libros.titulo, autores.nombre as autor FROM libros JOIN autores ON libros.autor_id = autores.id");
        $libros = $result->fetchAll(PDO::FETCH_ASSOC);
        include __DIR__ . "/../../views/libros/index.php";
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['titulo']) && isset($data['autor'])) {
            $db = Database::connect();
            $stmt = $db->prepare("INSERT INTO libros (titulo, autor_id) VALUES (:titulo, (SELECT id FROM autores WHERE nombre = :autor))");
            $stmt->execute(['titulo' => $data['titulo'], 'autor' => $data['autor']]);

            echo json_encode(["success" => true, "message" => "Libro agregado exitosamente"]);
        } else {
            echo json_encode(["success" => false, "message" => "Faltan datos"]);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['titulo']) && isset($data['autor'])) {
            $db = Database::connect();
            $stmt = $db->prepare("UPDATE libros SET titulo = :titulo, autor_id = (SELECT id FROM autores WHERE nombre = :autor) WHERE id = :id");
            $stmt->execute(['titulo' => $data['titulo'], 'autor' => $data['autor'], 'id' => $id]);

            echo json_encode(["success" => true, "message" => "Libro actualizado correctamente"]);
        } else {
            echo json_encode(["success" => false, "message" => "Faltan datos"]);
        }
    }

    public function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM libros WHERE id = :id");
        $stmt->execute(['id' => $id]);

        echo json_encode(["success" => true, "message" => "Libro eliminado correctamente"]);
    }
}
?>
