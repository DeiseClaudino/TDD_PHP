<?php

require_once 'Usuario.php';
require_once 'Lance.php';
require_once 'Leilao.php';

class AvaliadorTest
{
    public function testa()
    {
        $joao = new Usuario("Joao");
        $renan = new Usuario("Renan");
        $felipe = new Usuario("Felipe");

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 300));
        $leilao->propoe(new Lance($renan, 450));
        $leilao->propoe(new Lance($felipe, 250));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        echo $leiloeiro->getMaiorLance();
    }
}
