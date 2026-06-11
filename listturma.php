<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Listagem de Turmas</title>
</head>
<body>

<h2>Listagem de Turmas</h2>

<?php

// =============================================
// Configurações de conexão com o banco
// =============================================
$host = "sql213.infinityfree.com";
$usuario = "if0_41127589";
$senha_bd = "0201030Aa";
$bd = "if0_41127589_connectschool";

// =============================================
// Conexão com o banco de dados
// =============================================
$conexao = new mysqli($host, $usuario, $senha_bd, $bd);

if ($conexao->connect_error) {
    die("Não foi possível conectar ao banco de dados: " . $conexao->connect_error);
}

// =============================================
// Consulta na tabela turma
// =============================================
$comando   = "SELECT id, nome, status FROM turma";
$resultado = mysqli_query($conexao, $comando);

if (!$resultado) {
    die("Erro ao executar a consulta: " . $conexao->error);
}

$qtdeRegistros = mysqli_num_rows($resultado);

if ($qtdeRegistros == 0) {
    echo "Nenhuma turma foi encontrada.<br>";
    echo "<a href='javascript:history.back();'>Voltar</a>";
} else {
    echo "Quantidade: <b>$qtdeRegistros</b> turma(s) encontrada(s).<br><br>";

    echo "<table border='1' cellpadding='6' cellspacing='0'>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Status</th>
            </tr>";

    while ($campo = mysqli_fetch_array($resultado)) {
        $id     = $campo["id"];
        $nome   = $campo["nome"];
        $status = $campo["status"] ? "Ativa" : "Inativa";

        echo "<tr>
                <td>$id</td>
                <td>$nome</td>
                <td>$status</td>
              </tr>";
    }

    echo "</table><br><br>";

    echo "<a href='javascript:history.back();'>Voltar</a>";
}

// =============================================
// Encerramento
// =============================================
mysqli_free_result($resultado);
$conexao->close();

?>

</body>
</html>