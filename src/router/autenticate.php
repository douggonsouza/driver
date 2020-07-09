<?php

namespace driver\router;

class autenticate
{

    protected $headerAutenticate;
    protected $localRoot;
    protected $localRequest;

    public function __construct(string $localRoot, string $localRequest)
    {
        $this->setLocalRoot($localRoot);
        $this->setLocalRequest($locaRequest);
    }

    /**
     * Valida o autenticate do heard
     *
     * @param string $key
     * @return void
     */
    function asHeaderAutenticate(string $key)
    {
        $this->setHeaderAutenticate(get_headers($this->getLocalRoot().DS.$this->getLocalRequest(), 1));
    }

    /**
     * Valida o autenticate do heard
     *
     * @param string $key
     * @return void
     */
    function isHeaderAutenticate(string $key)
    {
        return $this->getHeaderAutenticate() == $key;
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
}

?>