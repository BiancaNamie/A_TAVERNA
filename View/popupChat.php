<!DOCTYPE html>
<html>
<head>
	<title> Opções de Sala</title>
	<?php session_start();  ?>
	<script type = "text/javascript">
		function AtivaSuasSalas(el) {
			var display = document.getElementById(el).style.display;
			if(display == "none")
				document.getElementById(el).style.display = 'block';
				document.getElementById('CriarSala').style.display = 'none';
				document.getElementById('BuscarSalas').style.display = 'none';
		}
		
		function AtivaCriarSala(el) {
			var display = document.getElementById(el).style.display;
			if(display == "none")
				document.getElementById(el).style.display = 'block';
				document.getElementById('BuscarSalas').style.display = 'none';
				document.getElementById('SuasSalas').style.display = 'none';
		}
		
		function AtivaBuscarSalas(el) {
			var display = document.getElementById(el).style.display;
			if(display == "none")
				document.getElementById(el).style.display = 'block';
				document.getElementById('SuasSalas').style.display = 'none';
				document.getElementById('CriarSala').style.display = 'none';
		}
		function AtivaVisualizarSala(el) {
			var display = document.getElementById(el).style.display;
			if(display == "none")
				document.getElementById(el).style.display = 'block';
				document.getElementById('SuasSalas').style.display = 'none';
				document.getElementById('CriarSala').style.display = 'none';
				document.getElementById('BuscarSalas').style.display = 'none';
		}
	</script>
</head>

<body>
	<div>
		<divid id = sair>
			<button onclick="hide('popup');" style="border-radius: 20px; height:40px; width:40px;">X</button>
		</divid>
		<div id= "popupSectionL" class="popupSection" style="width:75% ! important;">

			<div id='Editar Chat' style ="display: block;">

				<h3>Criar Chat<h3/>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>Nome:</td>
							<td><input type="text" value="Seja bem vindo"></td>
						</tr>
						<tr>
							<td>Descrição:</td>
							<td><textarea class = "textArea" style=" width: 100%">Sala super divertida</textarea></td>
						</tr>						
						<tr>
							<td>
								Tipo de Chat:<br/>
								<select>
								  <option value="Chat Simples">Chat simples</option>
								  <option value="Chat RPG">Chat RPG</option>				
								</select>
								<br/>
							</td>
						</tr>
					
					</table>
					<br/>
					<button>Criar Chat</button><br/>

			</div>

			<div id='Editar Chats' style ="display: none;">

				<h3>Editar Chat<h3/>

				<form id = "formBuscaSala">
					<input type="text" name="string">
					<button type="reset" onclick="buscaSala()"> Buscar </button>
				</form>

				<div id="areaBusca">
					
				</div>

			</div>
			
			<div id='CriarSala' style ="display: none;">
				<h3>Excluir Chats</h3>
				<form method="post" action="../Controller/criaSala.php">
					Nome da nova sala <br/>
					<input type="text" name="nome" ><br/><br/>
					Descricao<br/>
					<textarea name="descricao" class = "textArea"></textarea><br/>
					<input type="submit" value="Criar Sala" >
				</form>				
				
			</div>
		</div>




		<div id="popupSectionR" class="popupSection" style="width:19% ! important;">
		
			<button type="button" onclick="popupSala()" class="botao" style="height:50px ! important;" >Voltar</button><br/><br/>

		</div>
	</div>

</body>
</html>