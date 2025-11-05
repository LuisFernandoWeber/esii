<?php
namespace DAO;

mysqli_report(MYSQLI_REPORT_STRICT);

require_once('../models/Prospecto.php');

use models\Prospecto;

/**
 * Responsável pela comunicação com o banco de dados, oferecendo operações 
 * CRUD (Create, Read, Update, Delete) para objetos do tipo Prospect.
 * 
 * @author Luis Weber
 */
class DAOProspect{
    /**
     * Esta função  Insere um novo prospect na tabela prospect do banco de dados
     * @param string $nome Nome do prospect
     * @param string $email Email do prospect
     * @param string $celular Celular do prospect
     * @return true|string
     */
    public function incluirProspect($nome, $email, $celular){
        try{
            $conn = $this->conectarBanco();
        }
        catch(\Exception $e){
            return $e->getMessage();
            die;
        }

        $sql = $conn->prepare('INSERT INTO prospect(
                                    nome,
                                    email,
                                    celular
                                )VALUES 
                                (?, ?, ?);
        ');
        $sql -> bind_param('sss', $nome, $email, $celular);
        $sql -> execute();
        
        $sql -> close();
        $conn -> close();

        return True;
    }

    /**
     * Esta função Atualiza os dados de um prospect existente.
     * @param string $nome Nome do prospect
     * @param string $email Email do prospect
     * @param string $celular Celular do prospect
     * @param int $codProspect Código do prospect
     * @return true|string
     */
    public function atualizarProspect($nome, $email, $celular, $codProspect){
        try{
            $conn = $this->conectarBanco();
        }catch(\Exception $e){
            return $e->getMessage();
            die;
        }

        $sql = $conn->prepare('UPDATE prospect
                                SET nome = ?, email = ?, celular = ?
                                WHERE cod_prospect = ?;
        ');
        $sql -> bind_param('sssi', $nome, $email, $celular, $codProspect);
        $sql -> execute();

        $sql -> close();
        $conn -> close();

        return True;
    }

    /**
     * @param int $codProspect Código do prospect
     * @return true|string
     */
    public function excluirProspect($codProspect){
        try{
            $conn = $this->conectarBanco();
        }catch(\Exception $e){
            return $e->getMessage();
            die;
        }

        $sql = $conn->prepare('DELETE FROM prospect
                                WHERE cod_prospect = ?;
        ');
        $sql -> bind_param('i', $codProspect);
        $sql -> execute();

        $sql -> close();
        $conn -> close();

        return True;
    }


    /**
     * Função responsável por Recupera prospects do banco de dados.
     * @param string|null $email Email do prospect
     * @return array
     */
    public function buscarProspects($email = null){
        try{
            $conn = $this->conectarBanco();
        }catch(\Exception $e){
            return $e->getMessage();
            die;
        }

        if ($email){
            $sql = $conn -> prepare('SELECT 
                                        cod_prospect, 
                                        nome, 
                                        email, 
                                        celular
                                    FROM prospect
                                    WHERE email = ?;
            ');
            $sql -> bind_param('s', $email);
        }
        else{
            $sql = $conn -> prepare('SELECT 
                                        cod_prospect, 
                                        nome, 
                                        email, 
                                        celular
                                    FROM prospect;
            ');
        }
        
        $sql -> execute();
        $resultado = $sql -> get_result();
        
        $arrayProspects = [];

        while ($tupla = $resultado -> fetch_assoc()){
            $prospect = new Prospecto();
            $prospect -> addProspecto(
                $tupla['cod_prospect'],
                $tupla['nome'],
                $tupla['email'],
                $tupla['celular']
            );
            $arrayProspects[] = $prospect;
        }

        $sql -> close();
        $conn -> close();

        return $arrayProspects; 
    }


    /**
     * Estabelece a conexão com o banco de dados MySQL.
     * @return \mysqli
     */
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
