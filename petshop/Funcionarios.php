<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de funcionarios</title>
</head>
<body>
    <?php
        require_once "configs/util.php";
        //require_once "model/atende.php";
        require_once "model/funcionario.php";
        //require_once "model/animal.php";
        
        ?>
        <h2>Tabela de Funcionarios Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de cadastro</th>
                    <th>Deletar</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $listaFuncionarios = Funcionario::listar();
                
                    foreach($listaFuncionarios as $funcionario){
                        $id = $funcionario["id"];
                        echo "<tr>";
                        echo "<td>" . $funcionario["id"] . "</td>";
                        echo "<td>" . $funcionario["nome"] . "</td>";
                        echo "<td>" . $funcionario["email"] . "</td>";
                        echo "<td>" . $funcionario["dataCadastro"] . "</td>";
                        echo "<td>
                        <a href='deletarFuncionario.php?id=" . $funcionario["id"] . "'>Deletar</a>  |  
                        <a href='editarFuncionario.php?id=$id'>Editar</a>
                        </td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
                </table>
                <br><br>
                <a href='index.php'>Voltar ao index</a>
                
                
                

</body>
</html>