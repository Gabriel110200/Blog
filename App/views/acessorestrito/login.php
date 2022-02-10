<?php
if (isset($data['mensagens'])) {
?>
    <div class="col-6">
        <div class="alert alert-danger" role="alert">
            <?php
            foreach ($data['mensagens'] as $mensagem) {
                echo $mensagem . '<br>';
            }
            ?>
        </div>

    </div>

<?php } ?>



<form action="<?= URL_BASE . '/acessorestrito/logar' ?>" method="POST">
    <input id="CSRF_token" type="hidden" name="CSRF_token" value="<?= $_SESSION['CSRF_token'] ?>">

    <div class="col-6">
        <div class="form-group">
            <label for="exampleInputEmail1" class="form-label">Email </label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="senha" class="form-control" id="exampleInputPassword1 required">
        </div>

        <div class="form-group">
            <?php echo $data['imagem'] ?>
        </div>

        <div class="form-group">
            <input id="captcha" class="form-control" name="captcha" placeholder="Digite o que está escrito no Captcha" type="text" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>