<?php

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

function gera_qr_code($titulo, $titulo_download, $link)
{

?>

    <?php
    if (empty($titulo )) {
        echo ("Dados para gerar Qr Code se encontram vazios!");
    } else {
        $tamanho = 190;
        $margem = 3;
        $style = new RendererStyle($tamanho, $margem, null, null, null);
        $renderer = new ImageRenderer($style, new SvgImageBackEnd());

        $writer = new Writer($renderer);
        $qr = ($writer->writeString($link));
        file_put_contents($titulo, $qr);
    ?>

        <div class="card">
            <img> <?= $qr ?> </img>
            <p>

            <div class="title_div">
                <p class="title"> <?= $titulo ?> </p>

                <a class="a_link" href=<?= $titulo_download ?> download=<?= $titulo_download ?>>
                    <div class="icon-centered"><i id="i-download" class="icon-download"></i></div>
                </a>
            </div>
        </div>
<?php
    }
}
