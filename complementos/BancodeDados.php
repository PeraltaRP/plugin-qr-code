<?php

function create_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'linksqrcode';
    $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
    id bigint(50) NOT NULL AUTO_INCREMENT,
    data datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    titulo_exibicao varchar(100),
    titulo_download varchar(100),
    link varchar(250),
    PRIMARY KEY  (id),
    CONSTRAINT link_unique UNIQUE (link)
	) $charset_collate;";

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

function insert_database($titulo, $titulo_download, $link)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'linksqrcode';

    $wpdb->insert(
        $table_name,
        array(
            'data' => current_time('mysql'),
            'titulo_exibicao' => $titulo,
            'titulo_download' => $titulo_download,
            'link' => $link,
        )
    );
}

function leitura_bd()
{
    global $wpdb;
    $name_BD = $wpdb->prefix . "posts";
    $resultado = $wpdb->get_results("SELECT * FROM $name_BD WHERE post_status = 'publish'");

    if (empty($resultado)) {
        echo ("vazio");
    }
    foreach ($resultado as $value) {
        if (strpos($value->post_title, 'criado') == true) {
            $posicao = strpos($value->post_title, 'ID');
            $id = explode(" ", $value->post_title);
            for ($x = 0; $x < count($id); $x++) {
                if ($id[$x] == 'ID') {
                    $host = network_site_url('/');
                    $link = $host . "wp-json/tainacan/v2/items/" . $id[$x + 1];
                    $titulo = gera_title($link);
                    $titulo_download = str_replace(" ", "_", $titulo) . ".svg";
                    if ($titulo != NULL) {
                        insert_database($titulo, $titulo_download, $link);
                    }
                }
            }
        }
    }
}

function consulta_banco_de_dados()
{
    global $wpdb;
    $name_BD = $wpdb->prefix . "linksqrcode";
    $resultado = $wpdb->get_results("SELECT titulo_exibicao FROM $name_BD");
    if (empty($resultado)) {
        echo ("O banco de dados esta vazio!");
    } else {
        return $resultado;
        // $json = json_encode($resultado);
        // echo $json;
    }
}
