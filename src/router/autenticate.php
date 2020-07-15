<?php

namespace driver\router;

class autenticate
{

    protected $headerAutenticate;
    protected $authorization;
    protected $protocol;
    protected $localRoot;
    protected $localRequest;

    public function __construct(string $protocol, string $localRoot, string $localRequest)
    {
        $this->setProtocol($protocol);
        $this->setLocalRoot($localRoot);
        $this->setLocalRequest($localRequest);
        $this->setHeaderAutenticate(getallheaders());
        $this->authorization();
    }

    /**
     * Colhe a authori
     *
     * @return void
     */
    protected function authorization()
    {
        if(empty($this->getHeaderAutenticate())){
            return false;
        }

        $authorization = null;
        if(empty($this->getHeaderAutenticate()['Authorization'])){
            return false;
        }

        $authorization = str_replace('Bearer ','',$this->getHeaderAutenticate()['Authorization']);

        $this->setAuthorization($authorization);
        return true;
    }

    /**
     * Valida o autenticate do heard
     *
     * @param string $key
     * @return void
     */
    function isHeaderAutenticate(string $key)
    {
        return $this->getAuthorization() === $key;
    }

    /**
     * Get the value of headerAutenticate
     */ 
    public function getHeaderAutenticate()
    {
        return $this->headerAutenticate;
    }

    /**
     * Set the value of headerAutenticate
     *
     * @return  self
     */ 
    public function setHeaderAutenticate($headerAutenticate)
    {
        if(isset($headerAutenticate) && !empty($headerAutenticate)){
            $this->headerAutenticate = $headerAutenticate;
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
            $this->localRequest = $localRequest;
        }
        return $this;
    }

    /**
     * Get the value of protocol
     */ 
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * Set the value of protocol
     *
     * @return  self
     */ 
    public function setProtocol($protocol)
    {
        if(isset($protocol) && !empty($protocol)){
            $this->protocol = $protocol;
        }
        
        return $this;
    }

    /**
     * Get the value of authorization
     */ 
    public function getAuthorization()
    {
        return $this->authorization;
    }

    /**
     * Set the value of authorization
     *
     * @return  self
     */ 
    protected function setAuthorization($authorization)
    {
        if(isset($authorization) && !empty($authorization)){
            $this->authorization = $authorization;
        }
        
        return $this;
    }
}

?>