<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="listStyle.css">
        <title>Animais</title>
    </head>
    <body>
        <?php
            require_once "model/animal.php";
            require_once "model/funcionario.php";
            require_once "model/atende.php";
            require_once "configs/util.php";

            if(isMetodo("GET")){
                if(parametrosValidos($_GET, ["deletarAtendimento"])){
                    $id = $_GET["deletarAtendimento"];
                    if(Atende::existeId($id)){
                        $resultado = Atende::remover($id);
                        if($resultado){
                            echo "<p>Atendimento deletado com sucesso</p>";
                        }
                        else{
                            echo "<p>Erro ao deletar o atendimento</p>";
                        }
                    }
                    else{
                        echo "<p>Esse atendiemento não está cadastrado</p>";
                    }
                }
            }
        ?>
        <header>
            <h2>Atendimentos</h2>
        </header>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID do fucionário</th>
                    <th>Nome do funcionário</th>
                    <th>Id do animal</th>
                    <th>Nome do animal</th>
                    <th>Data do atendimento</th>
                    <th>Operações</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $lista = Atende::listar();
                    foreach($lista as $atendimento){
                        $id = $atendimento["id_atende"];
                        echo "<tr>";
                        echo "<td>" . $atendimento["id_atende"] . "</td>";
                        echo "<td>" . $atendimento["id_func"] . "</td>";
                        echo "<td>" . $atendimento["nome_func"] . "</td>";
                        echo "<td>" . $atendimento["id_animal"] . "</td>";
                        echo "<td>" . $atendimento["nome_animal"] . "</td>";
                        echo "<td>" . $atendimento["data_atende"] . "</td>";
                        echo "<td>
                            <a href='atendimentos.php?deletarAtendimento=$id'>Deletar</a>
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
