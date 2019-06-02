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
        		if(e.style.display == 'block')
            		e.style.display = 'none';
        		else
            		e.style.display = 'block';
       		}

       		function exibeChat(){

       			atualizar();
       		}

       		function atualizar(){	
			  $.get("../Controller/bloco.php", function(data) {$("#corpo").html(data);});
			}

       		function getSala(){	
			  $.get("../Controller/salas.php", function(data) {$("#barraLateral").html(data);});
			}
			
			function getChat(id){
				p1 ="#";
				p2="chats";
				sala = p1.concat(id);
				sala = sala.concat(p2);
				$.get("../Controller/chats.php", function(data) {$(sala).html(data);});
			}

			getSala();
			
		</script>
	</head>
	<body>
		<div id= "conteudo">
			<div id="cabeçalho">
				<?php
					echo $_SESSION['usuario'];
				?>
				 |
				<a href=#> criar sala</a> | 
				<a href=#> amigos</a> |
				<a href=#> notificações</a> |
				<a href=#> ver perfil</a> |
				<a href="../Controller/logout.php">Sair</a> |
			</div>
			
			<div id="barraLateral">
				<br/>
				<li id="lista">Home</li>
				<li id="lista"><a href=# onclick = "submenu('barraChats')">teste1</a></li>
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
				<br/><a href=# onclick="exibeChat()">Chat inicial</a>
				<br/><a href="ChatRPG.php">Chat RPG</a>

			</div>

			<div id = "barra inferior">
				
			</div>
			
			<div id="corpo">
				<br/>
				<br/>
				<br/>
				As mensagens dos chats que vc participa aparecerão aqui
				
			</div>
		</div>
	</body>
</html>