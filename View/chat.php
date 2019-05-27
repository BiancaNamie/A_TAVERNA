<?php
	include_once("../Controller/conect.php");
	include_once("../Controller/sessionCheker.php");
	
?>
<html>
	<head>
		<title>A taverna</Title>
		<link rel="stylesheet" href="estilo.css?<?php echo time(); ?>"/>
		<script src="../jquery-3.4.0.min.js" type="text/javascript"></script>
		<script type="text/javascript">
		
			setInterval("atualizar()", 700);

			
			function scroll(){
				var objDiv = document.getElementById("corpo");
				objDiv.scrollTop = objDiv.scrollHeight;
			}
			
			function atualizar(){	
			  $.get("../Controller/bloco.php", function(data) {$("#corpo").html(data);});
			}
			
			
			function enviar(){
				var mensagem = document.forms["envio"]["mensagem"].value;
				$.ajax({type: 'POST',url: '../Controller/enviar.php',data:{mensagem: mensagem}, success: atualizar(), success: scroll});
			}
			
			
		</script>
		
	</head>
	
	<body>
		<div id ="conteudo">
		
			<div id ="cabecalho">
				</br>
				<div id="area_miniatura">
					<img src="imagem_sala.png"  alt="img" class="miniatura">
				</div>
				<div id="titulo">
					<h2>Sala do RPG aleatorio!</h2></br>
				</div>
			</div>
			
			<div id = "corpo">
				<script type="text/javascript">
					atualizar();
					scroll();
				</script>
			
			</div>
			 
			<div id="entrada">
				<form method="post" id="envio">
					<textarea class = "textArea" id = "mensagem" name="mensagem" class = "textArea"></textarea>
					<button type="reset" class ="botao" onClick="enviar()">Enviar</button>
				</form>
			</div>
		
		
		
		</div>
	
	</body>
</html>