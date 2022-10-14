<?php
function load_page()
{
?>

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <div class="container">
            <h1 class="mt-4 mb-4">Pesquisa Item Tainacan</h1>

            <h4>Ultima atualização </h4>
            <?ultima_atualizacao()?>
            </div>
            <div class="col-12">
                <form name="calc" method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <div class="ui-widget" style="margin-top:50px">
                        <label for="tags">Nome do Item: </label>
                        <input type="text" id="tags" name="item">
                        <button> Gera Qr Code </button>
                    </div>
                </form>

                <div id="resultado">
                    <?php
                    if (!empty($_POST['item'])) {
                        $item = $_POST['item'];
                        $resultado = busca_banco_dados($item);
                        foreach ($resultado as $value) {
                            $link = $value->link;
                            $titulo = $value->titulo_exibicao;
                            $download = $value->titulo_download;
                        }
                        gera_qr_code($titulo, $download, $link);
                    }
                    ?>
                    <script>
                        var availablePosts = [
                            <?php
                            $dados = consulta_banco_de_dados();
                            foreach ($dados as $value) {
                                echo '"' . $value->titulo_exibicao . '",';
                            }
                            ?>
                        ];
                    </script>
                </div>
            </div>
            </form>
        </div>

        <div class="footer">
            <h4>Ultimos itens inseridos</h4>
            <?
            $resultado = ultima_insercao();
            foreach ($resultado as $value) {
                $link = $value->link;
                $titulo = $value->titulo_exibicao;
                $download = $value->titulo_download;
                $ultima_data = $value->data;
                gera_qr_code($titulo, $download, $link);
            }

            ?>


        </div>
    </body>

    </html>
<?
}
