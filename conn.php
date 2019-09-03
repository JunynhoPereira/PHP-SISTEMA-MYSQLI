<?php 

	// Conexão com banco de dados

	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$banco = "db_provaj";

	$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

	// Teste de conexão

	if (mysqli_connect_errno()) {
		die("Conexão Falhou: " . mysqli_connect_errno());
	}

?>