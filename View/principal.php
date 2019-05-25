<html>
	<head>
		<?php 
			session_start();
			include_once("../Controller/sessionCheker.php");
		?>
		<title>Seja bem vindo</title>
		<link rel="stylesheet" href="estilo.css?<?php echo time(); ?>"/>
	</head>
	<body>
		<div id= "conteudo">
			<div id="cabeçalho">
				<?php
					echo $_SESSION['usuario'];
				?>
				<a href="../Controller/logout.php">Sair</a>
			</div>
			
			<div id="barraLateral">
				<br/>
				<li id="lista">Home</li>
				<li id="lista"><a href="chat.php">teste1</a></li>
				<li id="lista">teste2</li>
				<li id="lista">teste3</li>
				<li id="lista">teste4</li>
				<li id="lista">teste5</li>
				<li id="lista">teste6</li>
			</div>
			
			<div id="corpo">
				
			</div>
		</div>
	</body>
</html>