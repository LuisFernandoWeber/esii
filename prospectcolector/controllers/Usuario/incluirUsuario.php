<?php
session_start();

require_once('../../controllers/Usuario/ControllerUsuario.php');

use CONTROLLERS\ControllerUsuario;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome  = $_POST['nome']  ?? null;
    $email = $_POST['email'] ?? null;
    $login = $_POST['login'] ?? null;
    $senha = $_POST['senha'] ?? null;

    if ($nome === null || $email === null || $login === null || $senha === null) {
        echo json_encode([
            'status' => 'erro',
            'msg' => 'Parâmetros incompletos!'
        ]);
        exit;
    }

    try {
        $controller = new ControllerUsuario();
        $resultado = $controller->salvarUsuario($nome, $email, $login, $senha);

        echo json_encode([
            'status' => 'sucesso',
            'msg' => 'Usuário cadastrado com sucesso',
            'resultado' => $resultado
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'erro',
            'msg' => $e->getMessage()
        ]);
    }
}
?>