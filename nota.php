<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Lançamento de Nota</title>
</head>
<body>
<h2>Lançamento de Nota</h2>
<?php

$matricula_aluno = trim($_POST["matricula_aluno"]);
$cod_disciplina  = trim($_POST["cod_disciplina"]);
$turma_id        = trim($_POST["turma_id"]);
$bimestre        = trim($_POST["bimestre"]);
$valor           = trim($_POST["valor"]);

$comando  = "INSERT INTO nota (matricula_aluno, cod_disciplina, turma_id, bimestre, valor) ";
$comando .= "VALUES ('$matricula_aluno', '$cod_disciplina', '$turma_id', '$bimestre', '$valor')";

$host = "sql213.infinityfree.com";
$usuario = "if0_41127589";
$senha_bd = "0201030Aa";
$bd = "if0_41127589_connectschool";

$conexao = new mysqli($host, $usuario, $senha_bd, $bd);
if (!$conexao) {
    die("Não foi possível conectar ao banco de dados: " . mysqli_connect_error());
}

$consulta = mysqli_query($conexao, $comando);

if ($consulta == 0) {
    echo("Erro ao lançar nota para o aluno <b>$matricula_aluno</b>.<p>");
    echo("<a href='javascript:history.back();'>Voltar</a>");
} else {
    echo("Nota lançada com sucesso.<p>");
}

@mysqli_close($conexao);

?>
</body>
</html>