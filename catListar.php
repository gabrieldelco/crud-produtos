<!DOCTYPE html>
<!-- proListar.php -->

<html>

<head>
    <meta charset="UTF-8">
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
                    <h2>Listagem de Categorias</h2>
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
                $sql = "SELECT id_categoria, nome_categoria, descricao_categoria FROM categoria AS C ORDER BY C.id_categoria;";
                $result = $conn->query($sql);
                echo "<div class='w3-responsive w3-card-4'>";
                if ($result->num_rows > 0) {
                    echo "<table class='w3-table-all'>";
                    echo "	<tr>";
                    echo "	  <th width='4%'>ID</th>";
                    echo "	  <th width='4%'>Nome</th>";
                    echo "	  <th width='30%'>Descrição</th>";
                    echo "	  <th width='5%'> </th>";
                    echo "	  <th width='3%'> </th>";
                    echo "	</tr>";
                    // Apresenta cada linha da tabela
                    while ($row = $result->fetch_assoc()) {
                        $cod = $row["id_categoria"];
                        echo "<tr>";
                        echo "<td>";
                        echo $cod;
                        echo "</td><td>";
                        echo $row["nome_categoria"];
                        echo "</td><td>";
                        echo $row["descricao_categoria"];
                        echo "</td>";
                       
                        //Atualizar e Excluir registro de Veículos
                            ?>
                            <td>
                                <a href='catAtualizar.php?id=<?php echo $cod; ?>'><img src='imagens/Edit.png' title='Editar Produto' width='32'></a>
                            </td>
                            <td>
                                <a href='catExcluir.php?id=<?php echo $cod; ?>'><img src='imagens/Delete.png' title='Excluir Produto' width='32'></a>
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