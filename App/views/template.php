<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= URL_CSS ?>bootstrap.min.css">


    <title>Blog de Notícia</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="<?= URL_IMG ?>uff.png" width="40" height="30" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/Home">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/AcessoRestrito/login">Área Restrita</a>
                </li>

            </ul>
        </div>
    </nav>

    <!-- Vai inserir a view no template que será passada -->

    <?php require_once '../App/views/' . $view . '.php' ?>

    <div class="container-fluid mt-3">
        <?php require_once '../App/views/' . $view . '.php' ?>

    </div>

    <script src="<?= URL_JS ?>jquery-3.4.1.min.js"></script>
    <script src="<?= URL_JS ?>popper.min.js"></script>
    <script src="<?= URL_JS ?>bootstrap.min.js"></script>

</body>

</html>