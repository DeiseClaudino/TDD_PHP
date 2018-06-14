<?php
require_once 'Usuario.php';
require_once 'Lance.php';
require_once 'Leilao.php';
require_once 'Avaliador.php';

class LeilaoTest extends PHPUnit\Framework\TestCase
{
    public function testAceitaLeilaoComUmLance()
    {
        $leilao = new Leilao("Macbook");

        $this->assertEquals(0, count($leilao->getLances()));
        $joao = new Usuario("Joao");

        $leilao->propoe(new Lance($joao, 2000));

        $this->assertEquals(1, count($leilao->getLances()));
        $this->assertEquals(2000, $leilao->getLances()[0]->getValor());
    }

      public function testDeveBarrarDoisLancesSeguidos()
      {
        $leilao = new Leilao("Macbook");

        $joao = new Usuario("Joao");

        $leilao->propoe(new Lance($joao, 2000));
        $leilao->propoe(new Lance($joao, 2500));

        $this->assertEquals(1, count($leilao->getLances()));
        $this->assertEquals(2000, $leilao->getLances()[0]->getValor());
      }








    public function testAceitaLeilaoComVariosLances()
    {
        $joao = new Usuario("Joao");
        $maria = new Usuario("Maria");
        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 2000));
        $leilao->propoe(new Lance($maria, 3000));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiorEsperado = 250;
        $menorEsperado = 250;

        $this->assertEquals(2, count($leilao->getLances()));
        $this->assertEquals(2000, $leilao->getLances()[0]->getValor(), 0.00001);
        $this->assertEquals(3000, $leilao->getLances()[1]->getValor(), 0.00001);
    }
}
