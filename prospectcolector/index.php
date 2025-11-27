<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <header>
        <title>Cadastro de Prospects</title>
        <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.css">
        <style>
            .login-form {
                width: 600px;
                margin: 50px auto;
            }
            .login-form form{
                box-shadow: 0px 2px 2px rgb(0, 0, 0, 0, 3);
                padding: 30px;
            }
        </style>
    </header>
    <body>
        <div class="login-form">
            <form class="form-signin" action="controllers/validar_login.php" method="POST">
                <div class="container">
                    <div class="row">
                        <img src="assets/customer.jpg" width="">
                    </div>
                </div>
                <h2 class="text">Login in</h2>
                <div class="form-group">
                    <input name="login" type="text" placeholder="Digite o seu login" required="required">
                </div>
                <div class="form-group">
                    <input name="senha" type="password" placeholder="Digite a sua senha" required="required">
                </div>
                <div>
                    <button class="form-group" type="submit">Entrar</button>
                </div>
            </form>
            <p class="text-center "><a href="views/Usuario/v_incluir_usuario.php">Cadastre-se</p>
            <p class="text-conter text-danger">
                <?php
                    if(isset($_SESSION["erroLogin"])){
                        echo($_SESSION['erroLogin']);
                        unset($_SESSION['erroLogin']);
                    }
                ?>
            </p>
        </div>
    </body>
</html>

