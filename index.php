<html>
	<head>
		<meta charset="utf-8">
		<?php

			if(isset($_GET['erro'])){
				$texto = "Arquivo Invalido! Verifique se esse é um arquivo XML de Carta de Correção e tente novamente";
				$cor = "red";
			} else {
				$texto = "Para começar, abra um arquivo de Carta de Correção (*.xml)";
				$cor = "black";
			}
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<link rel="stylesheet" href="_css/index.css">
		<style type="text/css">
			#informacao{
				color:<?php echo $cor;?>;
			}

			@media screen and (max-width: 480px) {
				.content{
					width: 100%;
				}
			}



		</style>
		<script type="text/javascript">
		$(document).ready(function(){	

			$('#enviar').prop("disabled",true);

			$('#nomeArquivo').change(function() {
				var nome = ($(this).val());
				nome = nome.substring(12,nome.lenght);
   				document.getElementById('file-name').innerHTML = "<p>" + nome + "</p>"; 

   				$('#enviar').prop("disabled",false);

   				document.getElementById('enviar').style = "background-color:gray;";
			});
		});
		</script>
	</head>
	<body>
		<div class='content'>
			<form action="envia.php" method="post" enctype="multipart/form-data">
				<h1>Leitor de CCe</h1>
				<p id="informacao"><?php echo $texto;?></p>
				<article><label for="nomeArquivo" id="Abrir">Abrir arquivo XML</label></article>
				<input type="file" name="arquivo" id="nomeArquivo" accept="text/xml">
				<div id='file-name'></div>
				<input type="submit" id="enviar">
			</form>
		</div>
	</body>
</html>