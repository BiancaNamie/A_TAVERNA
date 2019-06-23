<!DOCTYPE html>
<html>
<head>
	<title> Opções de Sala</title>
	<?php session_start();  ?>
	<script type = "text/javascript">

		var salaSelecionada;

		function AtivaSuasSalas(el) {
			var display = document.getElementById(el).style.display;
			if(display == "none"){
				document.getElementById(el).style.display = 'block';
				document.getElementById('CriarSala').style.display = 'none';
				document.getElementById('BuscarSalas').style.display = 'none';
				document.getElementById('VisualizarSala').style.display = 'none';
				document.getElementById('CriarChat').style.display = 'none';
				document.getElementById('VisualizarChat').style.display = 'none';
			}
		
		}
		function AtivaCriarSala(el) {
			var display = document.getElementById(el).style.display;
			if(display == "none"){
				document.getElementById(el).style.display = 'block';
				document.getElementById('SuasSalas').style.display = 'none';
				document.getElementById('BuscarSalas').style.display = 'none';
				document.getElementById('VisualizarSala').style.display = 'none';
				document.getElementById('CriarChat').style.display = 'none';
				document.getElementById('VisualizarChat').style.display = 'none';
			}
		
		}
		function AtivaBuscarSalas(el) {
			var display = document.getElementById(el).style.display;
			if(display == "none"){
				document.getElementById(el).style.display = 'block';
				document.getElementById('SuasSalas').style.display = 'none';
				document.getElementById('CriarSala').style.display = 'none';
				document.getElementById('VisualizarSala').style.display = 'none';
				document.getElementById('CriarChat').style.display = 'none';
				document.getElementById('VisualizarChat').style.display = 'none';
				document.getElementById('VisualizarChat').style.display = 'none';
			}
		}

		function AtivaVisualizarSala(id) {
			salaSelecionada = id;
			$.get('../Controller/format.php',{request: 'visualisarSala', id: id}).done(function(data){$('#VisualizarSala').html(data);});

			var display = document.getElementById('VisualizarSala').style.display;
			if(display == "none"){
				document.getElementById('VisualizarSala').style.display = 'block';
				document.getElementById('SuasSalas').style.display = 'none';
				document.getElementById('CriarSala').style.display = 'none';
				document.getElementById('BuscarSalas').style.display = 'none';
				document.getElementById('CriarChat').style.display = 'none';
				document.getElementById('VisualizarChat').style.display = 'none';
			}
		}

		function AtivaVisualisarChat(id) {

			$.get('../Controller/format.php', {request:'VisualizarChat', id:id}).done(function(data){$('#VisualizarChat').html(data);});

			var display = document.getElementById('VisualizarChat').style.display;
			if(display == "none"){
				document.getElementById('VisualizarChat').style.display = 'block';
				document.getElementById('SuasSalas').style.display = 'none';
				document.getElementById('CriarChat').style.display = 'none';
				document.getElementById('CriarSala').style.display = 'none';
				document.getElementById('BuscarSalas').style.display = 'none';
				document.getElementById('VisualizarSala').style.display = 'none';
			}
		}

		function AtivaCriarChat() {

			var display = document.getElementById('CriarChat').style.display;
			if(display == "none"){
				document.getElementById('CriarChat').style.display = 'block';
				document.getElementById('SuasSalas').style.display = 'none';
				document.getElementById('CriarSala').style.display = 'none';
				document.getElementById('BuscarSalas').style.display = 'none';
				document.getElementById('VisualizarSala').style.display = 'none';
				document.getElementById('VisualizarChat').style.display = 'none';
			}
		}

		function minhasSalas(){
			$.get('../Controller/format.php', {request:'minhasSalas'}).done(function(data){$('#areaExibicao').html(data);});
		}

		function criarSala(){
			idSala = salaSelecionada;
			nome = document.forms['formCriarChat']['nome'].value;
			tipo = document.forms['formCriarChat']['tipo'].value;
			descricao = document.forms['formCriarChat']['descricao'].value;

			$.ajax({type: 'POST',url: '../Controller/chatController.php', data:{request:'insereSala', nome: nome, descricao: descricao, tipo: tipo, idSala: idSala}});
		}

		function updateSala(id){
			nome = document.forms['formEditarSala']['nome'].value;
			descricao = document.forms['formEditarSala']['descricao'].value;

			$.ajax({type: 'POST',url: '../Controller/salaController.php', data:{ request:'updateSala',id: id, nome: nome, descricao: descricao}});
		}

		function updateChat(id){
			nome = document.forms['formEditarChat']['nome'].value;
			descricao = document.forms['formEditarChat']['descricao'].value;
			tipo = document.forms['formEditarChat']['tipo'].value;

			$.ajax({type: 'POST',url: '../Controller/chatController.php', data:{ request:'updateChat',id: id, nome: nome,tipo: tipo ,descricao: descricao}});
		}

		minhasSalas();
	</script>
