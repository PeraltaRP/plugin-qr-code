<?php

// função para criar a tabela com dados para o plugin no bano de dados
function create_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'qrtainacan';
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

// cada vez que o plugin for inicializado ele faz a leitura do banco de dados e guarda na sua propria tabela
function insert_database($titulo, $titulo_download, $link)
{
    global $wpdb; ////Classe de abstração de acesso ao banco de dados WordPress.
    $table_name = $wpdb->prefix . 'qrtainacan'; // prefixo da tabela onde será inserido os novos dados

    $wpdb->insert( // Classe de abstração de inserção
        $table_name,
        array( //array com nossos dados 
            'data' => current_time('mysql'), //data da inserção
            'titulo_exibicao' => $titulo,  //titulo do item
            'titulo_download' => $titulo_download, //titulo para o caminho do download
            'link' => $link,  //link de acesso ao arquivo json do item salvo no Tainacan
        )
    );
}

function delete_banco_dados()
{
    global $wpdb;
    $table_name = $table_name = $wpdb->prefix . 'qrtainacan';

    $delete = $wpdb->query("TRUCATE TABLE '$table_name' ");

    get_post_tainacan();
}

// função responsavel por ler a tabela posts onde o tainacan publica os itens criados
function get_post_tainacan()
{
    global $wpdb; //Classe de abstração de acesso ao banco de dados WordPress.
    $table_name = $wpdb->prefix . "posts"; //passando o prefix da tabela que iremos ler
    $resultado = $wpdb->get_results("SELECT * FROM $table_name WHERE post_status = 'publish'"); //variavel resultado rescebe todo o conteudo encontrado
    if (empty($resultado)) { //verifica se o bano de dados esta vazio

        echo ("vazio");
    }
    foreach ($resultado as $value) { //caso contrario iremos percorer o array  resultado
        if (strpos($value->post_title, 'foi criado com o ID') == true) { // usamos o termo para distinguei um post Tainacan dos outros posts do wordpress
            $id = explode(" ", $value->post_title); //variavel id rescebe o post_title e divide em um array 
            for ($x = 0; $x < count($id); $x++) { //percorremos esse novo para distinguir qual a posição do id do item
                if ($id[$x] == 'ID') {  //comparamos se na posicao atual conter a string ID
                    $host = network_site_url('/'); // Classe de abstração de acesso ao host de hospedagem
                    $link = $host . "wp-json/tainacan/v2/items/" . $id[$x + 1]; //Formatando o link de acesso ao json do item 
                    $titulo = gera_title($link); //Função para obter um link valido e tambem o titulo do item
                    if ($titulo != NULL) { // Caso o link for validado, todas as informações são salvas no banco de dadosS
                        $titulo_download = str_replace(" ", "_", $titulo) . ".svg"; // Formatando o titulo para o caminho de donwload
                        insert_database($titulo, $titulo_download, $link);
                    }
                }
            }
        }
    }
}


// função responsavel por criar o auto complete com dados ja inseridos dentro da tabela qrtainacan
function consulta_banco_de_dados()
{
    global $wpdb; //Classe de abstração de acesso ao banco de dados WordPress.
    $table_name = $wpdb->prefix . "qrtainacan";
    $resultado = $wpdb->get_results("SELECT id , titulo_exibicao FROM $table_name");
    if (empty($resultado)) {
        echo ("null");
    } else {
        return $resultado;
    }
}

function busca_banco_dados($item)
{

    global $wpdb;
    $table_name = $wpdb->prefix . "qrtainacan";
    $resultado = $wpdb->get_results("SELECT titulo_exibicao, titulo_download, link FROM $table_name WHERE titulo_exibicao = '$item' ");
    return ($resultado);
}


function ultima_insercao($tipo_pedido)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "qrtainacan";
    $resultado = $wpdb->get_results("SELECT titulo_exibicao, titulo_download, link, data FROM $table_name ORDER BY id desc LIMIT 3");
    if ($tipo_pedido == "ult_data") {
        foreach ($resultado as $value) {
            $ultima_data = $value->data;
        }
        return $ultima_data;
    } else {
        return ($resultado);
    }
}
