<?php
namespace Pacote;

class Pessoa{

    public $nome;
    public $nascimento;
    public $peso;
    public $altura;
    public $cpf;

    public function __construct($nome, $nascimento, $peso, $altura, $cpf)
    {
        $this->nome = $nome;
        $this->nascimento = $nascimento;
        $this->peso = $peso;
        $this->altura = $altura;
        $this->cpf = $cpf;
    }

    public function validaCpf(){


        $this->cpf = preg_replace('/[^0-9]/is', '', $this->cpf);

        if(strlen($this->cpf) != 11){

            return 'Cpf inválido! Menor de 11 digitos';
        }

        if (preg_match('/(\d)\1{10}/', $this->cpf)) {
            
            return 'CPF inválido sequencia repetida';
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $this->cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($this->cpf{$c} != $d) {
                return 'CPF invalido! <br>';
            }
        }

        $parte_um = substr($this->cpf, 0, 3);
        $parte_dois = substr($this->cpf, 3, 3);
        $parte_tres = substr($this->cpf, 6, 3);
        $parte_quatro = substr($this->cpf, 9, 2);

        $formatarCpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";

        return "CPF: $formatarCpf <br>";
    }

    public function calcularImc(){
 
            $icm = $this->peso / pow($this->altura, '2');
            $icm = number_format($icm,2, '.', '');

            if($icm < 18.5){

                $faixa = 'Magreza';

            }else if(($icm > 18.5) && ($icm < 24.9)){

                $faixa = 'Normal';

            }else if(($icm > 25.0) && ($icm < 29.9)){

                $faixa = 'Sobrepeso';

            }else if(($icm > 30) && ($icm < 39.9)){

                $faixa = 'Obesidade';

            }else if(($icm > 40)){

                $faixa = 'Obesidade grave';

            }

            return "
            Nome: {$this->nome} <br>
            Peso: {$this->peso} Kg <br>
            Altura: {$this->altura} <br>
            Imc: {$icm} <br>
            Classificação: {$faixa}  <br>          
            ";
    }

    public function calculaIdade(){

        $data = explode('/', $this->nascimento);

        if(count($data) == 3){
        $dia = $data[0];
        $mes = $data[1];
        $ano = $data[2];

        $validaData = checkdate($dia, $mes, $ano);
        if($validaData == 1){

        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('y'));

        $diaNascimento = mktime(0, 0, 0, $dia, $mes, $ano);

        $idade = floor((((($hoje - $diaNascimento) / 60) / 60) / 24) / 365.25);

                return "
                Data nascimento: {$this->nascimento} <br>
                Idade: {$idade} Anos
                ";

            }else{

                return 'Data inválida';
            }
        }else{

            return 'Formato da data inválido';
        }

    }

}