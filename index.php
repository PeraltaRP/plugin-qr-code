<?php
/*
Plugin Name: Qr Code Tainacna 
Description: Plugin para criar imagem qr code com o link para cada item salvo nas coleçoes
Author: PeraltaRP
Version: 0.0.1
Text Domain: -qrcode-exposer

*/

require_once 'vendor/autoload.php';
require_once 'complementos/BancodeDados.php';
require_once 'complementos/Gera_title.php';
require_once 'complementos/Gera_qr_Code.php';
require_once 'pagina_inicial.php';

define("JQUERY_UI_WP_PATH", plugin_dir_path(__FILE__));
define("JQUERY_UI_WP_URL", plugin_dir_url(__FILE__));
register_activation_hook(__FILE__, 'create_table');

add_action('admin_menu', 'qr_code_init');



function qr_code_init()
{
    
    add_menu_page('Qr Code Taincan Page', 'Qr Code Tainacan', 'manage_options', 'Qr Code Taincan', 'carrega_html',  plugin_dir_url( __FILE__ ) . 'stilos/icon-menu/icon.png
    ' );
}

function styles()
{
    // carrega estilos do bootstrap
    wp_register_style('bootStrap', plugins_url('stilos/bootstrap.css', __FILE__));
    wp_enqueue_style('bootStrap');

    // carrega estilos do css
    wp_register_style('css', plugins_url('stilos/style.css', __FILE__));
    wp_enqueue_style('css');

    // carrega icone dos cards
    wp_register_style('icon', plugins_url('stilos/assets/style.css', __FILE__));
    wp_enqueue_style('icon');
}
add_action('admin_init', 'styles');


function jquery_ui_js_files()
{

    wp_enqueue_style("jquery-wp-css", JQUERY_UI_WP_URL . "assets/jquery-ui.min.css");

    wp_enqueue_script("jquery");

    wp_enqueue_script("jquery-ui-autocomplete");

    wp_enqueue_script("custom-script", JQUERY_UI_WP_URL . "assets/script.js", array('jquery'), "1.0.0", true);
}

add_action("admin_enqueue_scripts", "jquery_ui_js_files");


function wp_jquery_ui_callback_fn_autocomplete()
{
    ob_start();
    include_once JQUERY_UI_WP_PATH . 'autocomplete.php';
    $template = ob_get_contents();
    ob_end_clean();
    echo $template;
}



function carrega_html()
{
    $inicio = consulta_banco_de_dados();
    echo($inicio);
    if($inicio == "null"){
        echo("att banco");
        leitura_bd();
    }
    $inicio = consulta_banco_de_dados();
    if($inicio != "null"){
        echo("banco salvo");
    load_page();
    }
}
