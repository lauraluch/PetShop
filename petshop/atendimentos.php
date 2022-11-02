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

        <h2>Tabela de animais:</h2><br>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Id do fucionario</th>
                    <th>Nome do funcionario</th>
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
    </body>
</html>