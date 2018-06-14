<?php

function carregaClasse($nomeDaClasse)
{
    require_once($nomeDaClasse.".php");
}
spl_autoload_register("carregaClasse");
