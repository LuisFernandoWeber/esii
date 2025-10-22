<?php
namespace models;

/**
 * Classe Model de Usuários
 * 
 * @author Luís Weber
 * 
 */

class Usuario{
    /**
     * Login do Usuário
     * @var string
     */
    public $login;

    /**
     * Nome do Usuário
     * @var string
     */
    public $nome;

    /**
     * E-mail do Usuário
     * @var string
     */
    public $email;

    /**
     * Celular do Usuário
     * @var string
     */
    public $celular;

    /**
     * Indica se o Usuário está logado
     * @var boolean
     */
    public $logado;

    /**
     * Função que carrega os atributos da classe do Usuário
     * @param string $login Login do usuário
     * @param string $nome Nome do usuário
     * @param string $email E-mail do usuario
     * @param string $celular celular do usuário
     * @param boolean %logado indica se o usuário está logado
     * @return Void
     */
    public function addUsuario($login, $nome, $email, $celular, $logado){
        $this->login = $login;
        $this->nome = $nome;
        $this->email = $email;
        $this->celular = $celular;
        $this->logado = $logado;
    }
}

?>