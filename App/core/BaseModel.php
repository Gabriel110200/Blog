<?php

namespace App\Core;

use \PDO;
use \PDOException;

class BaseModel
{
    public static function getConexao()
    {

        $banco = "mysql:host=" . HOST . ";dbname=" . DB;
        $opcoes = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        try {
            return new PDO($banco, USUARIO, SENHA, $opcoes);
        } catch (PDOException $e) {
            echo 'Conexao falhou: ' . $e->getMessage();
        }
    }
}
