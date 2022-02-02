<?php


$artigos = $data['artigos'];

if (!empty($artigos)) :
    foreach ($artigos as $artigo) { ?>

        <p></p>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $artigo['titulo'] ?></h5>
                <p class="card-text"><?= $artigo['conteudo'] ?></p>
            </div>
        </div>


<?php }

else :
    echo 'Não há artigos';
endif;

?>