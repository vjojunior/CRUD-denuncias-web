<?php

require_once 'app/models/Denuncia.php';

class DenunciaController {
    private $denunciaModel;

    public function __construct() {
        $this->denunciaModel = new Denuncia();
    }

    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 5;
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $denuncias = $this->denunciaModel->getAll($page, $limit, $search);
        $totalDenuncias = $this->denunciaModel->countAll($search);
        $totalPages = ceil($totalDenuncias / $limit);

        require 'app/views/denuncias/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'titulo' => $_POST['titulo'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'ubicacion' => $_POST['ubicacion'] ?? '',
                'estado' => 'pendiente',
                'ciudadano' => $_POST['ciudadano'] ?? '',
                'telefono_ciudadano' => $_POST['telefono_ciudadano'] ?? ''
            ];

            // Basic validation
            if (empty($data['titulo']) || empty($data['descripcion']) || empty($data['ubicacion']) || empty($data['ciudadano']) || empty($data['telefono_ciudadano'])) {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Todos los campos son requeridos.']);
                return;
            }

            if (!preg_match('/^[0-9]{9}$/', $data['telefono_ciudadano'])) {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'El teléfono del ciudadano debe contener exactamente 9 dígitos numéricos.']);
                return;
            }

            if ($this->denunciaModel->create($data)) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Denuncia creada exitosamente.']);
            } else {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error al crear la denuncia.']);
            }
        }
    }

    public function getDenuncia($id) {
        $denuncia = $this->denunciaModel->find($id);
        if ($denuncia) {
            header('Content-Type: application/json');
            echo json_encode($denuncia);
        } else {
            header('Content-Type: application/json');
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Denuncia no encontrada.']);
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'titulo' => $_POST['titulo'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'ubicacion' => $_POST['ubicacion'] ?? '',
                'estado' => $_POST['estado'] ?? '',
                'ciudadano' => $_POST['ciudadano'] ?? '',
                'telefono_ciudadano' => $_POST['telefono_ciudadano'] ?? ''
            ];

            // Basic validation
            if (empty($data['titulo']) || empty($data['descripcion']) || empty($data['ubicacion']) || empty($data['estado']) || empty($data['ciudadano']) || empty($data['telefono_ciudadano'])) {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Todos los campos son requeridos.']);
                return;
            }

            if (!preg_match('/^[0-9]{9}$/', $data['telefono_ciudadano'])) {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'El teléfono del ciudadano debe contener exactamente 9 dígitos numéricos.']);
                return;
            }

            if ($this->denunciaModel->update($id, $data)) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Denuncia actualizada exitosamente.']);
            } else {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error al actualizar la denuncia.']);
            }
        }
    }

    public function delete($id) {
        if ($this->denunciaModel->delete($id)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
        } else {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['success' => false]);
        }
    }
}
