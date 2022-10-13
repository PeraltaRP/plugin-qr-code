<?php 
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

function gera_qr_code($link, $titulo, $titulo_download)
{

?>

    <?php
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

                <a href=<?= $titulo_download ?> download=<?= $titulo_download ?>>
                    <div class="icon-centered"><i class="icon-download"></i></div>
                </a>
            </div>
        </div>
<?php
}

