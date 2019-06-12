<!DOCTYPE html>
<html>
<head>
	<title> Opções de Sala</title>
	<?php session_start();  ?>
	<script type = "text/javascript">
		function AtivaVisualizar(el) {
			var display = document.getElementById(el).style.display;
			if(display == "none")
				document.getElementById(el).style.display = 'block';
				document.getElementById('Editar').style.display = 'none';
				document.getElementById('Excluir').style.display = 'none';
		}
		
		function AtivaEditar(el) {
			var display = document.getElementById(el).style.display;
			if(display == "none")
				document.getElementById(el).style.display = 'block';
				document.getElementById('Visualizar').style.display = 'none';
				document.getElementById('Excluir').style.display = 'none';
		}
		
		function AtivaExcluir(el) {
			var display = document.getElementById(el).style.display;
			if(display == "none")
				document.getElementById(el).style.display = 'block';
				document.getElementById('Editar').style.display = 'none';
				document.getElementById('Visualizar').style.display = 'none';
		}
	</script>
</head>

<body>
	<div>
		<divid id = sair>
			<button onclick="hide('popup');" style="border-radius: 20px; height:40px; width:40px;">X</button>
		</divid>
		<div id= "popupSectionL" class="popupSection" style="width:75% ! important;">
			<div id='Visualizar' style ="display: block;">
	
					<?php 
					echo	"<h3>Visualizar Perfil</h3>";
					echo	"Apelido: ". $_SESSION['apelido']." <br/>";
					echo	"Nome: ".$_SESSION['nome']." <br/>";
					echo	"Sobrenome: ".$_SESSION['sobrenome']." <br/>";
					echo	"Data de Nascimento: ".$_SESSION['dataNascimento']." <br/>";
					echo	"Email: ".$_SESSION['email']." <br/>";
					?>

			</div>

			<div id='Editar' style ="display: none;">
				<h3>Editar Perfil</h3>
				<form method="POST" action="../Controller/editarCadastro.php">
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td>Apelido: </td>
								<td><input type="text" name="apelido" class="campo3" maxlength="50" value=<?php echo $_SESSION['usuario'] ?> Readonly required /></td>
							</tr>
							<tr>
								<td>Nome: </td>
								<td><input type="text" name="nome" class="campo3" maxlength="50" value=<?php echo $_SESSION['nome'] ?> required /></td>
							</tr>
							<tr>
								<td>Sobrenome: </td>
								<td><input type="text" name="sobrenome" class="campo3" maxlength="50" value=<?php echo $_SESSION['sobrenome'] ?> required /></td>
							</tr>
							<tr>
								<td>Data de nascimento: </td>
								<td><input type="date" name="dataNascimento" class="campo3" value=<?php echo $_SESSION['dataNascimento'] ?> required /></td>
							</tr>
							<tr>
								<td>Email: </td>
								<td><input type="email" name="email" class="campo3" maxlength="50" value=<?php echo $_SESSION['email'] ?> required /></td>
							</tr>
							<tr>
								<td>Senha Atual: </td>
								<td><input type="password" name="senha" class="campo3" maxlength="50" placeholder="Digite sua senha" required /></td>
							</tr>

							<br/><br/>
							
							<tr>
								<td></td>
								<td align="center"><input type="submit" value="Salvar" class="botao"/></td>
							</tr>
							
						</table>
					</form>
			</div>
			
			<div id='Excluir' style ="display: none;">				
				<h3>Excluir Perfil</h3>
				Voce tem certeza que deseja excluir seu perfil?<br/>
				Essa é uma ação irreversivel!<br/><br/>
				<table>
					<tr>
						<td><button type="button" onclick="AtivaVisualizar('Visualizar')" class=botao >Cancelar</button></td>
						<td><a href="../Controller/ExcluirPerfil.php"><button class=botao >Confirmar</button></a></td>

					</tr>
				</table>
				
			</div>
		</div>




		<div id="popupSectionR" class="popupSection" style="width:19% ! important;">
		
			<button type="button" onclick="AtivaVisualizar('Visualizar')" class="botao" style="height:50px ! important;" >Visualizar Perfil</button><br/><br/>
			
			<button type="button" onclick="AtivaEditar('Editar')" class="botao" style="height:50px ! important;">Editar Perfil</button><br/><br/>
			
			<button type="button" onclick="AtivaExcluir('Excluir')" class="botao" style="height:50px ! important;">Excluir Perfil</button><br/>	<br/>
		</div>
	</div>

</body>
</html>