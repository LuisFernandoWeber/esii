<?php
namespace models;

class Prospecto{
    /**
     * Código do Prospecto
     * @var int
     */
    public $cod_prospect;

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

    public function addProspecto($cod_prospect, $nome, $email, $celular){
        $this->cod_prospect = $cod_prospect;
        $this->nome = $nome;
        $this->email = $email;
        $this->celular = $celular;
    }
}
?>
