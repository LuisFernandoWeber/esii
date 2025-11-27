<?php
namespace models;

/**
 * Classe Model de Prospecto
 * 
 * @author Luis Weber
 * 
 */

class Prospecto{
    /**
     * Nome do Prospecto
     * @var string
     */
    public $nome;

    /**
     * Email do Prospecto
     * @var string
     */
    public $email;

    /**
     * Celular do Prospecto
     * @var string
     */
    public $celular;

    /**
     * Função que carrega os atributos da classe Prospecto
     * @param string $nome Nome do Prospecto
     * @param string $email Email do Prospecto
     * @param string $celular Celular do Prospecto
     */
    public function addProspecto($nome, $email, $celular){
        $this->cod_prospect = $cod_prospect;
        $this->nome = $nome;
        $this->email = $email;
    }
}



?>