<?php

include_once("../Model/usuario.php");
session_start();

$confere= false;
//verifica se vai atualizar a senha
if (!empty($_POST['NovaSenha']) && !empty($_POST['NovaSenha2'])){
	if (($_POST['NovaSenha'] != "" ) && ($_POST['NovaSenha2'] != "") ){
		if (preg_match('/[a-z]/', $_POST['NovaSenha'])&& preg_match('/[A-Z]/', $_POST['NovaSenha']) && preg_match('/[0-9]/', $_POST['NovaSenha'])){
			//se as 2 novas senhas forem iguais
			if ($_POST['NovaSenha'] == $_POST['NovaSenha2']){
				$confere=md5($_POST['NovaSenha']);
			}else{
				?>
					<script language="javascript">;
						alert("A nova senha e sua confirmação estão diferentes");
						history.go(-1);
					</script>;
				<?php
			}
		}else{
		?>
			<script language="javascript">;
			alert("A nova senha precisa de:\n      - no mínimo 8 caracteres \n      - 1 letra maiúscula \n      - 1 letra minúscula \n      - 1 número");
			history.go(-1);
			</script>;
		<?php
		}
	}
}

$Usuario = new Usuario();

$Usuario->__set("id",$_SESSION['id']);
$Usuario->__set("apelido",$_POST['apelido']);
$Usuario->__set("nome",$_POST['nome']);
$Usuario->__set("sobrenome",$_POST['sobrenome']);
$Usuario->__set("dataNascimento",$_POST['dataNascimento']);
$Usuario->__set("email",$_POST['email']);
$Usuario->__set("senha",md5($_POST['senha']));


$Usuario->alterar($confere);	

?>