<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Formulário Discente</title>
</head>
<body>

<?php
echo('
<h2>Inclusão de Discente</h2>
<form method="post" name="formulario" action="discente.php">

    Matrícula - ID (*): <input type="text" name="id" required><br/>
    Nome Completo (*): <input type="text" name="nome" size="50" maxlength="150" required><br/>
    CPF (*): <input type="text" name="cpf" size="14" maxlength="14" required><br/>
    Data de Nascimento (*): <input type="date" name="data_nascimento" required><br/>
    Senha: <input type="password" name="senha"><br/>
    Status:
        <select name="status">
            <option value="1">Ativo</option>
            <option value="0">Inativo</option>
        </select><br/>
    Grau Regular (*):
        <input type="text" name="grau_regular" size="50" maxlength="150" required><br/><br/>
    Ano Letivo (*): <input type="number" name="ano_letivo" min="2000" max="2100" required><br/>

    <input type="submit" name="confirmar" value="Confirmar">
    <input type="reset"  name="limpar"    value="Limpar"><br/>
    (*) campo obrigatório

</form><br></br>
');
ECHO("<A HREF=javascript:history.back();>Voltar</A>");
?>

</body>
</html>