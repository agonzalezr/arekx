<?php namespace Models;

class Database {

    private static $db = null;
    private static $pdo;
    private $DbServer;
    private $DbUser;
    private $DbPass;
    private $DbName;

    final private function __construct()
    {
        try {

            $data = simplexml_load_file(DOCUMENT_ROOT.'Config.xml');
            $this->DbServer =  $data->Server;
            $this->DbUser = $data->Username;
            $this->DbPass = $data->Password;
            $this->DbName = $data->Database;
            self::getDB();

        } catch (\PDOException $e) {

            echo $e->getMessage();
        }

    }

    public static function getInstance()
    {
        if (self::$db === null)
            self::$db = new self();

        return self::$db;
    }

    public function getDB()
    {
        if (self::$pdo == null) {
            self::$pdo = new \PDO('mysql:dbname='.$this->DbName.';host='.$this->DbServer.";", $this->DbUser, $this->DbPass, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }


    private function __clone(){}

    function __destruct()
    {
        self::$pdo = null;
    }


    public static function insert($query, $vars){
        $sth = Database::getInstance()->getDB()->prepare($query);
        return ($sth->execute($vars)) ? true : false;

    }

    public static function delete($query, $vars){
        $sth = Database::getInstance()->getDB()->prepare($query);
        return ($sth->execute($vars) && $sth->rowCount()>0) ? true : false;
    }

    public static function fetchQuery($query, $vars)
    {
        $sth = Database::getInstance()->getDB()->prepare($query);
        return ($sth->execute($vars) && $sth->rowCount()>0) ? $sth->fetch(\PDO::FETCH_ASSOC) : false;
    }

    public static function fetchAllQuery($query, $vars)
    {
        $sth = Database::getInstance()->getDB()->prepare($query);
        return ($sth->execute($vars) && $sth->rowCount()>0) ? $sth->fetchAll(\PDO::FETCH_ASSOC) : false;
    }

    public static function returnId($query, $vars){
        $db = Database::getInstance()->getDB();
        $sth = $db->prepare($query);
        return ($sth->execute($vars)) ? $db->lastInsertId() : false;
    }

    public static function getRowCount($query, $vars)
    {
        $data = null;
        $sth = Database::getInstance()->getDB()->prepare($query);
        if($sth->execute($vars))
            $data = $sth->rowCount();
        unset($sth);
        return $data;
    }

    public static function update($tabla, $setters, $arr_setters, $condition, $arr_condition) {

        $query = "UPDATE $tabla SET";

        foreach ($setters as $value) {
            $query .= " $value=?,";

        }

        $query = substr($query, 0, -1);
        $query .=" WHERE ";

        foreach ($condition as $value) {
            $query .= " $value=? AND";
        }

        $query = substr($query, 0, -4);
        $values = array_merge($arr_setters, $arr_condition);

        $sth = Database::getInstance()->getDB()->prepare($query);

        return ($sth->execute($values)) ? true : false;

    }

}
