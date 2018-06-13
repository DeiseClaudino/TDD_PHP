<?php

class Avaliador{

  private $maiorDeTodos;
  private $menorDeTodos;

  public function avalia(Leilao $leilao){
    foreach ($leilao->getLances() as $lance) {
      if ($lance->getValor() > $this->maiorDeTodos) {
        $this->maiorDeTodos = $lance->getValor();
      }
    }
  }

  public function getMaiorLance()
  {
    return $this->maiorDeTodos;
  }






}
