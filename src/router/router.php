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

    protected $controller;
    protected $typeRequest;
    protected $localRequest;
    protected $localRoot;

    protected $autenticate;

    public function __construct(string $typeRequest, string $localRoot, string $localRequest)
    {
        $this->setTypeRequest($typeRequest);
        $this->setLocalRoot($localRoot);
        $this->setLocalRequest($localRequest);
    }

    /**
     * Undocumented function
     *
     * @param string $typeRequest
     * @param string $pattern
     * @param string $url
     * @return void
     */
    protected function route($typeRequest, $pattern, $controller, $autenticate = null)
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

        if(strtolower($typeRequest) != strtolower($this->getTypeRequest())){
            return;
        }

        if(isset($autenticate) && !empty($autenticate)){
            if(!$this->autenticate($autenticate)){
                return;
            }
        }

        if (!preg_match(
            translatesToRegex($pattern),
            $this->getLocalRequest(),
            $params)) {
            return;
        }

        return instanceController($controller, $params);
    }

    /**
     * Traduz a string para regex
     *
     * @param string $text
     * @return stirng|null
     */
    function translatesToRegex(string $text)
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
    function instanceController(string $controller, array $params = null)
    {
        if(!isset($controller) && empty($controller)){
            return;
        }

        $this->setController(new $controller());
        if(!is_null($this->getController())){
            return $this->getController()->main(array(
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
    function autenticate(string $key)
    {
        $this->setAutenticate(new autenticate($this->getLocalRoot(),$this->getLocalRequest()));
        return $this->getAutenticate()->isHeaderAutenticate($key);
    }

    /**
     * Get the value of controller
     */ 
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the value of controller
     *
     * @return  self
     */ 
    public function setController($controller)
    {
        if(isset($controller) && !empty($controller)){
            $this->controller = $controller;
        }
        return $this;
    }

    /**
     * Get the value of autenticate
     */ 
    public function getAutenticate()
    {
        return $this->autenticate;
    }

    /**
     * Set the value of autenticate
     *
     * @return  self
     */ 
    public function setAutenticate($autenticate)
    {
        if(isset($autenticate) && !empty($autenticate)){
            $this->autenticate = $autenticate;
        }
        return $this;
    }

    /**
     * Get the value of typeRequest
     */ 
    public function getTypeRequest()
    {
        return $this->typeRequest;
    }

    /**
     * Set the value of typeRequest
     *
     * @return  self
     */ 
    public function setTypeRequest($typeRequest)
    {
        if(isset($typeRequest) && !empty(($typeRequest))){
            $this->typeRequest = $typeRequest;
        }
        return $this;
    }

    /**
     * Get the value of localRequest
     */ 
    public function getLocalRequest()
    {
        return $this->localRequest;
    }

    /**
     * Set the value of localRequest
     *
     * @return  self
     */ 
    public function setLocalRequest($localRequest)
    {
        if(isset($localRequest) && !empty($localRequest)){
            $this->localRequest = urldecode($localRequest);
        }
        return $this;
    }

    /**
     * Get the value of localRoot
     */ 
    public function getLocalRoot()
    {
        return $this->localRoot;
    }

    /**
     * Set the value of localRoot
     *
     * @return  self
     */ 
    public function setLocalRoot($localRoot)
    {
        if(isset($localRoot) && !empty($localRoot)){
            $this->localRoot = $localRoot;
        }
        return $this;
    }
}