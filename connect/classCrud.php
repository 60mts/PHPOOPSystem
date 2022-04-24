<?php
    session_start();
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
    public function adminLogin($admins_username,$admins_pass){
    try{
        $stmt=$this->db->prepare("SELECT * FROM admins WHERE username=? and admins_pass=?");
        $stmt->execute([$admins_username,md5($admins_pass)]);

        if ($stmt->rowCount()==1) {
            
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['admins']=[
                "admins_username"=> $admins_username,
                "admins_username_surname"=>$row['admins_username_surname'],
                "admins_file"=>$row['admins_file'],
                "admins_id"=>$row['admins_id']
            ];
            return ['status'=> true];
            
        }
        else{

            return['status'=> false];
        }

    } catch(Exception $e){

        return ['status'=> false, 'error'=> $e->getMessage()];


    }


}

}
