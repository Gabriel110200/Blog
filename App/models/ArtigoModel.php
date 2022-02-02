<?php

use App\Core\BaseModel;

class ArtigoModel extends BaseModel
{

    public function create($artigo)
    {
        try {

            $sql = "INSERT INTO artigos(titulo,conteudo) VALUES (?,?)";

            $conn = ArtigoModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $artigo->getTitulo());
            $stmt->bindValue(2, $artigo->getConteudo());

            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }


    public function read()
    {
        $sql = "SELECT * FROM  artigos";

        $conn = ArtigoModel::getConexao();

        $stmt = $conn->query($sql);

        return $stmt;
    }
}
