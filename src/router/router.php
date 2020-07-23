<?php

// REGEX
// :number = somente números = (\d+)
// :char   = somente letras  = ([a-zA-Z]+)
// :alfanumeric = letras e números = ([a-zA-Z0-9]+)
// :string = letras, espaço e caracteres especiais = ([a-zA-Z0-9 .\-\_]+)

namespace driver\router;

use driver\router\autenticate;

abstract class router
{
    // TIPOS DE REQUISIÇÃO
    const _POST   = 'POST';
    const _GET    = 'GET';
    const _PUT    = 'PUT';
    const _DELETE = 'DELETE';
    const _HEAD   = 'HEAD';

    protected static $controller;
    protected static $protocol;
    protected static $typeRequest;
    protected static $localRequest;
    protected static $localRoot;

    protected static $autenticate;

    /**
     * colhe informações locais
     *
     * @param string $typeRequest
     * @param string $localRoot
     * @param string $localRequest
     * @return void
     */
    public static function setInfoLocal(string $protocol, string $typeRequest, string $localRoot, string $localRequest)
    {
        self::setProtocol($protocol);
        self::setTypeRequest($typeRequest);
        self::setLocalRoot($localRoot);
        self::setLocalRequest($localRequest);
    }

    /**
     * Undocumented function
     *
     * @param string $typeRequest
     * @param string $pattern
     * @param string $url
     * @return void
     */
    public static function route($typeRequest, $pattern, $controller, $autenticate = null)
    {
        if(!isset($typeRequest) || empty($typeRequest)){
            exit(self::http_response_code(500));
        }

        if(!isset($pattern) || empty($pattern)){
            exit(self::http_response_code(500));
        }

        if(!isset($controller) || empty($controller)){
            exit(self::http_response_code(500));
        }

        if(strtolower($typeRequest) != strtolower(self::getTypeRequest())){
            return;
        }

        if(isset($autenticate) && !empty($autenticate)){
            if(!self::autenticate($autenticate)){
                exit(self::http_response_code(401));
            }
        }

        if (!preg_match(
            self::translatesToRegex($pattern),
            self::getLocalRequest(),
            $params)) {
                return;
        }

        exit(self::http_response_code(
            self::instanceController($controller, $params)
        ));
    }

    /**
     * Traduz a string para regex
     *
     * @param string $text
     * @return stirng|null
     */
    protected static function translatesToRegex(string $text)
    {
        if(!isset($text) || empty($text)){
            return $text;
        }

        // traduz para regex
        return '/^'.str_replace(
            array('/',':number',':char',':alfanumeric',':string'),
            array('\/','(\d+)','([a-zA-Z]+)','([a-zA-Z0-9]+)','([a-zA-Z0-9 .\-\_]+)'),
            $text
        ).'$/';
    }

    /**
     * Instancia a classe de controller
     *
     * @param string     $controller
     * @param array|null $params
     * @return void
     */
    public static function instanceController(string $controller, array $params = null)
    {
        if(!isset($controller) && empty($controller)){
            return;
        }

        try{
            // inicia a controller
            self::setController(new $controller());
            if(is_null(self::getController())){
                return 404;
            }

            // parametriza a classe action
            if(!self::getController()->init(
                self::getController()::_LOCAL,
                get_class(self::getController())
            )){
                return 500;
            }
            // chama evento anterior
            self::getController()->_before();
            // chama função main
            self::getController()->main(array(
                'url' => $params
            ));
            // chama evento posterior
            self::getController()->_after();

            return 200;
        }
        catch(\Exeption $e){
            return 500;
        }
    }

    public static function http_response_code($code = NULL)
    {
        if(!isset($code) || empty($code)){
            $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);
        }

