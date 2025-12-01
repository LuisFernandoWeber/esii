<?php
session_start();

require_once('../../models/Prospect.php');
require_once('../../controllers/Prospect/ControllerProspect.php');

use CONTROLLERS\ControllerProspect;
use MODELS\Prospect;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $codigo   = $_POST['codigo']   ?? null;
    $nome     = $_POST['nome']     ?? null;
    $email    = $_POST['email']    ?? null;
    $celular  = $_POST['celular']  ?? null;
    $facebook = $_POST['facebook'] ?? null;
    $whatsapp = $_POST['whatsapp'] ?? null;

    if ($codigo === null) {
        echo json_encode(['status' => 'erro', 'msg' => 'Código do prospect não informado']);
        exit;
    }

    $prospect = new Prospect();
    $prospect->addProspect($codigo, $nome, $email, $celular, $facebook, $whatsapp);

    $controller = new ControllerProspect();

    try {
        $controller->salvarProspect($prospect);
        echo json_encode(['status' => 'sucesso', 'msg' => 'Prospect atualizado']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'erro', 'msg' => $e->getMessage()]);
    }
}
?>