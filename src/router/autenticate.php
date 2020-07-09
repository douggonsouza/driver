<?php

namespace driver\router;

class autenticate
{

    protected $headerAutenticate;

    /**
     * Valida o autenticate do heard
     *
     * @param string $key
     * @return void
     */
    function asHeaderAutenticate(string $key)
    {
        $this->setHeaderAutenticate(get_headers(LOCAL_ROOT.DS.LOCAL_REQUEST, 1));
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
}

?>