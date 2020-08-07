<?php

namespace driver\control;

use driver\view\view;
use driver\router\router;

abstract class action extends view
{
    const _LOCAL = __DIR__;

    /**
     * Função a ser executada no contexto da action
     *
     * @param array $info
     * @return void
     */
    abstract public function main(array $info);

    /**
     * Expõe a pasta de resource do framework Heartwood
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
     * Cria o array de busca
     *
     * @param array $post
     * @return void
     */
    protected function where(array $post = null)
    {
        return array('active = 1');
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
    public function _before()
    {
        return null;
    }


    /**
     * Para ser disparado depois
     *
     * @return void
     */
    public function _after()
    {
        return null;
    }

    /**
     * Devolve o slug definido para a area
     */
    public function area()
    {
        return null;
    }
}