<?php

namespace driver\control;

use driver\view\view;
use driver\router\router;

abstract class action extends view
{
    const _LOCAL = __DIR__;

    /**
     * Fun�� a ser executada no contexto da action
     *
     * @param array $info
     * @return void
     */
    abstract public function main(array $info);

    /**
     * Exp�e a pasta de resource do framework Heartwood
     *
     * @return string
     */
    public static function defaultResponsesHeartwood($local)
    {
        if(strpos($local, 'controllers')){
            return str_replace('controllers','responses',$local);
        }
        return $local.'/resources';
    }

    public function init($local, $className)
    {
        try{
            // Assets Commons
            define('_assets', self::getUrlHeartwoodAssets());
            define('_root', strtolower(explode('/',$_SERVER['SERVER_PROTOCOL'])[0]).'://'.$_SERVER['HTTP_HOST']);

            // Responses atual
            $this->setHeartwoodResponses(self::defaultResponsesHeartwood($local));

            // Set Layout e template da controller
            $this->setLayout(self::getHeartwoodDefaultLayout());
            $name = explode("\\",(string) $className);
            $this->setTemplate(self::defaultResponsesHeartwood($local).'/'.end($name).'.phtml');

            return true;
        }
        catch(\Exception $e){
            return false;
        }
    }

    /**
	 * Requisita o carregamento do template
	 * @param unknown $my
	 */
    public function content(array $params = null)
    {
        return parent::content($params);
    }

    /**
     * Requisita o template na raiz da VIEW
     * @param string $local
     * @return type
     */
    public function partial($controller, $params = null)
    {
        return router::instanceController($controller, $params);
    }

    /**
     * Para ser disparado antes
     *
     * @return void
     */
    abstract public function _before();


    /**
     * Para ser disparado depois
     *
     * @return void
     */
    abstract public function _after();


    /**
     * Undocumented function
     *
     * @param [type] $local
     * @return void
     */
    final public function redirect($local)
    {
        if(isset($local) && strlen($local) > 0){
            header("location: ".$local);
            die();
        }
        return false;
    }
}