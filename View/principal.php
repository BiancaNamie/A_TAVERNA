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
			var chat;
			var sala;

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
				$.ajax({type: 'POST',url: '../Controller/enviar.php',data:{mensagem: mensagem}}, ).done(atualizarScroll(chat));
       		}
       		function enviaArquivo(){
       			var form = $('#formArquivo')[0];
             	arquivo = new FormData(form);
      			 
				$.ajax({type: 'POST',url: '../Controller/enviaArquivo.php', data:arquivo , processData: false,
                    contentType: false});
       		}
       		function exibeChat(id){
       			var b = document.getElementById('entrada');
       			chat = id;
       			b.style.display ='block';
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
			}
			function getChat(id){
				$.get("../Controller/format.php",{request:'chatsBarraChats', id:id}).done(function(data){$("#barraChats").html(data);}).done(getArquivo());
			}
			function popupSala(){
				$.get("popupSala.php", function(data) {$("#popup").html(data);});
				submenu("popup");
			}
			function popupChat(id){
				$.get("popupChat.php", function(data) {$("#popup").html(data);});
				submenu("popup");
			}
			function popupAmigos(){
				$.get("popupAmigos.php", function(data) {$("#popup").html(data);});
				submenu("popup");
			}
			function popupPerfil(){
				$.get("popupPerfil.php", function(data) {$("#popup").html(data);}).done(submenu("popup"));
			}
			function popupNotificacao(){
				$.get("popupNotificacao.php", function(data) {$("#popup").html(data);}).done(
					getNotificacoes()).done(submenu("popup"));
				
			}
			function getNotificacoes(){
				$.get("../Controller/format.php",{request:'notificacoes'}).done(function(data){$("#areaBusca").html(data);});
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

			function pedidoIngresso(idSala){
				$.ajax({type: 'POST',url: '../Controller/EnviarPedidoIngresso.php',data:{idSala: idSala}});
			}

			function insereParticipa(idUsuario, idSala, tipo){
				$.ajax({type: 'POST',url: '../Controller/insereParticipa.php',data:{idUsuario: idUsuario, idSala: idSala, tipo: tipo}});
			}


			function pedidoAmizade(id){
				$.ajax({type: 'POST',url: '../Controller/amizadeController.php',data:{request:'pedidoAmizade',id:id}});
			}

			function confirmaPedidoAmizade(id){
				$.ajax({type: 'POST',url: '../Controller/amizadeController.php',data:{request:'confirmaPedidoAmizade',id:id}});
			}

			function BuscaAmigo(){
				var string = document.forms['formBuscaAmigos']['string'].value;

				$.get("../Controller/format.php",{request:'usuarioBusca', string:string}).done(function(data) {$("#areaBuscaAmigos").html(data);});
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
				<a href=# onclick="popupSala()"> salas e chats</a> | 
				<a href=# onclick="popupAmigos()"> amigos</a> |
				<a href=# onclick="popupNotificacao()"> notificações</a> |
				<a href=# onclick="popupPerfil()"> ver perfil</a> |
				<a href="../Controller/logout.php">Sair</a> |

			</div>
			
			<div id="barraLateral">
				
				
			</div>
			<div id="barraLateralDireita">
				<br/><h3>Arquivos da sala</h3>
				<form type= "file" method="Post" enctype="multipart/form-data" action ="../Controller/enviaArquivo.php" id= 'formArquivo'>
					<input type="file" name="arquivo" accept = 'media_type'><br/>
					<!--<input type="submit" name="enviarArquivo"><br/>-->
					<button type = "reset" onclick="enviaArquivo()">Enviar</button>
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
							echo "<button type='reset' class ='botao' onClick='enviar()'>Enviar</button>";
						?>
					</form>
				</div>
				
			</div>
			
		</div>
	</body>
</html>