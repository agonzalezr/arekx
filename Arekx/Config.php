<?php namespace Arekx;

class Config
{
    private $param;

    public function __construct()
    {
        try {
            $this->param = simplexml_load_file(DOCUMENT_ROOT.'Config.xml');
        }catch(\Exception $ex){

            Render::json([
                "type" => "fatal",
                "message" => "No se pudo acceder al recurso solicitado. " . $ex->getMessage()
            ]);
        }

    }

    public function get($name){
        if(isset($this->param->$name))
            return $this->param->$name;
        else
            return null;
    }
}