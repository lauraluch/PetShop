<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de funcionarios</title>
    <link rel="stylesheet" type="text/css" href="listStyle.css"/>
</head>
<body>
    <?php
        require_once "configs/util.php";
        require_once "model/funcionario.php";
        
        ?>
        <header>
            <h2>Funcionarios Cadastrados</h2>
        </header>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de cadastro</th>
                    <th>Operações</th>
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
                        <a href='editarFuncionario.php?id=" . $funcionario["id"] . "'>Editar</a>  |  
                        <a href='deletarFuncionario.php?id=$id'>Deletar</a>
                        </td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
                </table>
                <br><br>
                <a id="retorno" href='index.php'>Voltar à página principal</a>
                

</body>
</html>