<?php

namespace driver\control;

use driver\view\view;

abstract class action extends view
{
    const _LOCAL = __DIR__;

    /**
     * Funçã a ser executada no contexto da action
     *
     * @param array $info
     * @return void
     */
    abstract public function main(array $info);

    /**
     * Expóe a pasta de resource do framework Heartwood
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
        // Define o template para a controller
        $name = explode("\\",(string) $className);
        $template = self::defaultResponsesHeartwood($local).'/'.end($name).'.phtml';
        $this->setTemplate($template);

        return;
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