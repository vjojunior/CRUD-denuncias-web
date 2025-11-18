<?php

require_once 'config/database.php';

class Denuncia {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAll($page = 1, $limit = 10, $search = '') {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM denuncias";
        $params = [];

        if (!empty($search)) {
            $sql .= " WHERE titulo LIKE :search OR ciudadano LIKE :search OR ubicacion LIKE :search";
            $params[':search'] = "%$search%";
        }

        $sql .= " ORDER BY fecha_registro DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        foreach ($params as $key => &$val) {
            $stmt->bindParam($key, $val);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll($search = '') {
        $sql = "SELECT COUNT(*) FROM denuncias";
        $params = [];

        if (!empty($search)) {
            $sql .= " WHERE titulo LIKE :search OR ciudadano LIKE :search OR ubicacion LIKE :search";
            $params[':search'] = "%$search%";
        }

        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => &$val) {
            $stmt->bindParam($key, $val);
        }

        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM denuncias WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO denuncias (titulo, descripcion, ubicacion, estado, ciudadano, telefono_ciudadano, fecha_registro) 
                VALUES (:titulo, :descripcion, :ubicacion, :estado, :ciudadano, :telefono_ciudadano, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':titulo' => $data['titulo'],
            ':descripcion' => $data['descripcion'],
            ':ubicacion' => $data['ubicacion'],
            ':estado' => $data['estado'],
            ':ciudadano' => $data['ciudadano'],
            ':telefono_ciudadano' => $data['telefono_ciudadano']
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE denuncias SET 
                    titulo = :titulo, 
                    descripcion = :descripcion, 
                    ubicacion = :ubicacion, 
                    estado = :estado, 
                    ciudadano = :ciudadano, 
                    telefono_ciudadano = :telefono_ciudadano 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':titulo' => $data['titulo'],
            ':descripcion' => $data['descripcion'],
            ':ubicacion' => $data['ubicacion'],
            ':estado' => $data['estado'],
            ':ciudadano' => $data['ciudadano'],
            ':telefono_ciudadano' => $data['telefono_ciudadano']
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM denuncias WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
