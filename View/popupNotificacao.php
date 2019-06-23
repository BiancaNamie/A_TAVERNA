<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		<?php session_start();  ?>


		function getNotificacoes(){
			$.get("../Controller/format.php",{request:'notificacoes'}).done(function(data){$("#areaNotificacoes").html(data);});
		}
	</script>
</head>

<body>
	<div>
	<div id = sair>
			<button onclick="hide('popup');" style="border-radius: 20px; height:40px; width:40px;">X</button>
	</div>
	<div class="popupSection" style = "width: 98%; height: 97%;">
		<h3>Suas notificações<h3/>

		<div id="areaNotificacoes" style="overflow: auto;background-color: FFFFFF; width: 90%; height: 80%;">
				
		</div>
	
	</div>
</div>

</body>
</html>
