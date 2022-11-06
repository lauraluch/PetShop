<?php
    require_once __DIR__. "/../configs/BancoDados.php";

    class Relatorio{
        public static function listarAnimaisCuidadosPorFuncionario($idFuncionario){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT * FROM animal WHERE id IN (SELECT idAnimal FROM atende where idFuncionario = ?)"
                );
                $stmt->execute([$idFuncionario]);

                return $stmt->fetchAll();
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function listarAnimaisPorRaca($raca){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT * FROM animal WHERE raca = ?"
                );
                $stmt->execute([$raca]);

                return $stmt->fetchAll();
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

    }