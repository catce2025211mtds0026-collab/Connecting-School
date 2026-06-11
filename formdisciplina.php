<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Formulário Disciplina</title>
</head>
<body>

<?php
echo('
<h2>Inclusão de Disciplina</h2>
<form method="post" name="formulario" action="disciplina.php">

    Código - ID (*): <input type="text" name="id_disciplina" required><br/>
    Nome da Disciplina (*): <input type="text" name="nome_disciplina" size="50" maxlength="150" required><br/>
    Status:
        <select name="status_disciplina">
            <option value="1">Ativa</option>
            <option value="0">Inativa</option>
        </select><br/>

    <input type="submit" name="confirmar" value="Confirmar">
    <input type="reset"  name="limpar"    value="Limpar"><br/>
    (*) campo obrigatório

</form><br><br>
');
echo("<a href='javascript:history.back();'>Voltar</a>");
?>

</body>
</html>