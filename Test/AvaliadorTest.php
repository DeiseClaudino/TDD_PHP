<?php

require_once 'carregaClasses.php';


class AvaliadorTest extends PHPUnit\Framework\TestCase
{
    private $leiloeiro;
    private $joao;
    private $renan;
    private $felipe;

    public function setUp()
    {
        $this->leiloeiro = new Avaliador();
        $this->joao = new Usuario("Joao");
        $this->renan = new Usuario("Renan");
        $this->felipe = new Usuario("Felipe");
    }
    
    public function testEmOrdemDecrescente()
    {
        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($this->joao, 300));
        $leilao->propoe(new Lance($this->renan, 400));
        $leilao->propoe(new Lance($this->felipe, 250));

        $leiloeiro->avalia($leilao);

        $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance());
        $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance());
    }

    public function testDeveEntenderLeilaoComApenasUmLance()
    {
        $leilao = new Leilao("Playstation 3 Novo");

        $leilao->propoe(new Lance($joao, 1000.0));

        $leiloeiro->avalia($leilao);

        $this->assertEquals(1000.0, $leiloeiro->getMaiorLance(), 0.00001);
        $this->assertEquals(1000.0, $leiloeiro->getMenorLance(), 0.00001);
    }



    public function testpegaOstresLMaiores()
    {
        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 250));
        $leilao->propoe(new Lance($renan, 300));
        $leilao->propoe(new Lance($felipe, 400));

        $leiloeiro->avalia($leilao);

        $maiores = $leiloeiro->getTresMaiores();

        $this->assertEquals(count($maiores), 3);

        $this->assertEquals($maiores[0]->getValor(), 400);
        $this->assertEquals($maiores[1]->getValor(), 300);
        $this->assertEquals($maiores[2]->getValor(), 250);
    }
}
