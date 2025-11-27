<?php
session_start();
require_once(__DIR__ . '/../../models/Prospect.php');
require_once(__DIR__ . '/../../controllers/Prospect/ControllerProspect.php');

use CONTROLLERS\ControllerProspect;

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
    exit;
}

$controller = new ControllerProspect();
$lista = $controller->buscarProspects();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listar Prospects</title>
    <link rel="stylesheet" href="../../libs/bootstrap/css/bootstrap.css">
    <meta charset="utf-8">
</head>
<body class="container mt-4">
    <h2>Lista de Prospects</h2>

    <a href="cadastrarProspect.php" class="btn btn-success mb-3">Novo Prospect</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Celular</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php if(empty($lista)): ?>
            <tr><td colspan="5">Nenhum prospect cadastrado.</td></tr>
        <?php else: ?>
            <?php foreach($lista as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p->codigo) ?></td>
                    <td><?= htmlspecialchars($p->nome) ?></td>
                    <td><?= htmlspecialchars($p->email) ?></td>
                    <td><?= htmlspecialchars($p->celular) ?></td>
                    <td>
                        <a href="editarProspect.php?cod=<?= urlencode($p->codigo) ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="excluirProspect.php?cod=<?= urlencode($p->codigo) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <a href="../main.php" class="btn btn-secondary">Voltar ao menu</a>

    <script src="../../libs/jquery/jquery.min.js"></script>
    <script src="../../libs/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
