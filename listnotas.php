<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Consulta de Notas</title>
</head>
<body>
<h2>Consulta de Notas</h2>
<?php

$matricula_aluno = trim($_POST["matricula_aluno"]);

$comando  = "SELECT n.bimestre, n.valor, d.nome_disciplina AS disciplina, t.id AS turma ";
$comando .= "FROM nota n ";
$comando .= "JOIN disciplina d ON d.id_disciplina = n.cod_disciplina ";
$comando .= "JOIN turma t      ON t.id = n.turma_id ";
$comando .= "WHERE n.matricula_aluno = '$matricula_aluno' ";
$comando .= "ORDER BY d.nome_disciplina, n.bimestre";

$host = "sql213.infinityfree.com";
$usuario = "if0_41127589";
$senha_bd = "0201030Aa";
$bd = "if0_41127589_connectschool";

$conexao = new mysqli($host, $usuario, $senha_bd, $bd);
if (!$conexao) {
    die("Não foi possível conectar ao banco de dados: " . mysqli_connect_error());
}

$consulta = mysqli_query($conexao, $comando);

if (!$consulta || mysqli_num_rows($consulta) == 0) {
    echo("Nenhuma nota encontrada para o aluno <b>$matricula_aluno</b>.<p>");
    echo("<a href='javascript:history.back();'>Voltar</a>");
} else {
    echo("<table border='1' cellpadding='5'>");
    echo("<tr>
            <th>Turma</th>
            <th>Disciplina</th>
            <th>Bimestre</th>
            <th>Nota</th>
          </tr>");

    while ($linha = mysqli_fetch_assoc($consulta)) {
        echo("<tr>");
        echo("<td>" . $linha["turma"]      . "</td>");
        echo("<td>" . $linha["disciplina"] . "</td>");
        echo("<td>" . $linha["bimestre"]   . "º</td>");
        echo("<td>" . $linha["valor"]      . "</td>");
        echo("</tr>");
    }

    echo("</table><p>");
    echo("<a href='javascript:history.back();'>Voltar</a>");
}

@mysqli_close($conexao);

?>
</body>
</html>