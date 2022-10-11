<?php

function consult_database()
{
    global $wpdb;
    $name_BD = $wpdb->prefix . "linksqrcode";
    $resultado = $wpdb->get_results("SELECT titulo_exibicao FROM $name_BD");
    if (empty($resultado)) {
        echo ("O banco de dados esta vazio!");
    } else {
        $json = json_encode($resultado);
        echo $json;
    }
}