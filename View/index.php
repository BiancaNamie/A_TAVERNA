<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="estilo.css?<?php echo time(); ?>"/>
		<link rel="shortcut icon" type="image/x-icon" href="../icone_a_taverna.ico" />
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
				

				//$.ajax({type: 'POST',url: '../Controller/login.php',data:{nome:nome, senha:senha}});
				$.ajax({type: 'POST',url: '../Controller/usuarioController.php',data:{request: 'login', nome:nome, senha:senha}});
				
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
					Senha: <br>
					<input type= "password" id= "senha" name="senha"/><br/><br/>
								<?php  if (isset($_GET['msg'])){ 
							echo "<font color='red'>".$_GET['msg']."</font><br/>";
						} ?>
					<input type="submit" value="entrar" class ="botao"/><br/><br/>
				</form>
	
				
				Não possui conta?<a href="TelaCadastro.php">Cadastre-se aqui</a>
			</div >
		</div>
	<body>
	</body>
</html>