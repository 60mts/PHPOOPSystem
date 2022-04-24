<?php

    require_once 'dbconfig.php';

Class  Crud {

    private $db;

    private $dbhost=DBHOST;

    private $dbuser=DBUSER;

    private $dbpass=DBPASSWORD;
    
    private $dbname=DBNAME;

    function __construct() {
      
        try {

            $this->db=new PDO('mysql:host='.$this->dbhost.'; dbname='.$this->dbname.';charset=utf8',$this->dbuser,$this->dbpass);

            echo "bağlantı başarılı";

        } catch (Exception $e)  {

           die("Bağlantı başarısız:".$e->getMessage());

        }

}

}
