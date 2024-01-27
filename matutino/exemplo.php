<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Exemplo PHP</title>
</head>
<body>
    <form method="GET" action="exemplo.php">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome"><br>
        <label for="genero">Gênero:</label><br>
        <input type="text" id="genero" name="genero"><br>
        <label for="nota1">Nota 1:</label><br>
        <input type="text" id="nota1" name="nota1"><br>
        <label for="nota2">Nota 2:</label><br>
        <input type="text" id="nota2" name="nota2"><p>
        <input type="submit" value="Enviar">
    </form>


    <?php
        $nome = $_GET["nome"];
        $nota1 = $_GET["nota1"];
        $nota2 = $_GET["nota2"];
        $genero = $_GET["genero"]; // M-Masculino e F-Feminino
        $media = ($nota1+$nota2)/2;

        echo "$nome tirou $nota1 e $nota2 obtendo média $media ";

        if ($genero=="M"){
            if($media<7){
                echo "foi reprovado";
            } else {
                echo "foi aprovado";
            }
        } else {
            if($media<7){
                echo "foi reprovada";
            } else {
                echo "foi aprovada";
            }
        }

    ?>
</body>
</html>