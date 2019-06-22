<?php
	include_once("sessionCheker.php");
	include_once("consultas.php");


	function mensagens(){
		$id = $_GET['id'];
		$_SESSION['chat'] = $id;

		$content = new getContent;
		$consulta  = $content->getMensagensFromChat($id);

		while($ln = mysqli_fetch_array($consulta)){
			$usuario = $ln['usuario'];
				$mensagem = $ln['mensagem'];
				if($usuario == $_SESSION['usuario']){
					$float = 'right';
					$from ="";
				}
				else{
					$float = 'left';
					$from = $usuario.'<br/>';
				}
				echo"
					<div id='msgSpacing'>
						<div class ='balao' style= 'float: $float; text-align: left;'>
							$from $mensagem
						</div>
					</div>";
		}
	}

	function salasBarraLateral(){

		$content = new getContent;
		$consulta = $content->getSalasFromUsuario($_SESSION['id']);

		while($ln = mysqli_fetch_array($consulta)){
			$nome = $ln['nome'];
			$id = $ln['id'];
			$sala = "sala$id";
			$chats = $sala.'chats';

			$html= "<br/>
					<div id='sala$id'>".
						'<a href="#" onclick = "getChat('.$id.');">'."$nome <a/>".
					"</div>";
			echo $html;
		}
	}

	function salasPesquisa(){
		$str = $_GET['string'];
		$content = new getContent;
		$consulta = $content->getSalasFromBusca($str);


		while($ln = mysqli_fetch_array($consulta)){
			$nome = $ln['nome'];
			$id = $ln['id'];
			$sala = "sala$id";

			$html= "<br/>
					<div id='sala$id' style= 'width: 100%; overflow: hidden;'>
						<div style='width: 59%; float: left;'><a href='#'>$nome <a/></div>
						<div style=' width: 39%;float: right;'>
							<div style='float: right;'><button onclick= 'pedidoIngresso(".$id.")'>Entrar</button></div>
						</div>
					</div>";
			echo $html;
		}
	}

	function chatsBarraChats(){
		$sala = $_GET['id'];

		$content= new getContent;
		$consulta = $content->getChatsFromSala($sala);

		
		while($ln = mysqli_fetch_array($consulta)){
			$nome = $ln['nome'];
			$id = $ln['id'];

			echo"<br/>
				<div id='$nome' style='position: fixed;'>".
					'<a href="#" onclick = exibeChat('.$id.');>'."$nome <a/>
				</div>";
		}
	}

	function arquivosBarraArquivos(){
		$sala = $_SESSION['sala'];

		$content= new getContent;
		$consulta = $content->getArquivosFromSala($sala);

		
		while($ln = mysqli_fetch_array($consulta)){
			$nome = $ln['nome'];
			echo "<br/> <a target = '_blank' href = ../Controller/visualizador.php?id='$ln[id]'>$nome<a/>";
		}

	}

	function notificacoes(){

		$usuarioId = $_SESSION['id'];
		$content= new getContent;
		$consulta = $content->getNotificacoes($usuarioId);

		while($ln = mysqli_fetch_array($consulta)){

			$id = $ln['Id'];
			$mensagem = $ln['Mensagem'];
			$tipo = $ln['Tipo'];
			$usuarioOrigem = $ln['IdUsuarioOrigem'];
			$sala =$ln['idSala'];

			if($tipo=='PIS'){
				$insere = 'insereParticipa('.$usuarioOrigem.', '.$sala.',"'."NML".'")';
				echo "<div>$mensagem <button onclick='".$insere."'> aceitar</button></div>";
			}
			if($tipo=='PDA'){
				$insere = "confirmaPedidoAmizade($id)";
				echo "<div>$mensagem <button onclick='".$insere."'> aceitar</button></div>";
			}
		}
	}

	function usuarioBusca(){
		$str = $_GET['string'];

		$content = new getContent;
		$consulta = $content->getAmigosFromBusca($str);

		while($ln = mysqli_fetch_array($consulta)){
			$apelido = $ln['apelido'];
			$id = $ln['id'];
			echo "<br/>$apelido <button onclick = 'pedidoAmizade($id)'>Solicitar Amizade</button>";
		}
	}

	function minhasSalas(){

		$content = new getContent;
		$consulta = $content->getSalasFromMinhasSalas();

		while($ln = mysqli_fetch_array($consulta)){
			$nome = $ln['nome'];
			$id = $ln['id'];
			echo "<a href= '#' onclick = 'AtivaVisualizarSala(".$id.")'> $nome <a/><br/>";
		}

	}

	function chatsListaChats($id){
		
		$content= new getContent;
		$consulta = $content->getChatsFromSala($id);

		
		while($ln = mysqli_fetch_array($consulta)){
			$nome = $ln['nome'];
			$id = $ln['id'];

			return "$nome <button onclick='AtivaVisualisarChat(".$id.")'>Editar</button><br/>";
	
		}
	}

	function VisualisarSala(){
		include_once("../Model/sala.php");

		$id = $_GET['id'];
		$sala = new sala;
		$s = $sala-> find($id);
		$n = $s->__get('nome');
		$d = $s->__get('descricao');

		$chats = ListaChats($id);


		echo '<h3>Visualizar Sala</h3>
				
					Nome:  <br/>
					<input type="text" name="nome" id ="nome" value="'.$n.'"><br/><br/>
					Descricao<br/>
					<textarea name="descricao" class = "textArea">'.$d.'</textarea><br/>
					Chats
					<div id="areaExibicaoChats" style="background-color: FFFFFF; width: 90%; height: 30%;">
						'.$chats.'
	
					</div>
					<button onclick="AtivaCriarChat()">adicionar chat</button> ';
	}


	function VisualizarChat(){
		include_once("../Model/chat.php");

		$id = $_GET['id'];
		$chat = new chat;
		$c = $chat-> find($id);
		$n = $c->__get('nome');
		$d = $c->__get('descricao');
		$tipo = $c->__get('tipo');

		$chats = chatsListaChats($id);

		if($tipo == "RPG"){
			$selecao ='<option value="Chat RPG" selected = "selected">Chat RPG</option>';
		}
		else{
			$selecao ='<option value="Chat RPG">Chat RPG</option>';
		}


		$html ='<h3>Visualizar Chat<h3/>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>Nome:</td>
							<td><input type="text" value="'.$n.'"></td>
						</tr>
						<tr>
							<td>Descrição:</td>
							<td><textarea class = "textArea" style=" width: 100%">'.$d.'</textarea></td>
						</tr>						
						<tr>
							<td>
								Tipo de Chat:<br/>
								<select>
								  <option value="Chat Simples">Chat simples</option>
								  '.$selecao.'				
								</select>
								<br/>
							</td>
						</tr>
					
					</table>';
		echo $html;
	}

	function VisualizarAmigos(){
		$content= new getContent;
		$consulta = $content->getAmigosfromAmigos();

		while($ln = mysqli_fetch_array($consulta)){
			$nome = $ln[0];
			echo "$nome <br/>";
		}
	}

	function ListaChats($sala){

		$content= new getContent;
		$consulta = $content->getChatsFromSala($sala);
		$final = '';

		
		while($ln = mysqli_fetch_array($consulta)){
			$nome = $ln['nome'];
			$id = $ln['id'];


			$final =$final. "<br/>
				<div id='$nome' style='position: fixed;'>
					$nome <button onclick='AtivaVisualisarChat($id)'>Editar</button>
				</div>";
		}

		return $final;
	}

	if(isset($_GET['request'])){
		$request = $_GET['request'];

		switch ($request) {
			case 'mensagens':
				mensagens();
				break;
			case 'salasBarraLateral':
				salasBarraLateral();
				break;
			case 'salasPesquisa':
				salasPesquisa();
				break;
			case 'chatsBarraChats':
				chatsBarraChats();
				break;
			case 'arquivosBarraArquivos':
				arquivosBarraArquivos();
				break;
			case 'notificacoes':
				notificacoes();
				break;
			case 'usuarioBusca':
				usuarioBusca();
				break;
			case 'minhasSalas':
				minhasSalas();
				break;
			case 'visualisarSala':
				VisualisarSala();
				break;
			case 'VisualizarChat':
				VisualizarChat();
				break;
			case 'amigos':
				VisualizarAmigos();
				break;
			case 'listaChats':
				ListaChats();
				break;
			default:
				# code...
				break;
		}
	}

  ?>