<!DOCTYPE html>
<!-- proIncluir_exe.php -->

<html>

<head>
	<title>Produtos</title>
	<link rel="icon" type="image/png" href="imagens/favicon1.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="css/customizes.css">
</head>

<body onload="w3_show_nav('menuProduto')">
	<!-- Inclui MENU.PHP  -->
	<?php require 'geral/menu.php'; ?>
	<?php require 'bd/conectaBD.php'; ?>
	<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
	<div class="w3-main w3-container" style="margin-left:270px;margin-top:130px;">

		<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
			<p class="w3-large">
			<div class="w3-code cssHigh notranslate">
				<!-- Acesso em:-->
				<?php

				date_default_timezone_set("America/Sao_Paulo");
				$data = date("d/m/Y H:i:s", time());
				echo "<p class='w3-small' > ";
				echo "Acesso em: ";
				echo $data;
				echo "</p> "
				?>

				<!-- Acesso ao BD-->
				<?php
				$descricao    = $_POST['Descricao'];
				$caracteristicas     = $_POST['Caracteristicas'];
				$codBarras  = $_POST['Codigo'];
				$precoVenda  = $_POST['Preco'];
				$unidade  = $_POST['Unidade'];
				$categoria   = $_POST['Categoria'];

				// Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);
				// Verifica conexão
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}
				// Faz Select na Base de Dados

				if ($_FILES['Imagem']['size'] == 0) { // Não recebeu uma imagem binária
					$sql = "INSERT INTO produto (descricao_produto, caracteristica_produto, codigo_barras, preco_venda, unidade_medida, id_categoria, Imagem) VALUES ('$descricao','$caracteristicas','$codBarras', '$precoVenda', '$unidade', '$categoria', NULL)";
				} else {                              // Recebeu uma imagem binária
					$imagem = addslashes(file_get_contents($_FILES['Imagem']['tmp_name'])); // Prepara para salvar em BD
					$sql = "INSERT INTO produto (descricao_produto, caracteristica_produto, codigo_barras, preco_venda, unidade_medida, id_categoria, Imagem) VALUES ('$descricao','$caracteristicas','$codBarras', '$precoVenda', '$unidade', '$categoria', '$imagem')";
				}
				?>
				<div class='w3-responsive w3-card-4'>
					<div class="w3-container w3-theme">
						<h2>Inclusão de Novo Produto</h2>
					</div>
					<?php
					if ($result = $conn->query($sql)) {
						echo "<p>&nbsp;Registro cadastrado com sucesso! </p>";
					} else {
						echo "<p style='text-align:center'>Erro executando INSERT: " . $conn->connect_error . "</p>";
					}
					echo "</div>";
					$conn->close();  //Encerra conexao com o BD

					?>
				</div>
			</div>

			<?php require 'geral/sobre.php'; ?>
			<!-- FIM PRINCIPAL -->
		</div>
		<!-- Inclui RODAPE.PHP  -->
		<?php require 'geral/rodape.php'; ?>

</body>

</html>