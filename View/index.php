<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="estilo.css?<?php echo time(); ?>"/>
		<?php
			session_start();
			if(isset($_SESSION['usuario'])){
				header("Location: principal.php");
				exit();
			}
		?>
		<script type="text/javascript">
			function enviaLogin(){
				var nome = document.forms["formLogin"]["nome"].value;
				var senha = document.forms["formLogin"]["senha"].value;
				

				$.ajax({type: 'POST',url: '../Controller/login.php',data:{nome:nome, senha:senha}});
				
			}
		</script>
	<head/>
		<div id = "conteudo">
			<div id="cabeçalho">
				<h2> A Taverna</h2>
			</div>
			<div id="corpo">
				<form method="POST" id = "formLogin" action="../Controller/login.php">
					Apelido:<br>
					<input type="text" id = "nome" name= "nome"/><br/><br/>
					Senha; <br>
					<input type= "password" id= "senha" name="senha"/><br/><br/>
					<input type="submit" value="entrar" class ="botao"/><br/><br/>
				</form>
				
				<a href="TelaCadastro.php">Cadastro</a>
			</div >
		</div>
	<body>
	</body>
</html>