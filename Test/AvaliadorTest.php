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


    public function testDeveCalcularAMedia() {

    $joao = new Usuario("Joao");
    $jose = new Usuario("José");
    $maria = new Usuario("Maria");

    $leilao = new Leilao("Playstation 3 Novo");

    $leilao->propoe(new Lance($maria,300.0));
    $leilao->propoe(new Lance($joao,400.0));
    $leilao->propoe(new Lance($jose,500.0));


    $leiloeiro = new Avaliador();
    $leiloeiro->avalia($leilao);


    $this->assertEquals(400, $leiloeiro->getMedia(), 0.0001);
}



}
