<?php
    require_once __DIR__. "/../configs/BancoDados.php";

    class Atende{
        public static function cadastrar($idFuncionario, $idAnimal, $data){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "INSERT INTO atende(idFuncionario, idAnimal, data) VALUES (:idFuncionario, :idAnimal, :data)"
                );

                $stmt->execute([
                    "idFuncionario" => $idFuncionario,
                    "idAnimal" => $idAnimal,
                    "data" => $data
                ]);

                if($stmt->rowCount() > 0){
                    return true;
                }
                return false;
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function remover($id){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "DELETE FROM atende WHERE id = ?"
                );

                $stmt->execute([$id]);

                if($stmt->rowCount() > 0){
                    return true;
                }
                return false;
                
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
    }
?>