<?php
require_once 'config/config.php';

class Db{

/*variables privads */

private $host;
private $db;
private $user;
private $pass;

/*variables publica */

public $connection;

public function __construct()
{
    $this ->host = constant('DB_HOST');
    $this ->db = constant('DB');
    $this ->user = constant('DB_USER');
    $this ->pass = constant('DB_PASS');

    try{
        $this->connection = new PDO('mysql:host=' .$this->host. ';dbname=' . $this->db,$this->user, $this->pass);
    }
    catch (PDOException $e){
echo $e->getMessage();
exit();

    }
}

}//fin de clase DB

?>