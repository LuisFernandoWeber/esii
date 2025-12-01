<?php
session_start();

require_once('../../models/Prospect.php');
require_once('../../controllers/Prospect/ControllerProspect.php');

use CONTROLLERS\ControllerProspect;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $codigo = $_POST['codigo'] ?? null;

    if ($codigo === null) {
        echo json_encode(['status' => 'erro', 'msg' => 'Código do prospect não informado']);
        exit;
    }

    $controller = new ControllerProspect();

    try {
        $prospect = new \MODELS\Prospect();
        $prospect->addProspect($codigo, null, null, null, null, null);

        $controller->excluirProspect($prospect);

        echo json_encode(['status' => 'sucesso', 'msg' => 'Prospect excluído com sucesso']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'erro', 'msg' => $e->getMessage()]);
    }
}
?>