<?php

    /*
     * CARREGAR DADOS GLOBAIS DE ACESSO
     * 
     * Nuclear Framework - PHP
     * @author Douglas GonÃ§alves de Souza
     * 
     * Configura INI para apresentaÃ§Ã£o dos erros
	 * E_ERROR
	 * E_WARNING
	 * E_PARSE
	 * E_NOTICE
	 * E_CORE_ERROR
	 * E_CORE_WARNING
	 * E_COMPILE_ERROR
	 * E_COMPILE_WARNING
	 * E_USER_ERROR
	 * E_USER_WARNING
	 * E_USER_NOTICE
	 * E_ALL
	 * E_STRICT
	 * E_RECOVERABLE_ERROR
     */
	error_reporting(1);
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);

    // Carrega o autload do Composer
    include_once __DIR__ . '/vendor/autoload.php';

    use driver\router\router;

    // DEFINIÇÕES DE URL
    // Protocolo utilizado na requisição
    define('PROTOCOL', strtolower(explode('/',$_SERVER['SERVER_PROTOCOL'])[0]).'://');
    // Host requerido
    define('LOCAL_ROOT',$_SERVER['HTTP_HOST']);
    // Requisição
    define('LOCAL_REQUEST',$_SERVER['REQUEST_URI']);
    // Tipo de requisição
    define('LOCAL_TYPE_REQUEST', $_SERVER['REQUEST_METHOD']);

    router::setInfoLocal(LOCAL_TYPE_REQUEST, LOCAL_ROOT, LOCAL_REQUEST);

    die(var_dump(router::route('GET','/admin/products/update/:number/:string',"driver\\helper\\html")));
?>

