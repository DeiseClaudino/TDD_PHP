<?php

require_once 'carregaClasses.php';

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
