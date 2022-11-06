<?php
    require_once __DIR__. "/../configs/BancoDados.php";
    require_once "model/atende.php";
    
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
        
        public static function remover($id){
            try{
                $conexao = Conexao::getConexao();
                Atende::removerPorIdFuncionario($id);
                $stmt = $conexao->prepare(
                    "DELETE FROM funcionario WHERE id = :id"
                );
                $stmt->execute([
                    "id" => $id
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

        public static function listarAtendimentos($id){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT DISTINCT f.* from funcionario f, atende a WHERE f.id = a.idFuncionario and a.idAnimal = $id ORDER BY id"
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

        public static function getFuncById($id){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT * FROM funcionario WHERE id = ?"
                );
                $stmt->execute([$id]);
    
                return $stmt->fetchAll()[0];
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public static function editar($id, $nome, $email){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "UPDATE funcionario SET nome = ?, email = ? WHERE id = ?"
                );
                $stmt->execute([$nome, $email, $id]);
    
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
    
    
            }
            catch(Exception $e) {
                return false;
            }
        }

    }
?>
