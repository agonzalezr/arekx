<?php namespace Arekx;

class File {

    private $file;
    private $filename;
    private $file_ext;
    private $file_path;

    public function __construct($filename)
    {
        (isset($_FILES[$filename]))? $this->file = $_FILES[$filename] : $this->file = null;

        if($this->file!=null)
        {
            $this->filename = $this->file['name'];
            $this->file_ext = pathinfo($this->filename,PATHINFO_EXTENSION);
            $this->file_path = "uploads/" . date("YmdHis") . "_" . md5($this->filename) . "." . $this->file_ext;
            if(!move_uploaded_file($this->file['tmp_name'], DOCUMENT_ROOT."/" . $this->file_path )){
                Render::json([
                    "type" => "error",
                    "message" => "No tienes permisos de escritura."
                ]);
                exit;
            }
        }else{
            Render::json([
                "type" => "error",
                "message" => "No se pudo subir tu archivo al servidor."
            ]);
            exit;
        }
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return mixed
     */
    public function getFileExt()
    {
        return $this->file_ext;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->file_path;
    }

}