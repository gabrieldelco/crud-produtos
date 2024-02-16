<!DOCTYPE html>
<!-- proIncluir.php -->
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

	<!-- Conteúdo Principal: deslocado paa direita em 270 pixels quando a sidebar é visível -->
	<div class="w3-main w3-container" style="margin-left:270px;margin-top:130px;">

		<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
			<!-- h1 class="w3-xxlarge">Contratação de Veículo</h1 -->
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

				// Obtém as dados no banco para um combo box
				$sqlG = "SELECT id_categoria, nome_categoria FROM categoria";
				$result = $conn->query($sqlG);
				$optionsCategoria = array();

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						array_push($optionsCategoria, "\t\t\t<option value='" . $row["id_categoria"] . "'>" . $row["nome_categoria"] . "</option>\n");
					}
				} else {
					echo "Erro executando SELECT: " . $conn->connect_error;
				}
				$conn->close();
				?>
				<div class="w3-responsive w3-card-4">
					<div class="w3-container w3-theme">
						<h2>Informe os dados do novo produto</h2>
					</div>
					<form class="w3-container" action="proIncluir_exe.php" method="post" enctype="multipart/form-data">
						<table class='w3-table-all'>
							<tr>
								<td style="width:50%;">
									<p>
										<label class="w3-text-IE"><b>Descrição</b>*</label>
										<input class="w3-input w3-border w3-light-grey " name="Descricao" id="desc" type="text" maxlength="100" placeholder="Descrição/Nome" title="Descrição ou nome do produto" required>
									</p>
									<p>
										<label class="w3-text-IE"><b>Características</b>*</label>
										<input class="w3-input w3-border w3-light-grey" name="Caracteristicas" type="text" maxlength="1000" title="Características entre 10 e 1000 letras" required>
									</p>
									<p>
										<label class="w3-text-IE"><b>Código de Barras</b></label>
										<input class="w3-input w3-border w3-light-grey " name="Codigo" id="cod" type="text" maxlength="20" placeholder="Ex: 1000003" title="Código de Barras">
									</p>
									<p>
										<label class="w3-text-IE"><b>Preço de Venda</b></label>
										<input class="w3-input w3-border w3-light-grey " name="Preco" id="preco" type="text" maxlength="16" placeholder="Somente números" title="Preço de Venda">
									</p>
									<p>
										<label class="w3-text-IE"><b>Unidade</b></label>
										<input class="w3-input w3-border w3-light-grey " name="Unidade" id="uni" type="text" maxlength="3" title="Unidade">
									</p>
									<p>
										<label class="w3-text-IE"><b>Categoria</b>*</label>
										<select name="Categoria" id="categoria" class="w3-input w3-border w3-light-grey" required>
											<option value=""></option>
											<?php
											foreach ($optionsCategoria as $key => $value) {
												echo $value;
											}
											?>
										</select>
									</p>
								</td>
								<td>
									<p style="text-align:center"><label class="w3-text-IE"><b>Imagem para Identificação: </b></label></p>
									<p style="text-align:center"><img id="imagemSelecionada" src="imagens/favicon1.png" /></p>
									<p style="text-align:center">
										<label class="w3-btn w3-theme">Selecione uma Imagem
											<input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
											<input type="file" id="Imagem" name="Imagem" accept="image/*" onchange="validaImagem(this);">
										</label>
									</p>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="text-align:center">
									<p>
										<input type="submit" value="Salvar" class="w3-btn w3-theme">
										<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='proListar.php'">
									</p>
								</td>
							</tr>
						</table>
					</form>
					<br>
				</div>
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