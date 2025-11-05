<?php
namespace test;

require_once(__DIR__ . '/../libs/autoload.php');
require_once(__DIR__ . '/../models/Prospecto.php');
require_once(__DIR__ . '/../DAO/DAOProspect.php');

use PHPUnit\Framework\TestCase;
use models\Prospecto;
use DAO\DAOProspect;

class ProspectTest extends TestCase{ // CORREÇÃO: Nome da classe
   private $dao;

   protected function setUp(): void{
      $this->dao = new DAOProspect();
   } 

   public function testIncluirProspect(){
      $resultado = $this->dao->incluirProspect(
         "Teste Nome",
         "teste_email@exemplo.com",
         "47999998888"
      );

      $this->assertEquals(true, $resultado);
   }

   public function testBuscarProspectsSemEmail(){
      $resultado = $this->dao->buscarProspects();
      $this->assertIsArray($resultado);
   }

   public function testBuscarProspectsComEmail(){
      $resultado = $this->dao->buscarProspects("teste_email@exemplo.com");
      $this->assertIsArray($resultado);
   }

   public function testAtualizarProspect(){
      $resultado = $this->dao->atualizarProspect(
         "Nome Atualizado",
         "atualizado@exemplo.com",
         "47999997777",
         1
      );
      $this->assertEquals(true, $resultado);
   }

   public function testExcluirProspect(){
      $resultado = $this->dao->excluirProspect(1);
      $this->assertEquals(true, $resultado);
   }
}
?>
