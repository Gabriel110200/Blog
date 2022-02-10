<?php

use App\Core\BaseController;
use GUMP as Validador;
use App\models\Usuario;

class Users extends BaseController
{

    protected $filters = [
        'email' => 'trim|sanitize_email',
        'senha' => 'trim|sanitize_string',
        'captcha' => 'trim|sanitize_string'

    ];

    protected $rules = [
        'email' => 'required|min_len,8|max_len,255',
        'senha' => 'required',
        'captcha' => 'required|validar_CAPTCHA_CODE'

    ];

    public function registrar()
    {

        if ($_SERVER['REQUEST_METHOD' == 'POST']) :

            if ($_POST['CSRF_token'] ==  $_SESSION['CSRF_token']) :

                $validacao = new Validador("pt-br");
                $post_filtrado = $validacao->filter($_POST, $this->filters);
                $post_validado = $validacao->validate($post_filtrado, $this->rules);

                if ($post_validado == true) :

                    $hash_senha = password_hash($_POST['nome'], PASSWORD_ARGON2I);

                    $usuario = new Usuario();

                    $usuario->setEmail($_POST['email']);
                    $usuario->setNome($_POST['nome']);
                    $usuario->setSenha($_POST['senha']);

                    $userModel = $this->model('UserModel');

                    $chave_gerada = $userModel->create($usuario);

                    $hashId = hash('sha512', $chave_gerada);

                    $userModel->createHashID($chave_gerada, $hashId);



                endif;

            endif;

        endif;
    }
}
