<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pessoas</title>
</head>
<body>
    <?php
        require_once "configs/util.php";
        require_once "model/Funcionario.php";

        $func = null;

        if(isMetodo("GET")) {
            if(parametrosValidos($_GET, ["id"])) {
                $id = $_GET["id"];
                if (Funcionario::existeId($id)) {
                    $func = Funcionario::getFuncById($id);
                } else {
                    echo "<h1>Esta pessoa não existe</h1>";
                    echo "<a href='Funcionarios.php'>Voltar a funcionarios</a>";
                    die;
                }
                
            } else {
                echo "<h1>Você deve dizer qual é a pessoa a ser editada</h1>";
                echo "<a href='Funcionarios.php'>Voltar a funcionarios</a>";
                die;
            }
        }

        if(isMetodo("POST")) {
            if(parametrosValidos($_POST, ["id", "nome", "email"])) {
                $resultado = Funcionario::editar($_POST["id"],$_POST["nome"], $_POST["email"]);
                if ($resultado) {
                    echo "<h1>Funcionario editado com sucesso</h1>";
                    echo "<a href='Funcionarios.php'>Voltar a funcionarios</a>";
                    die;
                } else {
                    echo "<h2>Nenhuma alteração foi feita.</h2>";
                    echo "<a href='Funcionarios.php'>Voltar a funcionarios</a>";
                    die;
                }
                
            } else {
                echo "<h1>Você deve dizer qual é o funcionario a ser editado</h1>";
                echo "<a href='Funcionarios.php'>Voltar a funcionarios</a>";
                die;
            }
        }

    ?>
    <h1>Editando as informações de <?= $func["nome"] ?></h1>
    <form method="POST">
        <p>Digite o nome</p>
        <input type="text" name="nome" value="<?= $func["nome"] ?>" required>
        <p>Digite o email</p>
        <input type="email" name="email" value="<?= $func["email"] ?>" required>
        <input type="hidden" name="id" value="<?= $func["id"] ?>">
    
        <br><br><br>
        <button>Editar</button>

    </form>
</body>
</html>
