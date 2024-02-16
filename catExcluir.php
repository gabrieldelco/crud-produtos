<!DOCTYPE html>
<!-- proExcluir.php -->

<html>

<head>
	<title>Categorias</title>
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

				// Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);
				// Verifica conexão
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}

				$id = $_GET['id']; //Obtém a PK do Veículo que será excluído

				// Faz Select na Base de Dados
				$sql = "SELECT id_categoria, nome_categoria, descricao_categoria FROM categoria AS C WHERE id_categoria = $id;";

				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = $conn->query($sql)) {  // Consulta ao BD ok
					if ($result->num_rows == 1) {          // Retorna 1 registro que será deletado  
						$row = $result->fetch_assoc();
						$nome = $row["nome_categoria"];
				?>
						<div class="w3-container w3-theme">
							<h2>Exclusão da Categoria ID = [<?php echo $row['id_categoria']; ?>]</h2>
						</div>
						<form class="w3-container" action="catExcluir_exe.php" method="post" onsubmit="return check(this.form)">
							<input type="hidden" id="Id" name="Id" value="<?php echo $row['id_categoria']; ?>">
							<p>
								<label class="w3-text-IE"><b>Nome da categoria: </b><?php echo $nome; ?></label>
							</p>
							<p>
								<label class="w3-text-IE"><b>Descrição da categoria: </b><?php echo $row['descricao_categoria']; ?></label>
							</p>
							<p>
								<input type="submit" value="Confirma exclusão?" class="w3-btn w3-red">
								<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='catListar.php'">
							</p>
						</form>
					<?php
					} else { ?>
						<div class="w3-container w3-theme">
							<h2>Tentativa de exclusão de Categoria inexistente</h2>
						</div>
						<br>
				<?php }
				} else {
					echo "<p style='text-align:center'>Erro executando DELETE: " . $conn->connect_error . "</p>";
				}
				echo "</div>"; //Fim form
				$conn->close();  //Encerra conexao com o BD
				?>
			</div>
			</p>
		</div>
		<?php require 'geral/sobre.php'; ?>
		<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'geral/rodape.php'; ?>
</body>

</html>