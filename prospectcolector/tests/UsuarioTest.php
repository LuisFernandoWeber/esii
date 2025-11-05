<?php
namespace test;
require_once('../libs/autoload.php');
require_once('../DAOUsuario.php');
require_once('../models/Usuario.php');

use PHPUnit\Framework\TestCase;
use DAO\DAOUsuario;
use models\Usuario;

class UsuarioTest extends TestCase{
    /**@test */
    public function testlogar(){
        $daoUsuario = new DaoUsuario;
        $usuario = new Usuario();

        $usuario -> addUsuario('paulo', 'Paulo Roberto Córdova', 'paulo@eu.com', '(99)9999-9999', TRUE);
        $this -> assertEquals(
            $usuario, 
            $daoUsuario->logar('paulo', '123')
        );


        unset($usuario);
        unset($daoUsuario);
    }
}
?>
