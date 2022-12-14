<?php

//** --------------------------------------------- */
//** Conexao com banco de dados PORTAL
//** --------------------------------------------- */

/** Usuário do banco de dados SQL */
define('DB_USER', 'root');

/** Senha do banco de dados SQL */
define('DB_PASSWORD', '');

/** nome do host do SQL */
define('DB_HOST', 'localhost');
/** nome do driver do SQL */
define('DB_DRIVER', 'mysql');

define('DB_NAME', 'sgt');

/** caminho absoluto para a pasta do sistema **/
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** caminho no server para o sistema **/
if ( !defined('BASEURL') )
	define('BASEURL', "http://" . $_SERVER['SERVER_NAME']."/sgt/");

if ( !defined('BASEURL_SGT') )
    define('BASEURL_SGT'    ,"http://" . $_SERVER['SERVER_NAME']."/sgt/");

/** caminho do arquivo de banco de dados **/
if ( !defined('DBAPI') )
	define('DBAPI', ABSPATH . 'includes/database.php');

/** caminhos dos templates de header e footer **/
define('HEADER_TEMPLATE', ABSPATH . 'includes/header.php');
define('MENU_TEMPLATE', ABSPATH . 'includes/menu.php');
define('FOOTER_TEMPLATE', ABSPATH . 'includes/footer.php');
define('ESTILO_TEMPLATE', ABSPATH . 'includes/estilo.php');
define('MENU_CONFIG', ABSPATH . 'sgq/configuracoes/menu_config.php');
define('__DIR__','sgt');

/*define time zone*/
date_default_timezone_set('America/Sao_Paulo');

if (!function_exists('formataTelefone')) {
    function formataTelefone($numero)
    {
        if (strlen($numero) == 10) {
            $novo = substr_replace($numero, '(', 0, 0);
            $novo = substr_replace($novo, '9', 3, 0);
            $novo = substr_replace($novo, ')', 3, 0);
        } else {
            $novo = substr_replace($numero, '(', 0, 0);
            $novo = substr_replace($novo, ')', 3, 0);
        }
        return $novo;
    }
}