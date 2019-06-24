 <!DOCTYPE html>
<html>
<head>
	<title> Dados</title>
	<?php session_start();  ?>


	<script type="text/javascript">

		function enviarRolagemDados(mensagem){
			$.ajax({type: 'POST',url: '../Controller/mensagemController.php',data:{request: 'jogarDados', mensagem: mensagem, idChat: chat}}, ).done(atualizarScroll(chat));
       	}

		function rolarDados(){

			numeroDados = new Array();

			numeroDados.push(document.forms['formJogarDados']['D4'].value);
			numeroDados.push(document.forms['formJogarDados']['D6'].value);
			numeroDados.push(document.forms['formJogarDados']['D8'].value);
			numeroDados.push(document.forms['formJogarDados']['D10'].value);
			numeroDados.push(document.forms['formJogarDados']['D12'].value);
			numeroDados.push(document.forms['formJogarDados']['D20'].value);
			numeroDados.push(document.forms['formJogarDados']['D100'].value);
			numeroDados.push(document.forms['formJogarDados']['quantidadeAlternativo'].value);

			valores = [4,6,8,10,12,20,100];
			valores.push(document.forms['formJogarDados']['dadoAlternativo'].value);
			stringFinal="";
			soma=0;
			for(i=0; i<numeroDados.length; i++){
				resultado=0;
				for(j=0; j<numeroDados[i];j++){
					resultado += ((Math.floor(Math.random() * valores[i])+1));
				}
				soma += resultado;
				if(resultado != 0){
					if(stringFinal!= ""){
						stringFinal+=" + ";
					}
					stringGerada= numeroDados[i]+"D"+valores[i];
					stringFinal+=stringGerada;
				}
			}
			stringFinal+=" = ";
			stringFinal+=soma;

			enviarRolagemDados(stringFinal);
			hide('popup');

		}
		
	</script>
</head>

<body>
	<div>
		<div id = 'sair'>
			<button onclick="hide('popup');" style="border-radius: 20px; height:40px; width:40px;">X</button>
		</div>
		<div id= "popupSectionL" class="popupSection" style="width:97% ! important;">
		<form id = "formJogarDados">
			<table>
				<tr align='center'>
					<td rowspan = '2'>Dados</td>
					<td>D4</td>
					<td>D6</td>
					<td>D8</td>
					<td>D10</td>
					<td>D12</td>
					<td>D20</td>
					<td>D100</td>
					<td>Insira o numero de faces</td>
				</tr>
				<tr align='center'>
					<td><img src="D4.png" width=50px height=50px /></td>
					<td><img src="D6.png" width=50px height=50px /></td>
					<td><img src="D8.png" width=50px height=50px /></td>
					<td><img src="D10.png" width=50px height=50px /></td>
					<td><img src="D12.png"  width=50px height=50px /></td>
					<td><img src="D20.png"  width=50px height=50px /></td>
					<td><img src="dezenas.png"  width=50px height=50px /></td>
					<td><input type="number" name="dadoAlternativo" min=0 style="width:50px !important" /></td>
				</tr>
				<tr align='center'>
					<td>Quantidade</td>
					<td><input id = 'D4' type="number" name="D4" min=0 style="width:50px !important" /></td>
					<td><input id = 'D6' type="number" name="D6" min=0 style="width:50px !important" /></td>
					<td><input id = 'D8' type="number" name="D8" min=0 style="width:50px !important" /></td>
					<td><input id = 'D10' type="number" name="D10" min=0 style="width:50px !important" /></td>
					<td><input id = 'D12' type="number" name="D12" min=0 style="width:50px !important" /></td>
					<td><input id = 'D20' type="number" name="D20" min=0 style="width:50px !important" /></td>
					<td><input id = 'D100' type="number" name="D100" min=0 style="width:50px !important" /></td>
					<td><input type="number" name="quantidadeAlternativo" min=0 style="width:50px !important"/></td>
				</tr>			
			</table>
			</form>
			<button onclick="rolarDados()">Rolar Dados</button>
		</div>




		<div id="popupSectionR" class="popupSection" style="width:0% ! important;">
		
		</div>
	</div>

</body>
</html>