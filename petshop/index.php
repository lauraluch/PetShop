<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>PetShop</title>
</head>
<body>
    <?php
        require_once "configs/util.php";
        require_once "model/animal.php";
        require_once "model/funcionario.php";
        require_once "model/atende.php";
        
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
        }
    ?>
    <header>
        <h1>🐾 PetShop 🐾</h1>
    </header>
    <nav class="navbar">
        <ul>
            <li><a href='Funcionarios.php'>Funcionários</a></li>
            <li><a href='animais.php'>Animais</a></li>
            <li><a href='atendimentos.php'>Atendimentos</a></li>
            <li><a href='relatorios.php'>Relatórios</a></li>
        </ul>
    </nav>
    <div class="grid-container">
        <section class="grid-item">
            <h2>Cadastre um Funcionário</h2>
            <form method="POST">
                
                <p>Digite o nome</p>
                <input type="text" name="nome" required>
                <p>Digite o e-mail</p>
                <input type="email" name="email" required>
                <br>
                <button>Cadastrar</button>
            </form>
        </section>
        
        <section class="grid-item">
            <h2>Cadastre um Animal</h2>
            <form method="POST">
                <p>Digite o nome</p>
                <input type="text" name="nome" required>
                <p>Digite a raça</p>
                <input type="text" name="raca" required>
                <p>Digite o telefone do Dono</p>
                <input type="text" name="telDono" required>
                <br>
                <button>Cadastrar</button>
            </form>
        </section>

        <section class="grid-item">
        <h2>Cadastre um Atendimento</h2>
    <form method="POST">
        <p>Selecione o funcionário:</p>
        <select name="idFunc" required>
            <option value="">------</option>
            <?php
            $lista = Funcionario::listar();
            foreach ($lista as $func) {
                $id = $func["id"];
                $nome = $func["nome"];
                echo "<option value='$id'>Id: $id Nome: $nome</option>";
            }
            ?>
        </select>
        <p>Selecione o animal:</p>
        <select name="idAnimal" required>
            <option value="">------</option>
            <?php
            $lista = Animal::listar();
            foreach ($lista as $animal) {
                $id = $animal["id"];
                $nome = $animal["nome"];
                echo "<option value='$id'>Id: $id Nome: $nome</option>";
            }

            ?>
        </select>
        <br>
        <button>Cadastrar</button>
        <br><br>
    </form>
        </section>
    </div>

</body>
</html>
