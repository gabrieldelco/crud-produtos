<!DOCTYPE html>
<!-- proAtualizar.php -->

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
				$id = $_GET['id']; // Obtém PK do Veiculo que será atualizado

				// Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}

				// Faz Select na Base de Dados
				$sql = "SELECT id_produto, codigo_barras, imagem, descricao_produto, caracteristica_produto, preco_venda, unidade_medida, id_categoria FROM produto WHERE id_produto = $id";

				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = $conn->query($sql)) {   // Consulta ao BD ok
					if ($result->num_rows == 1) {          // Retorna 1 registro que será atualizado  
						$row = $result->fetch_assoc();

						$categoria = $row['id_categoria'];
						$id_produto = $row['id_produto'];
						$codigo_barras = $row['codigo_barras'];
						$descricao = $row['descricao_produto'];
						$caracteristica = $row['caracteristica_produto'];
						$preco = $row['preco_venda'];
						$unidade = $row['unidade_medida'];
						$imagem          = $row['imagem'];
						$sqlG = "SELECT id_categoria, nome_categoria FROM categoria";
						$result = $conn->query($sqlG);
						$optionsSinist = array();

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								array_push($optionsSinist, "\t\t\t<option value='" . $row["id_categoria"] . "'>" . $row["nome_categoria"] . "</option>\n");
							}
						} else {
							echo "Erro executando SELECT: " . $conn->connect_error;
						}

				?>
						<div class="w3-container w3-theme">
							<h2>Altere os dados do Produto ID = [<?php echo $id_produto; ?>]</h2>
						</div>
						<form class="w3-container" action="proAtualizar_exe.php" method="post" enctype="multipart/form-data">
							<table class='w3-table-all'>
								<tr>
									<td style="width:50%;">
										<p>
											<input type="hidden" id="Id" name="Id" value="<?php echo $id_produto; ?>">
										<p>
											<label class="w3-text-IE"><b>Descrição</b>*</label>
											<input class="w3-input w3-border w3-light-grey " name="Descricao" id="desc" type="text" maxlength="100" placeholder="Descrição/Nome" title="Descrição ou nome do produto" value="<?php echo $descricao; ?>" required>
										</p>
										<p>
											<label class="w3-text-IE"><b>Características</b>*</label>
											<input class="w3-input w3-border w3-light-grey" name="Caracteristicas" type="text" maxlength="1000" title="Características entre 10 e 1000 letras" value="<?php echo $caracteristica; ?>" required>
										</p>
										<p>
											<label class="w3-text-IE"><b>Código de Barras</b></label>
											<input class="w3-input w3-border w3-light-grey " name="Codigo" id="cod" type="text" maxlength="20" placeholder="Ex: 1000003" title="Código de Barras" value="<?php echo $codigo_barras; ?>">
										</p>
										<p>
											<label class="w3-text-IE"><b>Preço de Venda</b></label>
											<input class="w3-input w3-border w3-light-grey " name="Preco" id="preco" type="text" maxlength="16" placeholder="Somente números" title="Preço de Venda" value="<?php echo $preco; ?>">
										</p>
										<p>
											<label class="w3-text-IE"><b>Unidade</b></label>
											<input class="w3-input w3-border w3-light-grey " name="Unidade" id="uni" type="text" maxlength="3" title="Unidade" value="<?php echo $unidade; ?>">
										</p>

										<p><label class="w3-text-IE"><b>Categoria</b>*</label>
											<select name="Categoria" id="Categoria" class="w3-input w3-border w3-light-grey " required>
												<?php
												foreach ($optionsSinist as $key => $value) {
													echo $value;
												}
												?>
											</select>
										</p>

									</td>
									<td>
										<p style="text-align:center"><label class="w3-text-IE"><b>Imagem para Identificação: </b></label></p>
										<?php
										if ($imagem) { ?>
											<p style="text-align:center">
												<img id="imagemSelecionada" class="w3-circle w3-margin-top" src="data:image/png;base64,<?= base64_encode($imagem); ?>" />
											</p>
										<?php
										} else {
										?>
											<p style="text-align:center">
												<img id="imagemSelecionada" class="w3-circle w3-margin-top" src="imagens/favicon1.png" />
											</p>
										<?php
										}
										?>
										<p style="text-align:center"><label class="w3-btn w3-theme">Selecione uma Imagem
												<input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
												<input type="file" id="Imagem" name="Imagem" accept="image/*" onchange="validaImagem(this);" /></label>
										</p>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center">
										<p>
											<input type="submit" value="Alterar" class="w3-btn w3-red">
											<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='proListar.php'">
										</p>
									</td>
								</tr>
							</table>
							<br>
						</form>
					<?php
					} else { ?>
						<div class="w3-container w3-theme">
							<h2>Veículo inexistente</h2>
						</div>
						<br>
				<?php
					}
				} else {
					echo "<p style='text-align:center'>Erro executando UPDATE: " . $conn->connect_error . "</p>";
				}
				echo "</div>"; //Fim form
				$conn->close(); //Encerra conexao com o BD
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