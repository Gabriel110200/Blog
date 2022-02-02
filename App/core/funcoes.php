<?php

namespace App\core;

class Funcoes
{

    public static function gerarTokenCSRF()
    {
        $string_aleatoria = bin2hex(openssl_random_pseudo_bytes(16));
        return hash_hmac('sha256', $string_aleatoria, CSRF_TOKEN_SECRET);
    }

    public static function gerarCaptcha()
    {
        $random_num = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
        $captcha_code = substr($random_num, 0, 5);
        return $captcha_code;
    }



    public static function gerarImgCaptcha($captcha_code)
    {
        $nome_imagem = random_int(10000, 99999); // usa apenas os 5 primeiros 

        //cria uma imagem a partir de template_cap.jpg
        $imagem = imagecreatefromjpeg(DIR_IMG_CAPTCHA . 'template_cap.jpg');
        $cor_texto = imagecolorallocate($imagem, 0, 0, 0);

        // inserir o captcha_code na imagem usando cor do texto e fontes TrueType
        $font = DIR_IMG_CAPTCHA . 'arial.ttf';
        imagettftext($imagem, 20, 0, 10, 25, $cor_texto, $font, $captcha_code);


        // salva a imagem na view
        $imagem_captcha = DIR_IMG_CAPTCHA . "captcha_" . $nome_imagem . ".jpg";
        imageJpeg($imagem, $imagem_captcha, 100);

        // le a imaem coo uma string e converte o encodig para base 64
        $imageData = base64_encode(file_get_contents($imagem_captcha));

        // Formata a iumagem em base64 SRC: data:{mime};base64,{data}, 

        $src = 'data:jpeg;base64,' . $imageData;

        // apaga a imagem da pasta 

        unlink($imagem_captcha);

        // retorna a tag img com a string base64 
        return '<img src=' . $src . ">'";
    }
}
