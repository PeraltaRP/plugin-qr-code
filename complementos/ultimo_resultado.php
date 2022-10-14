<?php
function ultima_atualizacao()
{

    $resultado = ultima_insercao();
    foreach ($resultado as $value) {
        $ultima_data = $value->data;
    }
    echo $ultima_data;
?>
    <div>
        <form action="" method="post">
            <input type="submit" value="Atualizar Banco de Dados" name="botao">
        </form>
    <?php
    if (!empty($_POST['botao'])) {
        echo "aqi";
        leitura_bd();
    }
}
