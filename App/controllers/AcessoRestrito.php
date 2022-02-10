<?php

use App\core\BaseController;
use App\core\Funcoes;
use GUMP as Validador;

class AcessoRestrito extends BaseController
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



    function __construct()
    {
        session_start();
    }

    public function login()
    {
        $_SESSION['CAPTCHA_CODE'] = Funcoes::gerarCaptcha();
        $imagem = Funcoes::gerarImgCaptcha($_SESSION['CAPTCHA_CODE']);
        $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();
        $data = ['imagem' => $imagem];
        $this->view('acessorestrito/login', $data);
    }

    public function logar()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") :



            Validador::add_validator("validar_CAPTCHA_CODE", function ($field, $input) {
                return $input['captcha'] === $_SESSION['CAPTCHA_CODE'];
            }, 'Código de Segurança incorreto.');

            $validacao = new Validador("pt-br");

            $post_filtrado = $validacao->filter($_POST, $this->filters);
            $post_validado = $validacao->validate($post_filtrado, $this->rules);



            if ($post_validado === true) :

                if ($_POST['CSRF_token'] == $_SESSION['CSRF_token']) :
                    $senha_enviada = $_POST['senha'];

                    // gera uma senha fake 

                    $senha_fake = random_bytes(64);
                    $hash_senha_fake = password_hash($senha_fake, PASSWORD_ARGON2I);

                    // busca o usuario 

                    $usuarioModel  = $this->model('UserModel');
                    $usuario = $usuarioModel->getUsuario($_POST['email']);

                    if (!empty($usuario)) :
                        $senha_hash = $usuario['senha'];
                    else :
                        $senha_hash = $hash_senha_fake;
                    endif;

                    if (password_verify($senha_enviada, $senha_hash)) :
                        $_SESSION[' id '] = $usuario['id'];
                        $_SESSION['nomeUsuario'] = $usuario['nome'];
                        $_SESSION['emailUsuario'] = $usuario['email'];

                        Funcoes::redirect("Dashboard");
                    else :
                        $mensagem = ["Usuário e/ou Senha incorreta"];
                        $_SESSION['CAPTCHA_CODE'] = Funcoes::gerarCaptcha();
                        $imagem = Funcoes::gerarImgCaptcha($_SESSION['CAPTCHA_CODE']);
                        $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

                        $data = [
                            'imagem' => $imagem,
                            'mensagens' => $mensagem
                        ];

                        $this->view('acessorestrito/login', $data);

                    endif;

                else : //falha de token csrf
                    die('Erro 404');

                endif;

            else : // erro de validação 
                $mensagem = $validacao->get_errors_array();
                $_SESSION['CAPTCHA_CODE'] = Funcoes::gerarCaptcha();
                $imagem = Funcoes::gerarImgCaptcha($_SESSION['CAPTCHA_CODE']);
                $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

                $data = [
                    'imagem' => $imagem,
                    'mensagem' => $mensagem
                ];


                $this->view('acessorestrito/login', $data);


            endif;

        else : // nao for post 
            Funcoes::redirect();
        endif;
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        Funcoes::redirect();
    }
}
