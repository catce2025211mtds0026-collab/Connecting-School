<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Disciplina</title>
</head>
<body>
<h2>Disciplina</h2>
<?php

$id_disciplina              = trim($_POST["id_disciplina"]);
$nome_disciplina            = trim($_POST["nome_disciplina"]);
$status_disciplina          = trim($_POST["status_disciplina"]) === "true" ? 1 : 0;


$comando  = "INSERT INTO disciplina (id_disciplina, nome_disciplina, status_disciplina) ";
$comando .= "VALUES ('$id_disciplina', '$nome_disciplina', '$status_disciplina')";
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
