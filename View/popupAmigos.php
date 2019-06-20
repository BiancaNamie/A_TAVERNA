<!DOCTYPE html>
<html>
<head>
	<title> Opções de Sala</title>
	<?php session_start();  ?>
	<script type = "text/javascript">
		function AtivaSeusAmigos(el) {
			var display = document.getElementById(el).style.display;
			if(display == "none")
				document.getElementById(el).style.display = 'block';
				document.getElementById('BuscarAmigos').style.display = 'none';
		}
		
		function AtivaBuscarAmigos(el) {
			var display = document.getElementById(el).style.display;
			if(display == "none")
				document.getElementById(el).style.display = 'block';
				document.getElementById('SeusAmigos').style.display = 'none';
		}
		
	</script>
</head>

<body>
	<div>
		<divid id = sair>
			<button onclick="hide('popup');" style="border-radius: 20px; height:40px; width:40px;">X</button>
		</divid>
		<div id= "popupSectionL" class="popupSection" style="width:75% ! important;">

			<div id='SeusAmigos' style ="display: block;">

				<h3>Seus Amigos<h3/>

				<div id="areaExibicao">
					
				</div>

			</div>

			<div id='BuscarAmigos' style ="display: none;">

				<h3>Buscar Amigos<h3/>

				<form id = "formBuscaAmigos">
					<input type="text" name="string">
					<button type="reset" onclick="buscaSala()"> Buscar </button>
				</form>

				<div id="areaBusca">
					
				</div>

			</div>
			
		</div>




		<div id="popupSectionR" class="popupSection" style="width:19% ! important;">
		
			<button type="button" onclick="AtivaSeusAmigos('SeusAmigos')" class="botao" style="height:50px ! important;" >Seus Amigos</button><br/><br/>
			
			<button type="button" onclick="AtivaBuscarAmigos('BuscarAmigos')" class="botao" style="height:50px ! important;">Buscar Amigos</button><br/><br/>
		</div>
	</div>

</body>
</html>