<?php
class db{
    //ayarlar
    private $dbhost = 'localhost';
    private $dbuser = 'root';
    private $dbpass = '';
    private $dbname = 'servissistem';

    //Bağlan
public function connect(){
    $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
    $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
    $dbConnection->exec("set names utf8");
    

    //$dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTİON);
    
    
    return $dbConnection;
    }

}