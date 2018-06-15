<?php
 //require_once 'ConstrutorDeLeilao.php';
require_once 'carregaClasses.php';


class LeilaoTest extends PHPUnit\Framework\TestCase
{
    public function testDeveProporUmLance()
    {
        $construtor = new ConstrutorDeLeilao();
        $leilao = $construtor->para("Macbook")->constroi();
        $this->assertEquals(0, count($leilao->getLances()));

        $leilao->propoe(new Lance(new Usuario("Steve Jobs"), 2000));

        $this->assertEquals(1, count($leilao->getLances()));
        $this->assertEquals(2000.0, $leilao->getLances()[0]->getValor(), 0.00001);
    }

    public function testDeveBarrarDoisLancesSeguidos()
    {
        $joao = new Usuario("Joao");
        $construtor = new ConstrutorDeLeilao();
        $leilao = $construtor->para("Macbook")
        ->lance($joao, 2000)
        ->lance($joao, 2500)
        ->constroi();

        $this->assertEquals(1, count($leilao->getLances()));
        $this->assertEquals(2000, $leilao->getLances()[0]->getValor());
    }
    public function testDeveDarNoMaximo5Lances()
    {
        $jobs = new Usuario("Jobs");
        $gates = new Usuario("Gates");

        $construtor = new ConstrutorDeLeilao();
        $leilao = $construtor->para("Macbook")

        ->lance($jobs, 2000)
        ->lance($gates, 3000)

        ->lance($jobs, 4000)
        ->lance($gates, 5000)

        ->lance($jobs, 6000)
        ->lance($gates, 7000)

        ->lance($jobs, 8000)
        ->lance($gates, 9000)

        ->lance($jobs, 10000)
        ->lance($gates, 11000)

        ->lance($jobs, 12000)
        ->constroi();

        $this->assertEquals(10, count($leilao->getLances()));
        $ultimo = count($leilao->getLances()) -1;
        $this->assertEquals(11000, $leilao->getLances()[$ultimo]->getValor(), 0.00001);
    }


        public function testDobraLance()
        {
            $jobs = new Usuario("Jobs");
            $gates = new Usuario("Gates");

            $construtor = new ConstrutorDeLeilao();

            $leilao = $construtor->para("Macbook")

            ->lance($gates, 200)
            ->lance($jobs, 300)
            ->constroi();

            $leilao->dobraLance($gates);

            $this->assertEquals(400, $leilao->getLances()[2]->getValor());
        }


        public function testnaoDobraSemLanceAnterior()
        {
            $jobs = new Usuario("Jobs");

            $construtor = new ConstrutorDeLeilao();

            $leilao = $construtor->para("Macbook")->constroi();

            $leilao->dobraLance($jobs);

            $this->assertEquals(0, count($leilao->getLances()));
        }

        public function testNaoAvaliarSemLance()
        {
          $construtor = new ConstrutorDeLeilao();

          $leilao = $construtor->para("Macbook")
          ->constroi();

          $leiloeiro->avalia($leilao);
        }



}
