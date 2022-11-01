<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
</head>
<body>
    <?php
        require_once "configs/util.php";
        require_once "model/animal.php";
        require_once "model/funcionario.php";
        require_once "model/atende.php";
        
        if(isMetodo("GET")){
            if(parametrosValidos($_GET, ["deletarFuncionario"])){
                $id = $_GET["deletarFuncionario"];
                if(Funcionario::existeId($id)){
                    $resultado = Funcionario::remover($id);
                    if($resultado){
                        echo "<p>Funcionário excluído com sucesso.</p>";
                    }
                    else{
                        echo "<p>Erro</p>";
                    }
                }
                else{
                    echo "<p>Esse funcionário não existe.</p>";
                    die;
                }
            }
        }

        if(isMetodo("GET")){
            if(parametrosValidos($_GET, ["deletarAnimal"])){
                $id = $_GET["deletarAnimal"];
                if(Animal::existeId($id)){
                    $resultado = Animal::remover($id);
                    if($resultado){
                        echo "<p>Animal excluído com sucesso.</p>";
                    }
                    else{
                        echo "<p>Erro</p>";
                    }
                }
                else{
                    echo "<p>Esse animal não existe.</p>";
                    die;
                }
            }
        }


        //Cadastro
        if(isMetodo("POST")){
            
            //Cadastro de Funcionário
            if(parametrosValidos($_POST, ["nome", "email"])){
                $nome = $_POST["nome"];
                $email = $_POST["email"];

                if (!Funcionario::existeEmail($email)){
                    if(Funcionario::cadastrar($nome, $email)){
                        echo "<p>Funcionário <b>$nome</b> cadastrado com sucesso.</p>";
                    }else{
                        echo "<p>Erro ao cadastrar o funcionário <b>$nome</b>.</p>";
                    }
                }else{
                    echo "<p>Já existe uma pessoa com o login $email</p>";
                }
            }
            else{

            }
        }

        
        //Cadastro
        if(isMetodo("POST")){
            
            //Cadastro de Animal
            if(parametrosValidos($_POST, ["nome", "raca", "telDono"])){
                $nome = $_POST["nome"];
                $raca = $_POST["raca"];
                $telDono = $_POST["telDono"];

                if(Animal::cadastrar($nome, $raca, $telDono))
                    echo "<p>O animal <b>$nome</b> foi cadastrado com sucesso.</p>";
                else
                    echo "<p>Erro ao cadastrar o animal <b>$nome</b>.</p>";
            }
            else{
                
            }
        }
    
        //Cadastro
        if(isMetodo("POST")){
            
            //Cadastro de Atendimento
            if(parametrosValidos($_POST, ["idFunc", "idAnimal"])){
                $idFunc = $_POST["idFunc"];
                $idAnimal = $_POST["idAnimal"];

                if(Atende::cadastrar($idFunc, $idAnimal))
                    echo "<p>O atendimento foi cadastrado com sucesso.</p>";
                else
                    echo "<p>Erro ao cadastrar o atendimento</p>";
            }
            else{
                
            }
        }
    ?>
    <h1>Cadastro de Funcionário</h1>
    <form method="POST">
        
        <p>Digite o nome</p>
        <input type="text" name="nome" required>
        <p>Digite o e-mail</p>
        <input type="email" name="email" required>
        <br><br>
        <button>Cadastrar</button>
    </form>

    
    <br>
    <h1>Cadastro de Animal</h1>
    <form method="POST">
        <p>Digite o nome</p>
        <input type="text" name="nome" required>
        <p>Digite a raça</p>
        <input type="text" name="raca" required>
        <p>Digite o telefone do Dono</p>
        <input type="text" name="telDono" required>
        <br><br>
        <button>Cadastrar</button>
    </form>
    
    <br>
    <h1>Cadastre um atendimento</h1>
    <form method="POST">
        <p>Selecione o id do funcionario</p>
        <select name="idFunc" required>
            <option value="">------</option>
            <?php
            $lista = Funcionario::listar();
            foreach ($lista as $func) {
                $id = $func["id"];
                $nome = $func["nome"];
                echo "<option value='$id'>$nome</option>";
            }
            ?>
        </select>
        <p>Selecione o id do animal</p>
        <select name="idAnimal" required>
            <option value="">------</option>
            <?php
            $lista = Animal::listar();
            foreach ($lista as $animal) {
                $id = $animal["id"];
                $nome = $animal["nome"];
                echo "<option value='$id'>$nome</option>";
            }

            ?>
        </select>
        <br><br>
        <button>Cadastrar</button>
        <br><br>
    </form>

    <br><br>

    <a href='Funcionarios.php'>Listar Funcionários</a>
    <a href='animais.php'>Animais</a>
    
    
</body>
</html>
