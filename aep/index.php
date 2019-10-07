<?php

require_once __DIR__."/vendor/autoload.php";

use \Pacote\Pessoa;

$pessoa = new Pessoa('Leandro', '05/05/1992', '90', '1.80', '36105942761');

echo $pessoa->validaCpf();
echo $pessoa->calcularImc();
echo $pessoa->calculaIdade();


