<?php

require_once 'Usuario.php';
require_once 'Lance.php';
require_once 'Leilao.php';
require_once 'Avaliador.php';


class AvaliadorTest extends PHPUnit\Framework\TestCase
{
    public function testEmOrdemDecrescente()
    {
        $leilao = new Leilao("Playstation 3");

        $joao = new Usuario("Joao");
        $renan = new Usuario("Renan");
        $felipe = new Usuario("Felipe");

        $leilao->propoe(new Lance($joao, 300));
        $leilao->propoe(new Lance($renan, 400));
        $leilao->propoe(new Lance($felipe, 250));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiorEsperado = 400;
        $menorEsperado = 250;

        $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance());
        $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance());
    }

    public function testAceitaLeilaoComUmLance()
    {
        $joao = new Usuario("Joao");

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 250));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiorEsperado = 250;
        $menorEsperado = 250;

        $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance());
        $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance());
    }

    public function testpegaOstresLMaiores()
    {
        $leilao = new Leilao("Playstation 3");

        $joao = new Usuario("Joao");
        $renan = new Usuario("Renan");
        $felipe = new Usuario("Felipe");



        $leilao->propoe(new Lance($joao, 250));
        $leilao->propoe(new Lance($renan, 300));
        $leilao->propoe(new Lance($felipe, 400));

        $leiloeiro = new Avaliador();

        $leiloeiro->avalia($leilao);

        $maiores = $leiloeiro->getTresMaiores();

        $this->assertEquals(count($maiores), 3);

        $this->assertEquals($maiores[0]->getValor(), 400);
        $this->assertEquals($maiores[1]->getValor(), 300);
        $this->assertEquals($maiores[2]->getValor(), 250);
    }



}

class MatematicaMalucaTest
{
    public function testDeveMultiplicarNumerosMaioresQue30()
    {
        $matematica = new MatematicaMaluca();
        $this->assertEquals(50*4, $matematica->contaMaluca(50));
    }

    public function testDeveMultiplicarNumerosMaioresQue10EMenoresQue30()
    {
        $matematica = new MatematicaMaluca();
        $this->assertEquals(20*3, $matematica->contaMaluca(20));
    }

    public function testDeveMultiplicarNumerosMenoresQue10()
    {
        $matematica = new MatematicaMaluca();
        $this->assertEquals(5*2, $matematica->contaMaluca(5));
    }
}
