<?php

namespace driver\view;

use driver\view\display;

class view extends display
{
    private   $params = array();
    public    $template = null;
    protected $heartwoodResponses;
    protected $layout;

	/**
	 * Requisita carregamento do template com endereço completo
	 * @param unknown $my
	 */
    final public function view($params = null)
    {
        $this->setParams($params);
        parent::body(
            self::getLayout(),
            $this->getParams()
        );
    }
    
    /**
	 * Requisita o carregamento do template
	 * @param unknown $my
	 */
    public function content(array $params = null)
    {
        $this->setParams($params);                   
        parent::body(
            $this->getTemplate(),
            $this->getParams()
        );
        return;
	}
    
    /**
     * Responde a requisição com um array do tipo json
     * @param array $variables
     */
    final public function json($params)
    {
        if(!isset($params) || empty($params)){
            throw new \Exception("Parameters JSON not found.");
        }
        header('Content-Type: application/json');
        exit(json_encode($params));
    }
    
    /**
     * 
     */
    private function existExtensionTemplate($filename)
    {
        if(strpos($filename,'.phtml') === false)
            return $filename.'.phtml';
        return $filename;
    }

    /**
     * Seta um valor de par�metro
     *
     * @param string $name
     * @param mixed  $value
     * @return bool
     */
    public function param(string $name, $value)
    {
        if(!isset($name)){
            return false;
        }
        
        $this->params[$name] = $value;
        return true;
    }

    /**
     * Get the value of template
     */ 
    public function getTemplate()
    {
            return $this->template;
    }

    /**
     * Set the value of template
     *
     * @return  self
     */ 
    public function setTemplate($template)
    {
        if(isset($template) && !empty($template))
            $this->template = $this->existExtensionTemplate($template);
        return $this;
    }

    /**
     * Get the value of params
     */ 
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set the value of params
     *
     * @return  self
     */ 
    public function setParams($params)
    {
        if(isset($params) && !empty($params)){
            $this->params = array_merge($this->params,$params);
        }
        return $this;
    }

    /**
     * Get the value of layout
     */ 
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set the value of layout
     *
     * @return  self
     */ 
    public function setLayout($layout)
    {
        if(isset($layout) && !empty($layout)){
            $this->layout = $layout;
        }
        return $this;
    }

    /**
     * Get the value of heartwoodModel
     */ 
    public static function getHeartwoodModel()
    {
        return $_SERVER['DOCUMENT_ROOT'].'/src/common/models';
    }

    /**
     * Get the value of heartwoodAssets
     */ 
    public static function getHeartwoodAssets()
    {
        return $_SERVER['DOCUMENT_ROOT'].'/src/common/assets';
    }

    /**
     * Get the value of heartwoodAssets
     */ 
    public static function getUrlHeartwoodAssets()
    {
        return strtolower(explode('/',$_SERVER['SERVER_PROTOCOL'])[0]).'://'.$_SERVER['HTTP_HOST'].'/src/common/assets';
    }

    /**
     * Get the value of heartwoodManagments
     */ 
    public static function getHeartwoodManagments()
    {
        return $_SERVER['DOCUMENT_ROOT'].'/src/common/managments';
    }

    /**
     * Get the value of heartwoodLayouts
     */ 
    public static function getHeartwoodLayouts()
    {
        return $_SERVER['DOCUMENT_ROOT'].'/src/common/layouts';
    }

    /**
     * Get the value of heartwoodDefaultLayout
     */ 
    public static function getHeartwoodDefaultLayout()
    {
        return self::getHeartwoodLayouts().'/default.phtml';
    }

    /**
     * Get the value of heartwoodResponses
     */ 
    public function getHeartwoodResponses()
    {
        return $this->heartwoodResponses;
    }

    /**
     * Set the value of heartwoodResponses
     *
     * @return  self
     */ 
    public function setHeartwoodResponses($heartwoodResponses)
    {
        if(isset($heartwoodResponses) && !empty($heartwoodResponses)){
            $this->heartwoodResponses = $heartwoodResponses;
        }
        return $this;
    }
}        
