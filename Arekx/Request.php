<?php namespace Arekx;

class Request
{
    private $request;

    public function __construct($method)
    {
        $method = strtoupper($method);

        if($_SERVER['REQUEST_METHOD'] != $method)
        {
            Render::json([
                "type" => "fatal",
                "message" => "El método solicitado no es válido."
            ]);

            exit;
        }

        switch ($method) {
            case 'POST':
                $this->request = (object) $_POST;
                break;
            case 'GET':
                $this->request = (object) $_GET;
                break;
            case 'PUT':
                parse_str(file_get_contents('php://input'), $_PUT);
                $this->request = (object) $_PUT;
                break;
            case 'DELETE':
                parse_str(file_get_contents('php://input'), $_DELETE);
                $this->request = (object) $_DELETE;
                break;
        }
    }

    public function get($name){
        if(isset($this->request->$name))
            return $this->request->$name;
        else
            return null;
    }
}