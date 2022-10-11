<?php
/*
Plugin Name: Qr Code Tainacna 
Description: Plugin para criar imagem qr code com o link para cada item salvo nas coleçoes
Author: PeraltaRP
Version: 0.0.1
Text Domain: -qrcode-exposer

*/

require_once 'vendor/autoload.php';
require_once 'BancodeDados.php';
require_once 'gera_title.php';
require_once 'Gera_qr_Code.php';
// require_once 'listar_itens.php';




register_activation_hook(__FILE__, 'create_table');

add_action('admin_menu', 'qr_code_init');

function qr_code_init()
{
    add_menu_page('Test Plugin Page', 'Teste Plugin', 'manage_options', 'test-plugin', 'load_page');
}

function styles()
{
    // carrega estilos do bootstrap
    wp_register_style('bootStrap', plugins_url('styles/bootstrap.css', __FILE__));
    wp_enqueue_style('bootStrap');

    // carrega estilos do css
    wp_register_style('css', plugins_url('styles/style.css', __FILE__));
    wp_enqueue_style('css');

    // carrega icone dos cards
    wp_register_style('icon', plugins_url('styles/assets/style.css', __FILE__));
    wp_enqueue_style('icon');

    wp_register_script('jquery', plugins_url('autocomplet/javascript/jquery.js', __FILE__));
    wp_enqueue_script('jquery');

    wp_enqueue_style('awesomepletecss', plugins_url('autocomplete/styles/awesomplete.css', __FILE__));
    wp_enqueue_script('awesompletejs', plugins_url('autocomplete/javascript/custom.js', __FILE__));
    


    // carrega funçoes do java Script
    // wp_register_script('javascript', plugins_url('styles/javascript/custom.js', __FILE__));
    // wp_enqueue_script('javascript');

    // wp_register_script('jqueryuijs', plugins_url('styles/javascript/jquery-ui.min.js', __FILE__));
    // wp_enqueue_script('jqueryuijs');
    
    // wp_register_script('jquery', plugins_url('styles/javascript/jquery.js', __FILE__));
    // wp_enqueue_script('jquery');

    // wp_register_style('jqueryuicss', plugins_url('styles/javascript/jquery-ui.min.css', __FILE__));
    // wp_enqueue_style('jqueryuicss');
}

add_action('admin_init', 'styles');

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
        <h1>Qr Code Tainacan</h1>
      

        <div class="container">
            <h1 class="mt-4 mb-4">Formulário</h1>
            <form class="row g-3">
                
                <div class="col-12">
                    <label for="input-item" class="form-label">Item</label>
                    <input type="text" name="item" class="form-control" id="busca" placeholder="Pesquisar item" />
                </div>
            
                <!-- <div class="col-12">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div> -->
            </form>
        </div>
    </body>

    </html>
<?
}
