<?php
require_once('../../models/Prospect.php');
require_once('../../controllers/Prospect/ControllerProspect.php');

use CONTROLLERS\ControllerProspect;

$email = $_GET['email'] ?? null;

$controller = new ControllerProspect();

try {
    $lista = $controller->buscarProspects($email);

    $resultado = [];

    foreach ($lista as $p) {
        $resultado[] = [
            'codigo' => $p->codigo,
            'nome' => $p->nome,
            'email' => $p->email,
            'celular' => $p->celular,
            'facebook' => $p->facebook,
            'whatsapp' => $p->whatsapp
        ];
    }

    echo json_encode($resultado);
} catch (Exception $e) {
    echo json_encode(['status' => 'erro', 'msg' => $e->getMessage()]);
}
?>