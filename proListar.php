<!DOCTYPE html>
<!-- proListar.php -->

<html>

<head>
    <meta charset="UTF-8">
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
            <p>
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
                <div class="w3-container w3-theme">
                    <h2>Listagem de Produtos</h2>
                </div>
                <!-- Acesso ao BD-->
                <?php
                // Cria conexão
                $conn = new mysqli($servername, $username, $password, $database);

                // Verifica conexão 
                if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}

                // Faz Select na Base de Dados
                $sql = "SELECT id_produto, imagem, codigo_barras, descricao_produto, caracteristica_produto, preco_venda, unidade_medida, nome_categoria AS Categoria FROM produto AS P INNER JOIN Categoria AS C ON (P.id_categoria = C.id_categoria) ORDER BY P.id_produto;";
                $result = $conn->query($sql);
                echo "<div class='w3-responsive w3-card-4'>";
                if ($result->num_rows >0) {
                    echo "<table class='w3-table-all'>";
                    echo "	<tr>";
                    echo "	  <th width='10%'>ID</th>";
                    echo "	  <th width='10%'>Imagem</th>";
                    echo "	  <th width='10%'>Código de Barras</th>";
                    echo "	  <th width='10%'>Descrição/Nome</th>";
                    echo "	  <th width='10%'>Característica</th>";
                    echo "	  <th width='1%'>Unidade</th>";
                    echo "	  <th width='5%'>Preço</th>";
                    echo "	  <th width='10%'>Categoria</th>";
                    echo "	  <th width='2%'> </th>";
                    echo "	  <th width='2%'> </th>";
                    echo "	</tr>";
                    // Apresenta cada linha da tabela
                    while ($row = $result->fetch_assoc()) {
                        $data = $row['caracteristica_produto'];
                        $cod = $row["id_produto"];
                        echo "<tr>";
                        echo "<td>";
                        echo $cod;
                        if ($row['imagem']) { ?>
                            <td>
                                <img id="imagemSelecionada" class="w3-circle w3-margin-top" src="data:image/png;base64,<?= base64_encode($row['imagem']) ?>" />
                            </td>
                            <td>
                            <?php
                        } else {
                            ?>
                            <td>
                                <img id="imagemSelecionada" class="w3-circle w3-margin-top" src="imagens/favicon1.png" />
                            </td>
                            <td>
                            <?php
                        }
                        echo $row["codigo_barras"];
                        echo "</td><td>";
                        echo $row["descricao_produto"];
                        echo "</td><td>";
                        echo $data;
                        echo "</td><td>";
                        echo $row["unidade_medida"];
                        echo "</td><td>";
                        echo $row["preco_venda"];
                        echo "</td><td>";
                        echo $row["Categoria"];
                        echo "</td>";
                        //Atualizar e Excluir registro de Veículos
                            ?>
                            <td>
                                <a href='proAtualizar.php?id=<?php echo $cod; ?>'><img src='imagens/Edit.png' title='Editar Produto' width='32'></a>
                            </td>
                            <td>
                                <a href='proExcluir.php?id=<?php echo $cod; ?>'><img src='imagens/Delete.png' title='Excluir Produto' width='32'></a>
                            </td>
                            </tr>
                    <?php
                    }
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<p style='text-align:center'>Erro executando SELECT: " . $conn->connect_error . "</p>";
                }
                $conn->close();
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