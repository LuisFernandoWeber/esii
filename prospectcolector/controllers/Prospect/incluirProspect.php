<?php
require_once('../../models/Prospect.php');
require_once('../../controllers/Prospect/ControllerProspect.php');

use MODELS\Prospect;
use CONTROLLERS\ControllerProspect;

$prospect = new Prospect();
$prospect->addProspect(
   null,
   $_POST['nome'] ?? null,
   $_POST['email'] ?? null,
   $_POST['celular'] ?? null,
   $_POST['facebook'] ?? null,
   $_POST['whatsapp'] ?? null
);

$controller = new ControllerProspect();

try {
    $controller->salvarProspect($prospect);
    echo json_encode(['status' => 'ok']);
} catch (Exception $e) {
    echo json_encode(['status' => 'erro', 'msg' => $e->getMessage()]);
}
?>