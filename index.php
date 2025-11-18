<?php

define('BASE_URL', '/prueba/');

require_once 'app/controllers/DenunciaController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$controller = new DenunciaController();

switch ($action) {
    case 'getDenuncia':
        if ($id) {
            $controller->getDenuncia($id);
        } else {
            // Manejar error, id no proporcionado
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID de denuncia no proporcionado.']);
        }
        break;
    case 'create':
        $controller->create();
        break;
    case 'edit':
        if ($id) {
            $controller->edit($id);
        } else {
            // Manejar error, id no proporcionado
            header('Location: ' . BASE_URL);
        }
        break;
    case 'delete':
        if ($id) {
            $controller->delete($id);
        } else {
            // Manejar error, id no proporcionado
            header('Location: ' . BASE_URL);
        }
        break;
    case 'index':
    default:
        $controller->index();
        break;
}
