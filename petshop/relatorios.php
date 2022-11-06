<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="reportStyle.css">
        <title>Relatórios</title>
    </head>
    <body>
        <header>
            <h1>Relatórios</h1>
        </header>

        <div class="grid-container">
            <div class="grid-item">
                <h3>Listar animais cuidados por um determinado funcionário</h3>
        
                <form method="POST">
                    <p>Selecione o id do funcionario</p>
                    <select name="idFunc" required>
                        <option value="">------</option>
                        <?php
                            require_once "model/funcionario.php";
                            
                            $lista = Funcionario::listar();
                            foreach ($lista as $func) {
                                $id = $func["id"];
                                $nome = $func["nome"];
                                echo "<option value='$id'>$nome</option>";
                            }
                            ?>
                    </select>
                    <input type="hidden" name="funcao" value="1">
                    <button class="list">Listar</button>
                </form>
                
            
                <h3>Listar funcionários que cuidam de determinado animal</h3>
                <form method="POST">
                    <p>Selecione o id do animal</p>
                    <select name="idAnimal" required>
                        <option value="">------</option>
                        <?php
                            require_once "model/animal.php";
                            
                            $lista = Animal::listar();
                            foreach ($lista as $func) {
                                $id = $func["id"];
                                $nome = $func["nome"];
                                echo "<option value='$id'>$nome</option>";
                            }
                        ?>
                    </select>
                    <input type="hidden" name="funcao" value="2">
                    <button class="list">Listar</button>
                </form>

                <h3>Listar animais por raça</h3>
        
                <form method="POST">
                    <p>Selecione a raça do animal</p>
                    <select name="raca" required>
                        <option value="">------</option>
                        <?php
                            require_once "model/animal.php";
                            
                            $lista = Animal::listarRaca();
                            foreach ($lista as $item) {
                                $raca = $item["raca"];
                                echo "<option value='$raca'>$raca</option>";
                            }
                        ?>
                    </select>
                    <button class="list">Listar</button>
                </form>

                <h3>Listar animais por dono</h3>
        
                <form method="POST">
                    <p>Selecione o telefone</p>
                    <select name="tel" required>
                        <option value="">------</option>
                        <?php
                            require_once "model/animal.php";
        
                            $lista = Animal::listarTelefonesDonos();
                            foreach ($lista as $item) {
                                $tel = $item["telDono"];
                                echo "<option value='$tel'>$tel</option>";
                            }
                        ?>
                    </select>
                    <button class="list">Listar</button>
                </form>
            
        </div>
        <div class="grid-item">
        <?php
                require_once "model/animal.php";
                require_once "model/funcionario.php";
                require_once "model/relatorio.php";
                require_once "configs/util.php";

                if(isMetodo("POST")){
                    if(parametrosValidos($_POST, ["idAnimal"])){
                        $idAnimal = $_POST["idAnimal"];
                        $resultado = Funcionario::listarAtendimentos($idAnimal);
                        if($resultado){
                            echo "<table>";
                            echo "<thead>" . "<tr>" . "<th>" . "ID" . "</th>" .
                                "<th>" . "Nome". "</th>" .
                                "<th>" . "Email" . "</th>" .
                                "<th>" . "Data de cadastro" . "</th>" . "</thead>";
                            echo "<tbody>";
                            foreach($resultado as $func){
                                echo "<tr>";
                                echo "<td>" . $func["id"] . "</td>";
                                echo "<td>" . $func["nome"] . "</td>";
                                echo "<td>" . $func["email"] . "</td>";
                                echo "<td>" . $func["dataCadastro"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                        }
                        else
                            echo "<p>Esse animal não possui consultas</p>";
                    }
                }



        
            if(isMetodo("POST")){
                if(parametrosValidos($_POST, ["idFunc"])){
                    $idFunc = $_POST["idFunc"];
                    $resultado = Relatorio::listarAnimaisCuidadosPorFuncionario($idFunc);
                    if($resultado){
                        echo "<table>";
                        echo "<thead>" . "<tr>" . "<th>" . "ID" . "</th>" .
                        "<th>" . "Nome". "</th>" .
                        "<th>" . "Raça" . "</th>" .
                        "<th>" . "Telefone Dono" . "</th>" .
                        "<th>" . "Data de cadastro" . "</th>" . "</thead>";
                        echo "<tbody>";
                        foreach($resultado as $animal){
                            echo "<tr>";
                            echo "<td>" . $animal["id"] . "</td>";
                            echo "<td>" . $animal["nome"] . "</td>";
                            echo "<td>" . $animal["raca"] . "</td>";
                            echo "<td>" . $animal["telDono"] . "</td>";
                            echo "<td>" . $animal["dataCadastro"] . "</td>";
                            echo "</tr>" ;
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }
                    else
                    echo "<p>Este funcionário não cuida de nenhum animal.</p>";
                
                }
            }
        

                if(isMetodo("POST")){
                    if(parametrosValidos($_POST, ["tel"])){
                        $tel = $_POST["tel"];
                        $resultado = Animal::listarPorTelefone($tel);
                        if($resultado){
                            echo "<table>";
                            echo "<thead>" . "<tr>" . "<th>" . "ID" . "</th>" .
                                "<th>" . "Nome". "</th>" .
                                "<th>" . "Raça" . "</th>" .
                                "<th>" . "Telefone Dono" . "</th>" .
                                "<th>" . "Data de cadastro" . "</th>" . "</thead>";
                            echo "<tbody>";
                            foreach($resultado as $animal){
                                echo "<tr>";
                                echo "<td>" . $animal["id"] . "</td>";
                                echo "<td>" . $animal["nome"] . "</td>";
                                echo "<td>" . $animal["raca"] . "</td>";
                                echo "<td>" . $animal["telDono"] . "</td>";
                                echo "<td>" . $animal["dataCadastro"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>" . "</table>";
                        }
                        else
                            echo "<p>Nenhum animal pertence ao dono selecionado</p>";
                    }
                }
            

                if(isMetodo("POST")){
                    if(parametrosValidos($_POST, ["raca"])){
                        $raca = $_POST["raca"];
                        $resultado = Relatorio::listarAnimaisPorRaca($raca);
                        if($resultado){
                            echo "<table>";
                            echo "<thead>" . "<tr>" . "<th>" . "ID" . "</th>" .
                                "<th>" . "Nome". "</th>" .
                                "<th>" . "Raça" . "</th>" .
                                "<th>" . "Telefone Dono" . "</th>" .
                                "<th>" . "Data de cadastro" . "</th>" . "</thead>";
                            echo "<tbody>";
                            foreach($resultado as $animal){
                                echo "<tr>";
                                echo "<td>" . $animal["id"] . "</td>";
                                echo "<td>" . $animal["nome"] . "</td>";
                                echo "<td>" . $animal["raca"] . "</td>";
                                echo "<td>" . $animal["telDono"] . "</td>";
                                echo "<td>" . $animal["dataCadastro"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>" . "</table>";
                        }
                        else
                            echo "<p>Não existe animais cadastrados com essa raça</p>";
                    }
                    else{
                        
                    }
                }
            ?>
            <br><br>
            <div class="return">
                <a class="retorno" href='index.php'>Voltar à página principal</a>
            </div>
            </div>
        </div>

        
        
    </body>
</html>