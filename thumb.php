<?php
	function transformaImagem($imagem){
		//definição das dimensões da thumb a ser gerada
		$largura = 614;
		$altura  = 85;

		//Nome da miniatura
		$imagem_gerada = explode(".", $imagem);

		//pegamos o conteudo do array e concatenamos a _min.jpg.
		$imagem_gerada = "barras.jpg";

		//criação de uma nova imagem que será a miniatura da original
		$imagem_original = imagecreatefrompng($imagem);

		//pegamos a altura e a largura da imagem original
		$pontoX = imagesx($imagem_original);
		$pontoY = imagesy($imagem_original);

		//criamos o thumbnail  com a função imageCreateTrueColor para suportar um grande numero de cores
		$imagem_fin = imagecreatetruecolor($largura,$altura);

		//copia o conteudo da imagem original para a miniatura
		imagecopyresampled($imagem_fin,$imagem_original,0,0,0,0, $largura+1,$altura+1,$pontoX,$pontoY);
		 
		//salva a imagem
		imagepng($imagem_fin,$imagem_gerada);
	}
?>