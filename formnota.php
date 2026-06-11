<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Formulário de Nota</title>
</head>
<body>

<?php
echo('
<h2>Lançamento de Nota</h2>
<form method="post" name="formulario" action="nota.php">

    Matrícula do Aluno (*): <input type="text" name="matricula_aluno" required><br/>
    Código da Disciplina (*): <input type="text" name="cod_disciplina" required><br/>
    ID da Turma (*): <input type="text" name="turma_id" required><br/>
    Bimestre (*):
        <select name="bimestre">
            <option value="1">1º Bimestre</option>
            <option value="2">2º Bimestre</option>
            <option value="3">3º Bimestre</option>
            <option value="4">4º Bimestre</option>
        </select><br/>
    Valor da Nota (*): <input type="number" name="valor" min="0" max="10" step="0.1" required><br/>

    <input type="submit" name="confirmar" value="Confirmar">
    <input type="reset"  name="limpar"    value="Limpar"><br/>
    (*) campo obrigatório

</form><br/>
');
echo("<a href='javascript:history.back();'>Voltar</a>");
?>

</body>
</html>