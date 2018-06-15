<?php

class Avaliador
{
    private $maiorDeTodos = -INF;
    private $menorDeTodos = INF;

    public function avalia(Leilao $leilao)
    {
        if (count($leilao->getLances()) <= 0) {
            throw new \Exception("Um leilão precisa ter pelo menos um lance");
        }
        $total = 0;
        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorDeTodos) {
                $this->maiorDeTodos = $lance->getValor();
            }
            if ($lance->getValor() < $this->menorDeTodos) {
                $this->menorDeTodos = $lance->getValor();
                $total += $lance->getValor();
            }
            $this->pegaOsMaioresNo($leilao);
        }
    }


    public function pegaOsMaioresNo(Leilao $leilao)
    {
        $lances = $leilao->getLances();
        usort($lances, function ($a, $b) {
            if ($a->getValor() == $b->getValor()) {
                return 0;
            }
            return ($a->getValor() < $b->getValor()) ? 1 : -1;
        });

        $this->maiores = array_slice($lances, 0, 3);
    }



    public function getMaiorLance()
    {
        return $this->maiorDeTodos;
    }

    public function getMenorLance()
    {
        return $this->menorDeTodos;
    }

    public function getTresMaiores()
    {
        return $this->maiores;
    }
}