        switch ($code) {
            case 100: $text = 'Continue';
                break;
            case 101: $text = 'Switching Protocols';
                break;
            case 200: $text = 'OK';
                break;
            case 201: $text = 'Created';
                break;
            case 202: $text = 'Accepted';
                break;
            case 203: $text = 'Non-Authoritative Information';
                break;
            case 204: $text = 'No Content';
                break;
            case 205: $text = 'Reset Content';
                break;
            case 206: $text = 'Partial Content';
                break;
            case 300: $text = 'Multiple Choices';
                break;
            case 301: $text = 'Moved Permanently';
                break;
            case 302: $text = 'Moved Temporarily';
                break;
            case 303: $text = 'See Other';
                break;
            case 304: $text = 'Not Modified';
                break;
            case 305: $text = 'Use Proxy';
                break;
            case 400: $text = 'Bad Request';
                break;
            case 401: $text = 'Unauthorized';
                break;
            case 402: $text = 'Payment Required';
                break;
            case 403: $text = 'Forbidden';
                break;
            case 404: $text = 'Not Found';
                break;
            case 405: $text = 'Method Not Allowed';
                break;
            case 406: $text = 'Not Acceptable';
                break;
            case 407: $text = 'Proxy Authentication Required';
                break;
            case 408: $text = 'Request Time-out';
                break;
            case 409: $text = 'Conflict';
                break;
            case 410: $text = 'Gone';
                break;
            case 411: $text = 'Length Required';
                break;
            case 412: $text = 'Precondition Failed';
                break;
            case 413: $text = 'Request Entity Too Large';
                break;
            case 414: $text = 'Request-URI Too Large';
                break;
            case 415: $text = 'Unsupported Media Type';
                break;
            case 500: $text = 'Internal Server Error';
                break;
            case 501: $text = 'Not Implemented';
                break;
            case 502: $text = 'Bad Gateway';
                break;
            case 503: $text = 'Service Unavailable';
                break;
            case 504: $text = 'Gateway Time-out';
                break;
            case 505: $text = 'HTTP Version not supported';
                break;
            default:
                exit('Unknown http status code "' . htmlentities($code) . '"');
                break;
        }
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
        header($protocol . ' ' . $code . ' ' . $text);
        $GLOBALS['http_response_code'] = $code;

        return $code;
    }

    /**
     * Valida o autenticate do heard
     *
     * @param string $key
     * @return void
     */
    protected static function autenticate(string $key)
    {
        self::setAutenticate(new autenticate(self::getProtocol(), self::getLocalRoot(), self::getLocalRequest()));
        return self::getAutenticate()->isHeaderAutenticate($key);
    }

    /**
     * Get the value of controller
     */ 
    public static function getController()
    {
        return self::$controller;
    }

    /**
     * Set the value of controller
     *
     * @return  self
     */ 
    public static function setController($controller)
    {
        if(isset($controller) && !empty($controller)){
            self::$controller = $controller;
        }
    }

    /**
     * Get the value of autenticate
     */ 
    public static function getAutenticate()
    {
        return self::$autenticate;
    }

    /**
     * Set the value of autenticate
     *
     * @return  self
     */ 
    public static function setAutenticate($autenticate)
    {
        if(isset($autenticate) && !empty($autenticate)){
            self::$autenticate = $autenticate;
        }
    }

    /**
     * Get the value of typeRequest
     */ 
    public static function getTypeRequest()
    {
        return self::$typeRequest;
    }

    /**
     * Set the value of typeRequest
     *
     * @return  self
     */ 
    public static function setTypeRequest($typeRequest)
    {
        if(isset($typeRequest) && !empty(($typeRequest))){
            self::$typeRequest = $typeRequest;
        }
    }

    /**
     * Get the value of localRequest
     */ 
    public static function getLocalRequest()
    {
        return self::$localRequest;
    }

    /**
     * Set the value of localRequest
     *
     * @return  self
     */ 
    public static function setLocalRequest($localRequest)
    {
        if(isset($localRequest) && !empty($localRequest)){
            self::$localRequest = urldecode($localRequest);
        }
    }

    /**
     * Get the value of localRoot
     */ 
    public static function getLocalRoot()
    {
        return self::$localRoot;
    }

    /**
     * Set the value of localRoot
     *
     * @return  self
     */ 
    public static function setLocalRoot($localRoot)
    {
        if(isset($localRoot) && !empty($localRoot)){
            self::$localRoot = $localRoot;
        }
    }

    /**
     * Get the value of protocol
     */ 
    public static function getProtocol()
    {
        return self::$protocol;
    }

    /**
     * Set the value of protocol
     *
     * @return  self
     */ 
    public static function setProtocol($protocol)
    {
        if(isset($protocol) && !empty($protocol)){
            self::$protocol = $protocol;
        }
    }
}