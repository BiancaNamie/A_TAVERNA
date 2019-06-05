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
			var interval;

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
       		function enviar(id){
       			var mensagem = document.forms["envio"]["mensagem"].value;
				$.ajax({type: 'POST',url: '../Controller/enviar.php',data:{mensagem: mensagem}}).done(atualizarScroll(id));
       		}
       		function exibeChat(id){
       			var b = document.getElementById('entrada');
       			b.style.display ='block'
       			clearInterval(interval);
       			interval = setInterval("atualizar("+id+")", 600);
       			atualizarScroll(id);
       		}
       		function atualizar(id){	
			  $.get("../Controller/format.php",{request:'mensagens', id:id}).done(function(data) {$("#corpo").html(data);});		  
			}
			function atualizarScroll(id){	
			  $.get("../Controller/format.php",{request:'mensagens', id:id}).done(function(data) {$("#corpo").html(data);}).done(scroll);		  
			}
       		function getSala(){	
			  $.get("../Controller/format.php",{request:'salasBarraLateral'}).done(function(data) {$("#barraLateral").html(data);});
			  getArquivo();
			}
			function getChat(id){
				$.get("../Controller/format.php",{request:'chatsBarraChats', id:id}).done(function(data){$("#barraChats").html(data);});
			}
			function popupSala(){
				$.get("popupSala.php", function(data) {$("#popup").html(data);});
				submenu("popup");
			}
			function getArquivo(id){	
			  $.get("../Controller/format.php",{request:'arquivosBarraArquivos'}).done(function(data) {$("#repositorio").html(data);});
			}
			function scroll(){
				var objDiv = document.getElementById("corpo");
				objDiv.scrollTop = objDiv.scrollHeight;
			}

			function buscaSala(){
				var string = document.forms["formBuscaSala"]["string"].value;
				$.get("../Controller/format.php",{request:'salasPesquisa', string: string}).done(function(data){$("#areaBusca").html(data);});
			}

			getSala();
			
		</script>
	</head>
	<body>
		<div id="popup" style="display: none">
		</div>
		<div id= "conteudo">
			<div id="cabecalho">
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
				</form>
				<div id = "repositorio">
				</div>
			</div>
			<div id ="barraChats">
				
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
						<textarea class = 'textArea' id = 'mensagem' name='mensagem' class = 'textArea' required autofocus></textarea>
						<?php
							echo "<button type='reset' class ='botao' onClick='enviar(".$_SESSION['chat'].")'>Enviar</button>";
						?>
					</form>
				</div>
				
			</div>
			
		</div>
	</body>
</html>