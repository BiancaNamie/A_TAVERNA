<!DOCTYPE html>
<html>
<head>
	<title> Opções de Sala</title>
</head>
<body>
	<div>
		<divid id = sair>
			<button onclick="hide('popup');" style="border-radius: 20px; height:40px; width:40px;">X</button>
		</divid>
		<div id= "popupSectionL" class="popupSection">
			<h3>Entrar em uma Sala<h3/>

			<form>
				<input type="text" name="nome">
				<button type="reset" onclick="buscaSala()"> Buscar </button>
			</form>

			<div id="areaBusca">
				
			</div>

			<button></button>
	
		</div>




		<div id="popupSectionR" class="popupSection">


			<h3>Criar Sala</h3>
			<form method="post" action="../Controller/criaSala.php">
				Nome da nova sala <br/>
				<input type="text" name="nome" ><br/><br/>
				Descricao<br/>
				<textarea name="descricao" class = "textArea"></textarea><br/>
				<input type="submit" value="Criar Sala" >
			</form>


		</div>
	</div>

</body>
</html>