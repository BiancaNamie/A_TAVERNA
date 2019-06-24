<html>
	<head>
		<?php 
			include_once("../Controller/sessionCheker.php");
			include_once("../Controller/conect.php");
		?>
		<title>Seja bem vindo</title>
		<link rel="stylesheet" href="estilo.css?<?php echo time(); ?>"/>
		<link rel="shortcut icon" type="image/x-icon" href="../icone_a_taverna.ico" />
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
       		function enviar(str){

       			mensagem = document.forms["envio"]["mensagem"].value;  

       			if(str == 'RPG'){
       				mensagem = document.forms["envioRPG"]["mensagem"].value; 
       			}  
				$.ajax({type: 'POST',url: '../Controller/mensagemController.php',data:{request: 'enviar', mensagem: mensagem, idChat: chat}}).done(atualizarScroll(chat));
       		}
       		function enviaArquivo(){
       			var form = $('#formArquivo')[0];
             	arquivo = new FormData(form);
             	arquivo.set('request', 'enviaArquivo');
             	arquivo.set('idSala', sala);
      			 
				$.ajax({type: 'POST',url: '../Controller/arquivoController.php', data:arquivo , processData: false,
                    contentType: false}).done(getArquivo(sala));
       		}
       		function exibeChat(id){
       			var b = document.getElementById('entrada');
       			var c = document.getElementById('entradaRPG');
       			chat = id;
       			b.style.display ='block';
       			c.style.display ='none';
       			clearInterval(interval);
       			interval = setInterval("atualizar("+id+")", 600);
       			atualizarScroll(id);
       		}
       		function exibeChatRPG(id){
       			var b = document.getElementById('entradaRPG');
       			var c = document.getElementById('entrada');
       			chat = id;
       			b.style.display ='block';
       			c.style.display ='none';
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
				sala = id;
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

			function popupDados(){
				$.get("popupDados.php", function(data) {$("#popup").html(data);}).done(submenu("popup"));
			}
			
			function getArquivo(id){	
			  $.get("../Controller/format.php",{request:'arquivosBarraArquivos', id: sala}).done(function(data) {$("#repositorio").html(data);}).done(submenu('cabecalhoRepositorio'));
			}
			function scroll(){
				var objDiv = document.getElementById("corpo");
				objDiv.scrollTop = objDiv.scrollHeight;
			}

			function buscaSala(){
				var string = document.forms["formBuscaSala"]["string"].value;
				$.get("../Controller/format.php",{request:'salasPesquisa', string: string}).done(function(data){$("#areaBuscaSalas").html(data);});
			}

			function pedidoIngresso(idSala){
				$.ajax({type: 'POST',url: '../Controller/participaController.php',data:{request: 'pedido', idSala: idSala}});
			}

			function confirmaIngresso(idNotificacao){
				$.ajax({type: 'POST',url: '../Controller/participaController.php',data:{request:'confirmaIngresso', idn: idNotificacao}}).done(getNotificacoes());
			}

			function pedidoAmizade(id){
				$.ajax({type: 'POST',url: '../Controller/amizadeController.php',data:{request:'pedidoAmizade',id:id}}).done(getNotificacoes());
			}

			function confirmaPedidoAmizade(id){
				$.ajax({type: 'POST',url: '../Controller/amizadeController.php',data:{request:'confirmaPedidoAmizade',id:id}}).done(getNotificacoes());
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
				<div id="cabecalhoRepositorio" style="display: none;">
					<br/><h3>Arquivos da sala</h3>

					<form type= "file" method="Post" enctype="multipart/form-data" action ="../Controller/arquivoController.php" id= 'formArquivo'>
						<input type="file" name="arquivo" accept = 'media_type'><br/>
						<button type = "reset" onclick="enviaArquivo()">Enviar</button>
					</form>
				</div>

				<div id = "repositorio">
				</div>
			</div>
			<div id ="barraChats">
				<h4>Chats</h4>
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
						<textarea rows = 5 cols = 80 class = 'textArea' id = 'mensagem' name='mensagem' class = 'textArea' required autofocus></textarea>
						<button type='reset' class ='botao' onClick="enviar('NRM')">Enviar</button>
					</form>
				</div>
				<div id='entradaRPG' style ="display: none;">
					<br/>
					<form method='post' id="envioRPG">
						<textarea rows = 5 cols = 80 class = 'textArea' id = 'mensagem' name='mensagem' class = 'textArea' required autofocus></textarea>
						
						<button type='reset' class ='botao' onClick="enviar('RPG')">Enviar</button>
						<button type='reset' class ='botao' onClick='popupDados()'>Rolar Dados</button>
						
					</form>
				</div>
				
			</div>
			
		</div>
	</body>
</html>