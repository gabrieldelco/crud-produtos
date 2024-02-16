<!DOCTYPE html>
<!-- proIncluir.php -->
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
                <div class="w3-responsive w3-card-4">
                    <div class="w3-container w3-theme">
                        <h2>Informe os dados da nova categoria</h2>
                    </div>
                    <form class="w3-container" action="catIncluir_exe.php" method="post" enctype="multipart/form-data">
                        <table class='w3-table-all'>
                            <tr>
                                <td style="width:50%;">
                                    <p>
                                        <label class="w3-text-IE"><b>Nome</b>*</label>
                                        <input class="w3-input w3-border w3-light-grey " name="NomeCategoria" id="nomecat" type="text" maxlength="100" placeholder="Nome da categoria" title="Nome da categoria" required>
                                    </p>
                                    <p>
                                        <label class="w3-text-IE"><b>Descrição</b>*</label>
                                        <input class="w3-input w3-border w3-light-grey" name="DescricaoCategoria" type="text" maxlength="200" placeholder="Descrição da categoria" title="Descrição da categoria entre 10 e 1000 letras" required>
                                    </p>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center">
                                    <p>
                                        <input type="submit" value="Salvar" class="w3-btn w3-theme">
                                        <input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='catListar.php'">
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