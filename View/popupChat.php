<!DOCTYPE html>
<html>
<head>
	<title> Opções de Chat</title>
	<?php session_start();  ?>
	<script type = "text/javascript">
		function AtivaVisualisarChat(id) {

			$.get('../Controller/format.php', {request:'VisualizarChat', id:id}).done(function(data){$('#VisualizarChat').html(data);});

			var display = document.getElementById('VisualizarChat').style.display;
			if(display == "none")
				document.getElementById(el).style.display = 'block';
				document.getElementById('CriarChat').style.display = 'none';
		}

		AtivaVisualisarChat();
	</script>
</head>

<body>
	<div>
		<divid id = sair>
			<button onclick="hide('popup');" style="border-radius: 20px; height:40px; width:40px;">X</button>
		</divid>
		<div id= "popupSectionL" class="popupSection" style="width:75% ! important;">

			<div id='VisualizarChat' style ="display: block;">

				
			</div>

			<div id='CriarChat' style ="display: none;">


			</div>
			
		</div>




		<div id="popupSectionR" class="popupSection" style="width:19% ! important;">
		
			<button type="button" onclick="popupSala()" class="botao" style="height:50px ! important;" >Voltar</button><br/><br/>

		</div>
	</div>

</body>
</html>