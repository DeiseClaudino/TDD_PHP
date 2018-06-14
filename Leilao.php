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
        if (count($this->lances) == 0 ||
      $this->lances[count($this->lances) -1 ]->getUsuario()
       != $lance->getUsuario()) {
            $this->lances[] = $lance;
        }
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