</head>

<body>
	<div>
		<divid id = sair>
			<button onclick="hide('popup');" style="border-radius: 20px; height:40px; width:40px;">X</button>
		</divid>
		<div id= "popupSectionL" class="popupSection" style="width:75% ! important;">

			<div id='SuasSalas' style ="display: block;">

				<h3>Suas Salas<h3/>

				<div id="areaExibicao" style="background-color: FFFFFF; width: 95%; height: 70%;">
					<a href="#" onclick = "AtivaVisualizarSala('VisualizarSala')"> Super Sala Super Legal<a/><br/>
				</div>

			</div>

			<div id='BuscarSalas' style ="display: none;">

				<h3>Encontre uma sala<h3/>

				<form id = "formBuscaSala">
					<input type="text" name="string">
					<button type="reset" onclick="buscaSala()"> Buscar </button>
				</form>

				<div id="areaBuscaSalas" style="background-color: FFFFFF; width: 90%; height: 75%;">
					
				</div>

			</div>
			
			<div id='CriarSala' style ="display: none;">
				<h3>Criar Sala</h3>
				<form method="post" action="../Controller/criaSala.php">
					Nome da nova sala <br/>
					<input type="text" name="nome" ><br/><br/>
					Descricao<br/>
					<textarea name="descricao" class = "textArea"></textarea><br/>
					<input type="submit" value="Criar Sala" >
				</form>				
				
			</div>

			<div id='VisualizarSala' style ="display: none;">
				<h3>Visualizar Sala</h3>
				
					Nome:  <br/>
					<input type="text" name="nome" id ="nome" value="Super Sala Super Legal"><br/><br/>
					Descricao<br/>
					<textarea name="descricao" class = "textArea"> Sala divertida</textarea><br/>
					Chats
					<div id="areaExibicaoChats" style="background-color: FFFFFF; width: 90%; height: 30%;">
						
	
					</div>
					<button>adicionar chat</button>
			</div>

			<div id='VisualizarChat' style ="display: none;">
				
			</div>

			<div id='CriarChat' style ="display: none;">
				<h3>Criar Chat<h3/>
					<form id = "formCriarChat" method="POST">
						<table border="0" cellspacing="10" cellpadding="0">
							<tr>
								<td>Nome:</td>
								<td><input name = 'nome' type="text"></td>
							</tr>
							<tr>
								<td>Descrição:</td>
								<td><textarea name ='descricao' class = "textArea" style=" width: 100%"></textarea></td>
							</tr>						
							<tr>
								<td>
									Tipo de Chat:<br/>
									<select name = 'tipo'>
									  <option value="NRM">Chat simples</option>
									  <option value="RPG">Chat RPG</option>			
									</select>
									<br/>
								</td>
							</tr>
							<tr>
								<td><button type = "reset" onclick="criarSala()">Criar Chat</button></td>
								<td><button type="reset">Cancelar</button></td>
							</tr>
						
						</table>
					</form>
			</div>


		</div>




		<div id="popupSectionR" class="popupSection" style="width:19% ! important;">
		
			<button type="button" onclick="AtivaSuasSalas('SuasSalas')" class="botao" style="height:50px ! important;" >Suas Salas</button><br/><br/>
			
			<button type="button" onclick="AtivaCriarSala('CriarSala')" class="botao" style="height:50px ! important;">Criar Sala</button><br/><br/>
			
			<button type="button" onclick="AtivaBuscarSalas('BuscarSalas')" class="botao" style="height:50px ! important;">Buscar Sala</button><br/><br/>
		</div>
	</div>

</body>
</html>