<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Animais</title>
        <style>
            table, th, td {
            border-collapse: collapse;
            border: 1px solid;
            }
            th, td {
                padding: 13px;
                text-align: center;
            }
            th {background-color: #f2f2f2;}
            tr:nth-child(even) {background-color: #f2f2f2;}
        </style>
    </head>
    <body>
        <a href="index.php">Página Principal</a>

        <?php
            require_once "model/animal.php";
            require_once "configs/util.php";

            if(isMetodo("GET")){
                if(parametrosValidos($_GET, ["deletarAnimal"])){
                    $id = $_GET["deletarAnimal"];
                    if(Animal::existeId($id)){
                        $resultado = Animal::remover($id);
                        if($resultado){
                            echo "<p>Animal deletado com sucesso</p>";
                        }
                        else{
                            echo "<p>Erro ao deletar animal</p>";
                        }
                    }
                    else{
                        echo "<p>Essa animal não está cadastrado</p>";
                    }
                }
            }
        ?>

        <h2>Tabela de animais:</h2><br>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Raça</th>
                    <th>Telefone Dono</th>
                    <th>Data de cadastro</th>
                    <th>Operações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once "model/animal.php";

                    $lista = Animal::listar();
                    foreach($lista as $animal){
                        echo "<tr>";
                        echo "<td>" . $animal["id"] . "</td>";
                        echo "<td>" . $animal["nome"] . "</td>";
                        echo "<td>" . $animal["raca"] . "</td>";
                        echo "<td>" . $animal["telDono"] . "</td>";
                        echo "<td>" . $animal["dataCadastro"] . "</td>";
                        $id = $animal["id"];
                        echo "<td>
                            <a href='editarAnimal.php?id=$id'>Editar</a>
                            <a href='animais.php?deletarAnimal=$id'>Deletar</a>
                            </td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>
