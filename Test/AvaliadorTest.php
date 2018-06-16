<?php
require_once 'Usuario.php';
require_once 'Lance.php';
require_once 'Leilao.php';
require_once 'Avaliador.php';
require_once 'ConstrutorDeLeilao.php';
//require_once 'carregaClasses.php';

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
        $construtor = new ConstrutorDeLeilao();

        $leilao = $construtor->para("Playstation 3")

        ->lance($this->joao, 300)
        ->lance($this->renan, 400)
        ->lance($this->felipe, 250)
        ->constroi();

        $this->leiloeiro->avalia($leilao);

        $this->assertEquals(400, $this->leiloeiro->getMaiorLance());
        $this->assertEquals(250, $this->leiloeiro->getMenorLance());
    }

    public function testDeveEntenderLeilaoComApenasUmLance()
    {
        $construtor = new ConstrutorDeLeilao();

        $leilao = $construtor->para("Playstation 3 Novo")
        ->lance($this->joao, 1000.0)
        ->constroi();

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


        $this->leiloeiro->avalia($leilao);

        $maiores = $this->leiloeiro->getTresMaiores();

        $this->assertEquals(3, count($maiores));

        $this->assertEquals($maiores[0]->getValor(), 400);
        $this->assertEquals($maiores[1]->getValor(), 300);
        $this->assertEquals($maiores[2]->getValor(), 250);
    }

    /**
    * @expectedException InvalidArgumentException
    */

    public function testNaoAvaliarSemLance()
      {

        $construtor = new ConstrutorDeLeilao();
        $leilao = $construtor
          ->para("Macbook")
          ->constroi();
          $this->leiloeiro->avalia($leilao);
        }
    }
