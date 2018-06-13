<?php

require_once 'Usuario.php';
require_once 'Lance.php';
require_once 'Leilao.php';
require_once 'Avaliador.php';

class AvaliadorTest extends PHPUnit_Framework_TestCase
{
    public function test()
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

        $this->assertEquals($leiloeiro->getMaiorLance(), $maiorEsperado);
        $this->assertEquals($leiloeiro->getMenorLance(), $menorEsperado);
    }
}
