<?php

class Leilao
{
    private $descricao;
    private $lances;

    public function __construct($descricao)
    {
        $this->descricao = $descricao;
        $this->lances = array();
    }

    public function propoe(Lance $lance)
    {
      $total = $this->contaLancesDo($lance->getUsuario());
        if (count($this->lances) == 0 ||
        $this->pegaUltimoLance()->getUsuario()
       != $lance->getUsuario() && $total < 5) {
            $this->lances[] = $lance;
        }
    }

    private function contaLancesDo(Usuario $usuario)
    {
        $total = 0;

        foreach ($this->lances as $lanceAtual) {
            if ($lanceAtual->getUsuario() == $usuario) {
                $total++;
            }
        }
        return $total;
    }


    public function pegaUltimoLance()
    {
        return  $this->lances[count($this->lances) -1 ];
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getLances()
    {
        return $this->lances;
    }
}
