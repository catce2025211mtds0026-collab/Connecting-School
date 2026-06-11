<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Responsável</title>
</head>
<body>
<h2>Responsável</h2>
<?php

$id              = trim($_POST["id"]);
$nome            = trim($_POST["nome"]);
$cpf             = trim($_POST["cpf"]);
$data_nascimento = trim($_POST["data_nascimento"]);
$senha           = trim($_POST["senha"]);
$status = trim($_POST["status"]) === "true" ? 1 : 0;
$telefone = trim($_POST["telefone1"]);
$telefone2 = trim($_POST["telefone2"]);

$comando  = "INSERT INTO responsavel (id, nome, cpf, data_nascimento, senha, status, telefone1, telefone2) ";
$comando .= "VALUES ('$id', '$nome', '$cpf', '$data_nascimento', '$senha', '$status', '$telefone1', '$telefone2')";
$host = "localhost";
$usuario = "root";
$senha_bd = "";
$bd = "escola";
// echo("$comando<br/>");
$conexao = new mysqli($host, $usuario, $senha_bd, $bd);
if (!$conexao) {
    die("Não foi possivel conectar ao banco de dados: " . mysqli_connect_error());
}
$consulta = mysqli_query($conexao, $comando);
IF ($consulta == 0) {
	ECHO("O ID <B>$id</B> já foi cadastrado.<P>");
	ECHO("<A HREF=javascript:history.back();>Voltar</A>");
}
ELSE {
	ECHO("Inclusao efetuada com sucesso.<P>");
}
@mysqli_close($conexao);

?>
</BODY>
</HTML>
