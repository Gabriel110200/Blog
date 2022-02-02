<?php 

namespace App/models; 


class Usuario 
{
    private $id,$nome,$email,$senha;


    public function __construct()
    {

        $this->id = 0 ;
        $this->nome = ""; 
        $this->senha = '';
        $this->hashid = ''; 

    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {

        $this->senha = $senha;
    }

    public function getHashid()
    {
        return $this->hashid;
    }

    public function setHashid($hash){

        $this->hash = $hash;
    }



}