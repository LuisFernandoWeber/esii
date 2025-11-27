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

$controller = new ControllerProspect();

if(!isset($_GET['cod'])){
    die("Código não informado.");
}

$codigo = $_GET['cod'];
$dados = $controller->buscarProspects();
$prospect = null;
foreach($dados as $p){
    if($p->codigo == $codigo){
        $prospect = $p;
        break;
    }
}
if(!$prospect){
    die("Prospect não encontrado.");
}

$mensagem = "";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $prospect->nome = trim($_POST['nome'] ?? '');
    $prospect->email = trim($_POST['email'] ?? '');
    $prospect->celular = trim($_POST['celular'] ?? '');
    $prospect->facebook = trim($_POST['facebook'] ?? '');
    $prospect->whatsapp = trim($_POST['whatsapp'] ?? '');

    try{
        $controller->salvarProspect($prospect);
        $mensagem = "Prospect atualizado com sucesso!";
    } catch(Exception $e) {
        $mensagem = "Erro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Prospect</title>
    <link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.css">
    <meta charset="utf-8">
</head>
<body class="container mt-4">
    <h2>Editar Prospect</h2>

    <?php if($mensagem): ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensagem) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" required value="<?= htmlspecialchars($prospect->nome) ?>">
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($prospect->email) ?>">
        </div>

        <div class="form-group">
            <label>Celular:</label>
            <input type="text" name="celular" class="form-control" value="<?= htmlspecialchars($prospect->celular) ?>">
        </div>

        <div class="form-group">
            <label>Facebook:</label>
            <input type="text" name="facebook" class="form-control" value="<?= htmlspecialchars($prospect->facebook) ?>">
        </div>

        <div class="form-group">
            <label>Whatsapp:</label>
            <input type="text" name="whatsapp" class="form-control" value="<?= htmlspecialchars($prospect->whatsapp) ?>">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Salvar alterações</button>
        <a href="listarProspects.php" class="btn btn-secondary mt-3">Voltar</a>
    </form>

    <script src="../../libs/jquery/jquery.min.js"></script>
    <script src="../../libs/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
