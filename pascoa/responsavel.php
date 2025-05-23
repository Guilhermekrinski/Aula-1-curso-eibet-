<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Páscoa Solidária - Responsáveis</title>
</head>
<body>
    <?php 
    // Verifica a opção escolhida
    if (isset($_GET['op'])){  // verifica se a operação foi definida no GET
        $op = $_GET['op'];
    } else {    
        if (isset($_POST['op'])){ // verifica se a operação foi definida no POST
            $op = $_POST['op'];
        } else { // se a operação não foi definida estabelece op=li (listar responsáveis) como padrão
            $op='lr';
        }
    }

    // Conexão com o banco de dados
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $database = "bd_pascoa";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $database);

    // ir - Inserir responsável
    if ($op=='ir'){
        ?>
        <form method="post" action="responsavel.php">
            <input type="hidden" name = "op" value="sr">  <!-- operação de salvar responsavel -->
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome"><br>
            <label for="telefone">Telefone:</label><br>
            <input type="text" id="telefone" name="telefone"><br>
            <label for="email">e-mail:</label><br>
            <input type="text" id="email" name="email"><br>
            <input type="submit" value="Enviar"></p>
        </form>
        <?php
    }

    // sr - Salvar responsável
    if ($op=='sr'){
        $nome = $_POST["nome"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];
        
        $sql = "INSERT INTO tb_responsavel (nome,telefone,email) VALUES ('$nome','$telefone','$email')";
        
        if(mysqli_query($conexao, $sql)){
            echo "<p>Dados inseridos com sucesso";
        } else {
            echo "<p>Erro ao inserir dados";
        }
    }

    // er - Editar responsável
    if ($op=='er'){
        $id = $_GET["id"];
        $sql = "SELECT nome,telefone,email FROM tb_responsavel WHERE id=$id";
        // echo $sql;
        $resultado = mysqli_query($conexao,$sql);
        $responsavel = mysqli_fetch_array($resultado);
        ?>
        <form method="post" action="responsavel.php">
            <input type="hidden" name = "op" value="ar">  <!-- operação de atualizar responsavel -->
            <input type="hidden" name = "id" value=<?php echo $id ?>>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" value=<?php echo $responsavel['nome'] ?>><br>
            <label for="telefone">Telefone:</label><br>
            <input type="text" id="telefone" name="telefone" value=<?php echo $responsavel['telefone'] ?>><br>
            <label for="email">e-mail:</label><br>
            <input type="text" id="email" name="email" value=<?php echo $responsavel['email'] ?>><br>
            <input type="submit" value="Enviar"></p>
        </form>
        <?php        
    }

    // ar - Atualizar responsável
        if ($op=='ar'){
            $id = $_POST["id"];
            $nome = $_POST["nome"];
            $telefone = $_POST["telefone"];
            $email = $_POST["email"];
            
            $sql = "UPDATE tb_responsavel SET nome='$nome',telefone='$telefone',email='$email' WHERE id=$id";
            // echo $sql;
            if(mysqli_query($conexao, $sql)){
                echo "<p>Dados inseridos com sucesso";
            } else {
                echo "<p>Erro ao inserir dados";
            }
        }
    
    // dr - Excluir (deletar) responsável
    if ($op=='dr'){
        $id = $_GET['id'];
        $sql = "DELETE FROM tb_responsavel WHERE id = $id";
        if(mysqli_query($conexao, $sql)){
            echo "<p>Dados excluídos com sucesso";
        } else {
            echo "<p>Erro ao excluir dados";
        }
    }


    // lr - Listar responsáveis
    if ($op=='lr'){
        $sql =  "SELECT id,nome,telefone,email ".
                "FROM tb_responsavel ";
        // echo $sql;

        $resultado = mysqli_query($conexao, $sql);
        
        echo "</p>Responsáveis";
        echo "<table>";
        while ($responsavel = mysqli_fetch_array($resultado)){
            echo "<tr>";
            echo "<td>$responsavel[id]</td>";
            echo "<td>$responsavel[nome]</td>";
            echo "<td>$responsavel[telefone]</td>";
            echo "<td>$responsavel[email]</td>";
            echo "<td><a href='responsavel.php?op=er&id=$responsavel[id]'>[Editar]</td>";
            echo "<td><a href='responsavel.php?op=dr&id=$responsavel[id]'>[Excluir]</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<a href='responsavel.php?op=ir'>Incluir responsavel</a>";
    }

    // Fecha a conexão com o banco
    mysqli_close($conexao);

    ?>
    <p><a href="index.php">Voltar para a página principal</a>
</body>
</html>