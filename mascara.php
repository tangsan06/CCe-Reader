<?php
  function mask($val, $mask) {
	$maskared = '';
	$k = 0;
	for ($i = 0; $i <= strlen($mask) - 1; $i++) {
		if ($mask[$i] == '#') {
			if (isset ($val[$k]))
				$maskared .= $val[$k++];
		} else {
			if (isset ($mask[$i]))
				$maskared .= $mask[$i];
		}
	}
	return $maskared;
}


function cnpjM($cnpj){
  echo mask($cnpj,'##.###.###/####-##');
}

function cpfM($cpf){
	return mask($cpf,'###.###.###-##');
}

function cepM ($cep){
	return mask($cep,'#####-###');
}

function dataM($data){
	return mask($data,'##/##/####');
}

function codigoM($codigo){
	return mask($codigo,'#### #### #### #### #### #### #### #### #### #### ####');
}

function notaM($nota){
	return mask($nota, '###.###.###');
}

function id($id){
	$novo = '';
	$k = 2;
	
	for ($i = 2; $i <= strlen($id) - 1; $i++) {
		$novo .= $id[$i];
	}
	return $novo;
}

function separaData($data){
	$novo = '';
	
	for ($i = 0; $i < 10; $i++) {
		$novo .= $data[$i];
	}
	
	return inverteData($novo);
} 

function separaHora($data){
	$novo = '';
	
	for ($i = 11; $i < 19; $i++) {
		$novo .= $data[$i];
	}
	
	return $novo;
}

function inverteData($data){
    if(count(explode("/",$data)) > 1){
        return implode("-",array_reverse(explode("/",$data)));
    }elseif(count(explode("-",$data)) > 1){
        return implode("/",array_reverse(explode("-",$data)));
    }
}

$introducao = 'De acordo com as determinações legais vigentes, vimos por meio desta comunicar-lhe que a Nota Fiscal, abaixo referenciada, contêm
irregularidades que estão destacadas e suas respectivas correções, solicitamos que sejam aplicadas essas correções ao executar seus
lançamentos fiscais';
$CondUso = "A Carta de Correcao e disciplinada pelo paragrafo 1o-A do art. 7o do Convenio S/N, de 15 
de dezembro de 1970 e pode ser utilizada para regularizacao de erro ocorrido na emissao de documento
fiscal, desde que o erro nao esteja relacionado com: I - as variaveis que determinam o valor do 
imposto tais como: base de calculo, aliquota, diferenca de preco, quantidade, valor da operacao ou da 
prestacao; II - a correcao de dados cadastrais que implique mudanca do remetente ou do destinatario;
III - a data de emissao ou de saida.";

$aviso = 'Este documento é uma representação gráfica da CCe e foi impresso apenas para sua informação e não possui validade fiscal.
A CCe deve ser recebida e mantida em arquivo eletrônico XML e pode ser consultada através dos Portais das SEFAZ.';

	
function notaFiscal($nota){
	$n = 25;
	$novo = '';
	for ($i = $n; $i < 34; $i++) {
		$novo .= $nota[$i];
	}	
	return notaM($novo);	
}	

function numeroSerie($serie){
	$n = 22;
	$novo = '';
	for ($i = $n; $i < 25; $i++) {
		$novo .= $serie[$i];
	}	
	return $novo;	
}

function UrlAtual(){
 $dominio= $_SERVER['HTTP_HOST'];
 $url = "http://" . $dominio. $_SERVER['REQUEST_URI'];
 return $url;
 }

?>