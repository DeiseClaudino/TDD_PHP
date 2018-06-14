<?php
require_once 'carregaClasses.php';


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

    public function testDeveDarNoMaximo5Lances()
    {
        $leilao = new Leilao("Macbook");

        $jobs = new Usuario("Jobs");
        $gates = new Usuario("Gates");

        $leilao->propoe(new Lance($jobs, 2000));
        $leilao->propoe(new Lance($gates, 3000));

        $leilao->propoe(new Lance($jobs, 4000));
        $leilao->propoe(new Lance($gates, 5000));

        $leilao->propoe(new Lance($jobs, 6000));
        $leilao->propoe(new Lance($gates, 7000));

        $leilao->propoe(new Lance($jobs, 8000));
        $leilao->propoe(new Lance($gates, 9000));

        $leilao->propoe(new Lance($jobs, 10000));
        $leilao->propoe(new Lance($gates, 11000));

        $leilao->propoe(new Lance($jobs, 12000));

        $this->assertEquals(10, count($leilao->getLances()));
        $this->assertEquals(11000, $leilao->getLances()[9]->getValor());
    }
}
