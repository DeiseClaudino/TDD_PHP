<?php
require_once 'carregaClasses.php';

class LeilaoTest extends PHPUnit\Framework\TestCase
{
    public function testDeveProporUmLance()
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



    public function testDobraLance()
    {
        $lance = new Lance("Macbook");

        $jobs = new Usuario("Jobs");
        $gates = new Usuario("Gates");

        $leilao->propoe(new Lance($jobs, 100));
        $leilao->propoe(new Lance($gates, 200));

        $leilao->propoe(new Lance($jobs, 300));
        $leilao->propoe(new Lance($gates, 400));

        $leilao->propoe(new Lance($jobs, 500));
        $leilao->propoe(new Lance($gates, 600));

        $leilao->propoe(new Lance($jobs, 700));
        $leilao->propoe(new Lance($gates, 800));

        $leilao->propoe(new Lance($jobs, 900));


        $leilao->propoe(new Lance($jobs, 1000));

        $dobraLance = new Lance($leilao->getLances()[9]->getValor() * 2);


        $this->assertEquals(10, count($leilao->getLances()));
        $this->assertEquals(2000, $leilao->getLances()[9]->getValor());
    }
}
