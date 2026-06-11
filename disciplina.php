<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Disciplina</title>
</head>
<body>
<h2>Disciplina</h2>
<?php

$id              = trim($_POST["id"]);
$nome            = trim($_POST["nome"]);
$status          = trim($_POST["status"]) === "true" ? 1 : 0;


$comando  = "INSERT INTO disciplina (id, nome, status) ";
$comando .= "VALUES ('$id', '$nome', '$status')";
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
