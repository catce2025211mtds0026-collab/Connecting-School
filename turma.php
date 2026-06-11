<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Turma</title>
</head>
<body>
<h2>Turma</h2>
<?php

$id              = trim($_POST["id"]);
$nome            = trim($_POST["nome"]);
$status          = trim($_POST["status"]) === "true" ? 1 : 0;


$comando  = "INSERT INTO turma (id, nome, status) ";
$comando .= "VALUES ('$id', '$nome', '$status')";
$host = "sql213.infinityfree.com";
$usuario = "if0_41127589";
$senha_bd = "0201030Aa";
$bd = "if0_41127589_connectschool";
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
