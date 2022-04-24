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
    public function adminsLogin($admins_username,$admins_pass){
    try{
        $stmt=$this->db->prepare("SELECT * FROM admins WHERE admins_username=? and admins_pass=?");
        $stmt->execute([$admins_username,md5($admins_pass)]);

        if ($stmt->rowCount()==1) {
            
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['admins']=[
                "admins_username"=> $admins_username,
                "admins_name_surname"=>$row['admins_name_surname'],
                "admins_file"=>$row['admins_file'],
                "admins_id"=>$row['admins_id']
            ];

            if (!empty($remember_me)) {

                $admins=[
                    "admins_username"=> $admins_username,

                    "admins_pass"=> openssl_encrypt($admins_pass,"AES-128-ECB", "admins_coz")

                ];
                setcookie("adminsLogin",json_encode($admins),strtotime("+30 day"),"/");
            }
            else{
                setcookie("adminsLogin",json_encode($admins),strtotime("+30 day"),"/");
            }

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
