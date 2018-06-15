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
      if (count($this->lances) == 0 || $this->podeDarLance($lance->getUsuario())
        ) {
            $this->lances[] = $lance;
        }
    }

    private function podeDarLance(Usuario $usuario){

      $total = $this->contaLancesDo($usuario);

    return $this->pegaUltimoLance()->getUsuario() != $usuario && $total < 5;

    }

    private function contaLancesDo(Usuario $usuario)
    {
        $total = 0;

        foreach ($this->lances as $lanceAtual) {
            if ($lanceAtual->getUsuario() == $usuario){
                $total++;
              }
        }
        return $total;
    }

    public function dobraLance(Usuario $usuario)
    {
      $ultimoLance = $this->ultimoLanceDo($usuario);

      $this->propoe(new Lance($usuario, $ultimoLance->getValor()* 2));
    }

    private function ultimoLanceDo(Usuario $usuario)
    {
      $ultimo = null;
      foreach ($this->lances as $lance) {
        if ($lance->getUsuario()->getNome() == $usuario->getNome()) {
          $ultimo = $lance;
        }

        return $ultimo;
    }
}
    public function pegaUltimoLance()
    {
        return  $this->lances[count($this->lances) -1];
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
