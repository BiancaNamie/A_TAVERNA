<?php
include_once("../Model/usuario.php");


//Verifica se as duas senhas são iguais
if ($_POST['senha'] == $_POST['senha2']){
	
	//Verifica se a senha é segura
	if (preg_match('/[a-z]/', $_POST['senha'])&& preg_match('/[A-Z]/', $_POST['senha']) 
		&& preg_match('/[0-9]/', $_POST['senha'])){
	

		//verifica a data de nascimento  e se é maior de idade
		$dataNasc = explode("-",$_POST["dataNascimento"]);
						
		if ( !checkdate( $dataNasc[1] , $dataNasc[2] , $dataNasc[0] )                   // se a data for inválida
			|| $dataNasc[0] < 1800                                     // ou o ano menor que 1900
			|| mktime( 0, 0, 0,  $dataNasc[1] , $dataNasc[2] , $dataNasc[0] ) > time() )  // ou a data passar de hoje
		{
			?>
				<script language="javascript">;
				alert("Data de nascimento inválida.");
				history.go(-1);
				</script>;
			<?php
		}else{
			$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			$nascimento = mktime( 0, 0, 0,  $dataNasc[1] , $dataNasc[2] , $dataNasc[0] );
			$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
			if ($idade >= 18){
						$Usuario = new Usuario();

						$Usuario->__set("apelido",$_POST['apelido']);
						$Usuario->__set("nome",$_POST['nome']);
						$Usuario->__set("sobrenome",$_POST['sobrenome']);
						$Usuario->__set("dataNascimento",$_POST['dataNascimento']);
						$Usuario->__set("email",$_POST['email']);
						$Usuario->__set("senha",md5($_POST['senha']));

						$Usuario->criar();	
			}else{
				?>
				<script language="javascript">;
				alert("Menores de 18 anos não podem se cadastrar.");
				history.go(-1);
				</script>;
			<?php
			}
		}
	}else{
		?>
			<script language="javascript">;
			alert("A senha precisa de:\n      - no mínimo 8 caracteres \n      - 1 letra maiúscula \n      - 1 letra minúscula \n      - 1 número");
			history.go(-1);
			</script>;
		<?php
	}
			
}else{
	?>
		<script language="javascript">;
		alert("As senhas são diferentes.");
		history.go(-1);
		</script>;
	<?php
}
?>