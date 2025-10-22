<?php
namespace DAO;

mysqli_report(MYSQLI_REPORT_STRICT);

require_once('../models/Usuario.php');

use models\Usuario;

/**
 * Esta classe é responsável por fazer a comunicação com o banco de dados, provendo as funções de logar e incluir um novo usuário
 * 
 * @author Luis Weber
 */
class DAOUsuario{
    /**
     * Esta função realiza o login do usuário no sistema.
     * @param string $login Login do usuário
     * @param string $senha Senha do usuário
     * @return Usuario 
     */
    public function logar($login, $senha){
        try{
            $conn = $this->conectarBanco();
        }catch(\Exception $e){
            die($e->getMessage());
        }
        
        $usuario = new Usuario();

        $sql = $conn->prepare('SELECT 
                                    login, 
                                    nome, 
                                    email, 
                                    celular 
                                FROM usuario
                                WHERE login = ? AND senha = ?');
        $sql -> bind_param('ss', $login, $senha);
        $sql -> execute();

        $resutado = $sql -> get_result();

        if($resutado -> num_rows === 0){
            $usuario -> addUsuario(null, null, null, null, FALSE);
        }else{
            $tupla = $resutado -> fetch_assoc();
            $usuario -> addUsuario($tupla['login'], $tupla['nome'], $tupla['email'], $tupla['celular'], TRUE);
        }

        $sql -> close();
        $conn -> close();

        return $usuario;
    }

    private function conectarBanco(){
        require_once('config.php');
        try{
            $conexao = new \MySQLi($dbhost, $user, $password, $banco);
            return $conexao;
        }catch(\mysqli_sql_exception $e){
            throw new \Exception($e);
            die;
        }
    }
}

?>