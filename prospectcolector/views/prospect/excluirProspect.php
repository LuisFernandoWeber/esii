<?php
session_start();
require_once(__DIR__ . '/../../models/Prospect.php');
require_once(__DIR__ . '/../../controllers/Prospect/ControllerProspect.php');

use MODELS\Prospect;
use CONTROLLERS\ControllerProspect;

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
    exit;
}

if(!isset($_GET['cod'])){
    die("Código não informado.");
}

$prospect = new Prospect();
$prospect->codigo = $_GET['cod'];

$controller = new ControllerProspect();

try {
    $controller->excluirProspect($prospect);
    header("Location: listarProspects.php");
    exit;
} catch (Exception $e){
    die("Erro ao excluir: " . $e->getMessage());
}
