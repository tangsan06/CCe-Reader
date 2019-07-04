<?php 
require_once('mascara.php');
require_once('thumb.php');
if(file_exists(urlAtual())){
 	unlink(urlAtual());
 } 

clearstatcache(); 



$arquivo = $_FILES['arquivo'];

$xml = simplexml_load_file($arquivo['tmp_name']);


$evento = $xml->evento->infEvento;
$retEvento = $xml->retEvento->infEvento;



	try{
		$imagem = "thumb.php?img=http://www.keepautomation.com/online_barcode_generator/linear.aspx?TYPE=10&DATA=$evento->chNFe&PROCESS-TILDE=false&UOM=0&X=2&Y=60&ROTATE=0&RESOLUTION=71&FORMAT=png&LEFT-MARGIN=10&RIGHT-MARGIN=10&SHOW-TEXT=true&TEXT-FONT=Arial%7c14%7cRegular";
		transformaImagem($imagem);		
	}catch(PHPexception $e){
		echo 'erro';
	}

?>

<html>
	<head>
		<meta charset="utf-8">
	    <link rel="stylesheet" href="_css/estilo.css">
		<script type="text/javascript" src="_js/jspdf.min.js"></script>
		<script type="text/javascript" src="_js/jquery-1.3.2-vsdoc2.js"></script>
		<script type="text/javascript" src="_js/html2canvas.js"></script>
		<script type="text/javascript">
		<?php
		      if (!($xml && $retEvento && $evento)) {
	           echo "window.location.replace('index.php?erro=1');";
	          }
		?>
			function genPDF(){
				html2canvas(document.getElementById('CartaCorrecao'),{
					onrendered: function (canvas){
						var img = canvas.toDataURL("image/PNG");
						var doc = new jsPDF();
						doc.addImage(img, 'JPEG',2, 0);
						doc.save("<?php echo substr($arquivo['name'],0,-4);?>.pdf");
					}
				})
			}
		</script>
	</head>
	<body>
	   <main id="CartaCorrecao">
		   <section class="container">
		<section class="topo">
			<div id="idEmitente">
				<section id="emitente">
					<p>identificação do emitente</p>
					<h1><?php echo cnpjM((string) $evento->CNPJ);?></h1>
				</section>
			</div>
			<div id="registro">
				<h1>Representação da CCe</h1>
				<p>Id do Evento: <?php echo id((string) $evento["Id"]);?></p>
				<p>Criado em:<?php echo ' '.separaData((string) $evento->dhEvento).' às ';echo separaHora((string) $evento->dhEvento); ?></p>
				<p>protocolo: <?php echo $retEvento->nProt;?>
    - Registrado na SEFAZ em: <?php echo ' '.separaData((string) $retEvento->dhRegEvento).' às ';echo separaHora((string) $retEvento->dhRegEvento);?> </p>
			</div> <br>
			<div class="barras">
				<p class="introducao"><?php echo $introducao;?></p>
				<div class="destinatario">
					<h1 class="cnDest">CNPJ do Destinatário: <?php echo cnpjM((string)$retEvento->CNPJDest).' ';?> -- Nota Fiscal: <?php echo notaFiscal((string)$evento->chNFe);?> Serie <?php echo numeroSerie((string)$evento->chNFe);?> </h1>

				</div>
				<div class="codBarras">
                   <div id="barra">
				   	 <img src="<?php echo $imagem_gerada; ?>"/>
				   </div>
			<div class="barras2">
				<i><?php echo $CondUso?></i>
			</div>
		</section>
			  <section class="mensagem">
				  <h4>Correções a serem consideradas</h4>
				  <div class="carta">
					  <h2><?php echo $evento->detEvento->xCorrecao;?></h2>
					  <p><?php echo $aviso?></p>
				  </div>
			   </section> 
		   </section> 
		</main>
		<section style="width:100%; height: 40px;">
			<article style="width:785px; margin: auto;">
				<input type="submit" value="Gerar PDF" onClick="genPDF();">
			</article>
		</section>
	</body>
</html>