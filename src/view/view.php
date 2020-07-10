<?php

namespace driver\view;

use driver\view\display;

// Pasta Root
define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']);

class view extends display
{
    private $params = array();
    public  $template = null;
    public  $heartwoodModel = DIR_ROOT.'/src/common/models';
    public  $heartwoodAssets = DIR_ROOT.'/src/common/assets';
    public  $heartwoodManagments = DIR_ROOT.'/src/common/managments';
    public  $heartwoodLayouts = DIR_ROOT.'/src/common/layouts';

	/**
	 * Requisita carregamento do template com endereço completo
	 * @param unknown $my
	 */
    final public function view($params = null)
    {
        if($this->getLayout()){
            $this->setParams($params);
            $this->defineVarGlobal();
            parent::body($this->getLayout(), $this->getParams());
        }
    }
    
    /**
     * Responde a requisição com um array do tipo json
     * @param array $variables
     */
    final public function json($params)
    {
        if(!isset($params) || empty($params)){
            throw new \Exception("Parameters JSON not found");
        }
        header('Content-Type: application/json');
        exit(json_encode($params));
    }
    
    /**
     * Requisita o template na raiz da VIEW
     * @param string $name
     * @return type
     */
    final public function partial($name, $params = null)
    {
        $this->setParams($params);
        $this->defineVarGlobal();
        parent::body($name,$this->getParams());
        return;
	}
	
	/**
	 * Cria variável global a partir de params
	 * @param array $params
	 */
    private function defineVarGlobal()
    {
		if(is_array($this->getParams()) && count($this->getParams()) > 0){
            foreach($this->getParams() as $key => $vle){                       
			    $$key = $vle;
            }
            return true;    	
		}    		
        return false; 		 
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
            array_merge($this->params,$params);
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
    public function getHeartwoodModel()
    {
        return $this->heartwoodModel;
    }

    /**
     * Get the value of heartwoodAssets
     */ 
    public function getHeartwoodAssets()
    {
        return $this->heartwoodAssets;
    }

    /**
     * Get the value of heartwoodManagments
     */ 
    public function getHeartwoodManagments()
    {
        return $this->heartwoodManagments;
    }

    /**
     * Get the value of heartwoodLayouts
     */ 
    public function getHeartwoodLayouts()
    {
        return $this->heartwoodLayouts;
    }

    /**
     * Get the value of heartwoodDefaultLayout
     */ 
    public function getHeartwoodDefaultLayout()
    {
        return $this->getHeartwoodLayouts().'/default.phtml';
    }
}        
