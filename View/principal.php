<html>
	<head>
		<?php 
			include_once("../Controller/sessionCheker.php");
			include_once("../Controller/conect.php");
		?>
		<title>Seja bem vindo</title>
		<link rel="stylesheet" href="estilo.css?<?php echo time(); ?>"/>
		<script src="../jquery-3.4.0.min.js" type="text/javascript"></script>

		<script type = "text/javascript">

			//setInterval("getSala()",500);


			function submenu(id){
				var e = document.getElementById(id);
        		if(e.style.display == 'none')
            		e.style.display = 'block';
       		}
       		function hide(id){
       			var e = document.getElementById(id);
       			if(e.style.display == 'block')
            		e.style.display = 'none';

       		}
       		function enviar(){
       			var mensagem = document.forms["envio"]["mensagem"].value;
				$.ajax({type: 'POST',url: '../Controller/enviar.php',data:{mensagem: mensagem}});
       		}
       		function exibeChat(id){
       			
       			var b = document.getElementById('entrada');
       			b.style.display ='block'
       			atualizar(id);
       			var interval;
				$(document).on('ready',function(){interval = setInterval(atualizar(id),3000);});
       		}
       		function atualizar(id){	
			  $.get("../Controller/bloco.php",{id:id}).done(function(data) {$("#corpo").html(data);});
			}

       		function getSala(){	
			  $.get("../Controller/salas.php", function(data) {$("#barraLateral").html(data);});
			}
			function getChat(id){
				var pre = document.getElementById('barraChats').innerHTML;
				$.get("../Controller/chats.php",{id:id}).done(function(data){$("#barraChats").html(data);});
				submenu("barraChats");
				
			}
			function popupSala(){
				$.get("popupSala.php", function(data) {$("#popup").html(data);});
				submenu("popup");
			}

			getSala();
			
		</script>
	</head>
	<body>
		<div id="popup" style="display: none">
		</div>
		<div id= "conteudo">
			<div id="cabeçalho">
				<?php
					echo $_SESSION['usuario'];
				?>
				 |
				<a href=# onclick="popupSala()"> salas</a> | 
				<a href=#> amigos</a> |
				<a href=#> notificações</a> |
				<a href=#> ver perfil</a> |
				<a href="../Controller/logout.php">Sair</a> |
			</div>
			
			<div id="barraLateral">
				
				
			</div>
			<div id="barraLateralDireita">
				<br/><li id="lista">Repositorio</li>
				<form type= "file" method="Post" enctype="multipart/form-data" action ="../Controller/enviaArquivo.php">
					<input type="file" name="arquivo"><br/>
					<input type="submit" name="enviarArquivo"><br/>

					<?php
						$consulta = "select * from arquivo";
						$result = mysqli_query($conn, $consulta);
						while($ln = mysqli_fetch_array($result)){
							$nome = $ln['nome'];
							echo "<br/> <a target = '_blank' href = ../Controller/visualizador.php?id='$ln[id]'>$nome<a/>";
						}
						

					?>

				</form>
			</div>
			<div id ="barraChats" style = "display: none;">
				
			</div>
			<div id="corpo">
				<br/>
				<br/>
				<br/>
				As mensagens dos chats que você participa aparecerão aqui
				
			</div>

			<div id = "barraInferior">
				<div id='entrada' style ="display: none;">
					<br/>
					<form method='post' id='envio'>
						<textarea class = 'textArea' id = 'mensagem' name='mensagem' class = 'textArea'></textarea>
						<button type='reset' class ='botao' onClick='enviar()'>Enviar</button>
					</form>
				</div>
				
			</div>
			
		</div>
	</body>
</html>