<?php

class Registro extends BaseController
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

    public function inserir()
    {
        if ($_SERVER['POST']) {
            $name = $_SERVER['name']; 
            $password = $_SERVER['password']; 
            $
        }
    }
}
