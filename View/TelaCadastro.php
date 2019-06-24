<!DOCTYPE html/>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Sistema de Cadastro</title>
		<link rel="stylesheet" href="estilo.css" type="text/css">
	</head>
	<body>
		<div class= "container">
			<section>
				<div id= "conteudo">
					<div id="cabeçalho">
						<h1>A TAVERNA - Cadastro de Usuários</h1>
					</div>
				
				
				<div id="corpo">
					<form method= "post" action="../Controller/insereCadastro.php">
						<table width="40%" align="center">
							<tr>
								<td width="10%">Apelido: </td>
								<td><input type="text" name="apelido" class="campo2" maxlength="40" required autofocus /></td>
							</tr>
							<tr>
								<td width="10%">Nome: </td>
								<td><input type="text" name="nome" class="campo2" maxlength="40" required /></td>
							</tr>
							<tr>
								<td width="10%">Sobrenome: </td>
								<td><input type="text" name="sobrenome" class="campo2" maxlength="40" required /></td>
							</tr>
							<tr>
								<td width="10%">Data de nascimento: </td>
								<td><input type="date" name="dataNascimento" class="campo2" required /></td>
							</tr>
							<tr>
								<td width="10%">Email: </td>
								<td><input type="email" name="email" class="campo2" maxlength="40" required /></td>
							</tr>
							<tr>
								<td width="10%">Senha: </td>
								<td><input type="password" name="senha" class="campo2"  min="8" maxlength="40" placeholder="Min 8 caracteres, 1 letra maiuscula, 1 minuscula, 1 numero" required /></td>
							</tr>
							<tr>
								<td width="10%">Confirme sua Senha: </td>
								<td><input type="password" name="senha2" class="campo2" min="8" maxlength="40" required /></td>
							</tr>							
							<br/><br/>
							
							<tr>
								<td></td>
								<td align="center"><input type="submit" value="Salvar" class="botao"/></td>
							</tr>
							<tr>
								<td></td>
								<td><a href="index.php">Voltar para o Login</a></td>
							</tr>
						
						</table>
					</form>
				</div>
				</div>
			</section>
		</div>
	</body>
</html>	