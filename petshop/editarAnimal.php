<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="edit.css">
        <title>Editar Animal</title>
    </head>
    <body>
        <?php
            require_once "configs/util.php";
            require_once "model/animal.php";

            if(isMetodo("POST")){
                if(parametrosValidos($_POST, ["nome", "raca", "telDono"])){
                    $resultado = Animal::editar($_POST["id"], $_POST["nome"], $_POST["raca"], $_POST["telDono"]);
                    if($resultado){
                        echo "Animal editado com sucesso<br><br>";
                        echo "<a href='animais.php'>Voltar a pagina de animais</a>";
                        die; 
                    }
                    else{
                        echo "Erro ao editar<br><br>";
                        echo "<a href='animais.php'>Voltar a pagina de animais</a>";
                        die;
                    }
                }
                else{
                    echo "Problemas na requisição de editar";
                    echo "<a href='animais.php'>Voltar a pagina de animais</a>";
                    die;
                }
            }

            if(isMetodo("GET")){
                    if(parametrosValidos($_GET, ["id"])){
                        $id = $_GET["id"];
                        if(Animal::existeId($id)){
                            $animal = Animal::getAnimalById($id);
                        }
                        else{
                            echo "Esse animal não existe.";
                        }
                    }
                    else{
                        echo "É necessário informar qual animal deve ser editado";
                        echo "<a href='animais.php'>Voltar a pagina de animais</a>";
                        exit;
                    }
            }
        ?>
        <h2>Editando informações de <?= $animal["nome"] ?></h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $animal["id"] ?>">
            <p>Digite o nome: </p>
            <input type="text" value="<?= $animal["nome"] ?>" name="nome" required>
            <p>Digite a raça: </p>
            <input type="text" value="<?= $animal["raca"] ?>" name="raca" required>
            <p>Digite o telefone do dono: </p>
            <input type="text" value="<?= $animal["telDono"] ?>" name="telDono" required><br><br>
            <button>Salvar</button>
        </form>
    </body>
</html>
