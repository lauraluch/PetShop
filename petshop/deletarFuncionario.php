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
        require_once "model/Atende.php";

        $funcionario = null;

        if(isMetodo("GET")) {
            if(parametrosValidos($_GET, ["id"])) {
                $id = $_GET["id"];
                if (Funcionario::existeId($id)) {
                    $funcionario = Funcionario::getFuncById($id);


                    
                } else {
                    echo "<h1>Este funcionario não existe</h1>";
                    echo "<a href='Funcionarios.php'>Voltar a funcionarios</a>";
                    die;
                }
                
            } else {
                echo "<h1>Você deve dizer qual é o funcionario a ser deletado</h1>";
                echo "<a href='Funcionarios.php'>Voltar a funcionarios</a>";
                die;
            }
        }

        if(isMetodo("POST")) {
            if(parametrosValidos($_POST, ["id"])) {
                $resultado = Funcionario::remover($_POST["id"]);
                if ($resultado) {
                    echo "<h1>Funcionario deletado com sucesso</h1>";
                    echo "<a href='Funcionarios.php'>Voltar a funcionarios</a>";
                    die;
                } else {
                    echo "<h1>Erro ao deletar o funcionario</h1>";
                    echo "<a href='Funcionarios.php'>Voltar a funcionarios</a>";
                    die;
                }
                
            } else {
                echo "<h1>Você deve dizer qual é a pessoa a ser excluida</h1>";
                echo "<a href='Funcionarios.php'>Voltar a funcionarios</a>";
                die;
            }
        }

    ?>
    <h1>Deletar as informações de <?= $funcionario["nome"] ?></h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $funcionario["id"] ?>">
        
        <button>Sim</button>
    </form>
    <br>
    <a href='index.php'>Voltar ao index</a>
</body>
</html>
