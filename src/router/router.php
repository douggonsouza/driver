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
    public static function setInfoLocal(string $typeRequest, string $localRoot, string $localRequest)
    {
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
            return;
        }

        if(!isset($pattern) || empty($pattern)){
            return;
        }

        if(!isset($controller) || empty($controller)){
            return;
        }

        if(strtolower($typeRequest) != strtolower(self::getTypeRequest())){
            return;
        }

        if(isset($autenticate) && !empty($autenticate)){
            if(!self::autenticate($autenticate)){
                return;
            }
        }

        if (!preg_match(
            self::translatesToRegex($pattern),
            self::getLocalRequest(),
            $params)) {
            return false;
        }

        return self::instanceController($controller, $params);
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
    protected static function instanceController(string $controller, array $params = null)
    {
        if(!isset($controller) && empty($controller)){
            return;
        }

        self::setController(new $controller());
        if(!is_null(self::getController())){
            return self::getController()->main(array(
                'url' => $params
            ));
        }

        return;
    }

    /**
     * Valida o autenticate do heard
     *
     * @param string $key
     * @return void
     */
    protected static function autenticate(string $key)
    {
        self::setAutenticate(new autenticate(self::getLocalRoot(),self::getLocalRequest()));
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
}