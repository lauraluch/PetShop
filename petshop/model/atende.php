<?php
    require_once __DIR__. "/../configs/BancoDados.php";

    class Atende{
        public static function cadastrar($idFuncionario, $idAnimal){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "INSERT INTO atende(idFuncionario, idAnimal, data) VALUES (:idFuncionario, :idAnimal, NOW())"
                );

                $stmt->execute([
                    "idFuncionario" => $idFuncionario,
                    "idAnimal" => $idAnimal
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

        public static function listar(){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT at.id id_atende, f.id id_func, f.nome nome_func, a.id id_animal, a.nome nome_animal, at.data data_atende FROM atende at, animal a, funcionario f where at.idFuncionario = f.id and at.idAnimal = a.id ORDER BY at.id"
                );
                $stmt->execute();

                return $stmt->fetchAll();
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function existeId($id){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT COUNT(*) FROM atende     WHERE id = ?"
                );
                $stmt->execute([$id]);

                $quantidade = $stmt->fetchColumn();
                if ($quantidade > 0) return true;
                return false;

            } catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        
        }
    }
?>
