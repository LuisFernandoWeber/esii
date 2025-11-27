<?php
session_start();
require_once('../models/Usuario.php');
use MODELS\Usuario;
if(isset($_SESSION['usuario'])){
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bem Vindo ao Sistema</title>
        <link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/bootstrap.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Sistema</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#textoNavbar" aria-controls="textoNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="textoNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                           <a class="nav-link" href="main.php">Home <span class="sr-only">(Página atual)</span></a>
                        </li>

                    </ul>
                    <span class="navbar-text">
                        Bem Vindo:
                        <?php
                        $usuario = unserialize($_SESSION['usuario']);
                        echo htmlspecialchars($usuario->nome);
                        ?>
                    </span>
                </div>
            </nav>
        </header>

        <main class="container mt-4">
            <h1>Bem-vindo ao sistema</h1>
            <p>Use o menu para gerenciar prospects (Cadastrar, Listar, Editar e Excluir).</p>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <a href="prospect/cadastrarProspect.php" class="btn btn-primary btn-block">Cadastrar Prospect</a>
                </div>
                <div class="col-md-4">
                    <a href="prospect/listarProspects.php" class="btn btn-secondary btn-block">Listar Prospects</a>
                </div>
            </div>
        </main>

        <script src="../libs/jquery/jquery.min.js"></script>
        <script src="../libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<?php
}else{
    $_SESSION['erroLogin'] = "Você precisa fazer login para acessar o sistema";
    header("Location: ../index.php");
}
?>
