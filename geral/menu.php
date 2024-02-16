<!-- menu.php -->

	<!-- Top -->
	<?php 
	session_start();
	if(!isset($_SESSION ['login'])){                              // Não houve login ainda
        unset($_SESSION ['nao_autenticado']);
		unset($_SESSION ['mensagem_header'] ); 
		unset($_SESSION ['mensagem'] ); 
		header('location: /produtos/index.php');    // Vai para a página inicial
		exit();
    }
	?>
	<div class="w3-top"   > 
		<div class="w3-row w3-white w3-padding" >
			<div class="w3-half" style="margin:0 0 0 0">
				<a href="."><img src='imagens/Logo1.jpg' alt=' Produtos '></a>
			</div>
			<div class="w3-half w3-margin-top w3-wide w3-hide-medium w3-hide-small">
				<div class="w3-right"> Gerente: <?php echo $_SESSION['nome']; ?>&nbsp;<a href="logout.php" 
				class="w3-btn w3-red w3-hover-red">&nbsp;Sair&nbsp;</a>
				</div >
			</div>
		</div>
		<div class="w3-bar w3-theme w3-large" style="z-index:-1">
			<a class="w3-bar-item w3-button w3-left w3-hide-large w3-hover-light-gray w3-large w3-theme w3-padding-16" href="javascript:void(0)" onclick="w3_open()">☰</a>
			<a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" href="proListar.php" onclick="w3_show_nav('menuProduto')">Produto</a>
		</div>
	</div>



	<!-- Sidebar -->
	<div class="w3-sidebar w3-bar-block w3-collapse w3-animate-left" style="z-index:3;width:270px" id="mySidebar" >
		<div class="w3-bar w3-hide-large w3-large">
			<a href="javascript:void(0)" onclick="w3_show_nav('menuProduto')"
			   class="w3-bar-item w3-button w3-theme w3-hover-light-gray w3-padding-16" style="width:50%">Produtos</a>

			   
		</div>
		<a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-right w3-xlarge w3-hide-large"
		   title="Close Menu">x</a>
		<div id="menuProduto" class="myMenu">
			<div class="w3-container">
				<h3>Menu Produtos</h3>
			</div>
			<a class="w3-bar-item w3-button" href="proListar.php">Relação de Produtos</a>
			<a class="w3-bar-item w3-button" href="proIncluir.php">Cadastro de Produtos</a>
			<a class="w3-bar-item w3-button" href="catListar.php">Relação de Categorias</a>
			<a class="w3-bar-item w3-button" href="catIncluir.php">Cadastro de Categorias</a>



		</div>
		
	</div>


	<script type="text/javascript" src="js/myScript.js"></script>
