<?php
    require_once __DIR__. "/../configs/BancoDados.php";

    class Funcionario{
        public static function cadastrar($nome, $email){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "INSERT INTO funcionario(nome, email, dataCadastro) VALUES (:nome, :email, NOW())"
                );

                $stmt->execute([
                    "nome" => $nome,
                    "email" => $email
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
                    "SELECT * FROM funcionario ORDER BY id"
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
                    "DELETE FROM funcionario WHERE id = ?"
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
                $stmt = $conexao->prepare( // prepara uma declaração SQL para execução
                    "SELECT COUNT(*) FROM funcionario WHERE id = ?" // notação posicional
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

        public static function existeEmail($email){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT COUNT(*) FROM funcionario WHERE email = ?"
                );
                $stmt->execute([$email]);

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
