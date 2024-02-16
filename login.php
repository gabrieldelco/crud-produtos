<html>
<!-- Login.php --> 
	<head>
    <meta charset="UTF-8">
      <title>Produtos</title>
	  <link rel="icon" type="image/png" href="imagens/favicon1.png" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" href="css/customizes.css">
	</head>
<body>

<?php
    session_start(); // informa ao PHP que iremos trabalhar com sessão
    require 'bd/conectaBD.php'; 

    // Cria conexão
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica conexão 
    if ($conn->connect_error) {
        die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
    }

    $usuario = $conn->real_escape_string($_POST['Email']); // prepara a string recebida para ser utilizada em comando SQL
    $senha   = $conn->real_escape_string($_POST['Senha']); // prepara a string recebida para ser utilizada em comando SQL
    
    // Faz Select na Base de Dados
    $sql = "SELECT ID_Usuario, nome FROM Usuario WHERE Email = '$usuario' AND Senha = md5('$senha')";
    if ($result = $conn->query($sql)) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION ['login']       = $usuario;
            $_SESSION ['ID_Usuario']  = $row['ID_Usuario'];
            $_SESSION ['nome']        = $row['nome'];
            unset($_SESSION['nao_autenticado']);
            unset($_SESSION ['mensagem_header'] ); 
            unset($_SESSION ['mensagem'] ); 
            header('location: /produtos/proListar.php');
            exit();
            
        }else{
            $_SESSION ['nao_autenticado'] = true;
            $_SESSION ['mensagem_header'] = "Login";
            $_SESSION ['mensagem']        = "ERRO: Login ou Senha inválidos.";
            header('location: /produtos/index.php');
            exit();
        }
    }
    else {
        echo "Erro ao acessar o BD: " . mysqli_error($conn);
    }
    $conn->close();  //Encerra conexao com o BD
?>
	</body>
</html>