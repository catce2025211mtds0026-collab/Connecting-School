<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Consulta de Notas</title>
</head>
<body>

<?php
echo('
<h2>Consulta de Notas do Aluno</h2>
<form method="post" name="formulario" action="listnotas.php">

    Matrícula do Aluno (*): <input type="text" name="matricula_aluno" required><br/>

    <input type="submit" name="confirmar" value="Confirmar">
    <input type="reset"  name="limpar"    value="Limpar"><br/>
    (*) campo obrigatório

</form><br/>
');
echo("<a href='javascript:history.back();'>Voltar</a>");
?>

</body>
</html>