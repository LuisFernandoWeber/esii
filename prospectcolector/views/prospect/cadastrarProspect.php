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

$mensagem = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prospect = new Prospect();
    $prospect->codigo = null;
    $prospect->nome = trim($_POST['nome'] ?? '');
    $prospect->email = trim($_POST['email'] ?? '');
    $prospect->celular = trim($_POST['celular'] ?? '');
    $prospect->facebook = trim($_POST['facebook'] ?? '');
    $prospect->whatsapp = trim($_POST['whatsapp'] ?? '');

    $controller = new ControllerProspect();
    try {
        $controller->salvarProspect($prospect);
        $mensagem = "Prospect cadastrado com sucesso!";
    } catch (Exception $e) {
        $mensagem = "Erro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Prospect</title>
    <link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.css">
    <meta charset="utf-8">
</head>
<body class="container mt-4">
    <h2>Cadastrar Prospect</h2>

    <?php if($mensagem): ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensagem) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label>Celular:</label>
            <input type="text" name="celular" class="form-control">
        </div>

        <div class="form-group">
            <label>Facebook:</label>
            <input type="text" name="facebook" class="form-control">
        </div>

        <div class="form-group">
            <label>Whatsapp:</label>
            <input type="text" name="whatsapp" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Salvar</button>
        <a href="../main.php" class="btn btn-secondary mt-3">Voltar</a>
    </form>

    <script src="../../libs/jquery/jquery.min.js"></script>
    <script src="../../libs/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
