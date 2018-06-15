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

        $this->leiloeiro->avalia($leilao);

        $this->assertEquals(400, $this->leiloeiro->getMaiorLance());
        $this->assertEquals(250, $this->leiloeiro->getMenorLance());
    }

    public function testDeveEntenderLeilaoComApenasUmLance()
    {
        $leilao = new Leilao("Playstation 3 Novo");

        $leilao->propoe(new Lance($this->joao, 1000.0));

        $this->leiloeiro->avalia($leilao);

        $this->assertEquals(1000.0, $this->leiloeiro->getMaiorLance(), 0.00001);
        $this->assertEquals(1000.0, $this->leiloeiro->getMenorLance(), 0.00001);
    }



    public function testpegaOstresLMaiores()
    {
        $construtor = new ConstrutorDeLeilao();
        $leilao = $construtor->para("Playstation 3")
        ->lance($this->joao, 250)
        ->lance($this->renan, 300)
        ->lance($this->felipe, 400)
         ->constroi();
        ;

        $this->leiloeiro->avalia($leilao);

        $maiores = $this->leiloeiro->getTresMaiores();

        $this->assertEquals(3, count($maiores));

        $this->assertEquals($maiores[0]->getValor(), 400);
        $this->assertEquals($maiores[1]->getValor(), 300);
        $this->assertEquals($maiores[2]->getValor(), 250);
    }

    public function tearDown()
    {
        var_dump("fim");
    }
}
