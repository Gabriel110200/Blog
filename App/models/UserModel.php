<?php

use App\Core\BaseModel;

class UserModel extends BaseModel
{
    public function create($usuario)
    {
        try {
            $sql = "INSERT INTO usuarios(nome,email,senha) VALUES (?,?,?)";
            $conn = UserModel::getConexao();

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(1, $usuario->getNome());
            $stmt->bindValue(2, $usuario->getEmail());
            $stmt->bindValue(3, $usuario->getSenha());

            $stmt->execute();

            $conn = null;
        } catch (PDOException $e) {
            die('Query Falhou: ' . $e->getMessage());
        }
    }


    public function get($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $conn = UserModel::getConexao();
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(1, $id);
        $stmt->execute();
        $conn = null;
    }


    public function getUsuarioEmail($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $conn = UserModel::getConexao();
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(1, $email);
        $stmt->execute();
        $conn = null;
    }
}
