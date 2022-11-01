<?php
    require_once __DIR__. "/../configs/BancoDados.php";

    class Animal{
        public static function cadastrar($nome, $raca, $telDono){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "INSERT INTO animal(nome, raca, telDono, dataCadastro) VALUES (:nome, :raca, :telDono, NOW())"
                );

                $stmt->execute([
                    "nome" => $nome,
                    "raca" => $raca,
                    "telDono" => $telDono
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

        public static function listar(){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT * FROM animal ORDER BY id"
                );
                $stmt->execute();

                return $stmt->fetchAll();
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function remover($id){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "DELETE FROM animal WHERE id = ?"
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

        public static function existeId($id){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT COUNT(*) FROM animal WHERE id = ?"
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

        public static function getAnimalById($id){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT * FROM animal where id = ?");
                $stmt->execute([$id]);
    
                return $stmt->fetchAll()[0];
            }
            catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function editar($id, $nome, $raca, $telDono){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("UPDATE animal SET nome = ?, raca = ?, telDono = ? where id = ?");
                $stmt->execute([$nome, $raca, $telDono, $id]);
    
                if($stmt->rowCount() > 0){
                    return true;
                }
                else{
                    return false;
                }  
            }
            catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
    }
?>
