<?php

require_once 'dbconfig.php';

class  Crud
{

    private $db;

    private $dbhost = DBHOST;

    private $dbuser = DBUSER;

    private $dbpass = DBPASSWORD;

    private $dbname = DBNAME;

    function __construct()
    {

        try {

            $this->db = new PDO('mysql:host=' . $this->dbhost . '; dbname=' . $this->dbname . ';charset=utf8', $this->dbuser, $this->dbpass);

        } catch (Exception $e) {

            die("Bağlantı başarısız:" . $e->getMessage());
        }
    }
    public function adminsLogin($admins_username, $admins_pass,$remember_me)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM admins WHERE admins_username=? and admins_pass=?");
            
            if(isset($_COOKIE['adminsLogin'])) 
            {
                $stmt->execute([$admins_username, md5(openssl_decrypt($admins_pass,'AES-128-ECB',"admins_coz"))]);
            }
            else{
                $stmt->execute([$admins_username, md5($admins_pass)]);

            }

            if ($stmt->rowCount() == 1) {
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                // if ($row['admins_status']==0) {
                                // return ['status'=> false];
                                // exit;
                                // }

                $_SESSION['admins'] = [
                    "admins_username" => $admins_username,
                    "admins_name_surname" => $row['admins_name_surname'],
                    "admins_file" => $row['admins_file'],
                    "admins_id" => $row['admins_id']
                ];

                if (!empty($remember_me) AND empty($_COOKIE['adminsLogin'])) {

                    $admins = [

                        "admins_username" => $admins_username,

                        "admins_pass" => openssl_encrypt($admins_pass, "AES-128-ECB", "admins_coz")
                    ];

                    setcookie("adminsLogin", json_encode($admins), strtotime("+30 day"), "/");

                } else if(empty($remember_me)){

                    setcookie("adminsLogin", json_encode($this->admins), strtotime("-30 day"), "/");
                }

                return ['status' => true];
            } else {

                return ['status' => false];
            }
        } catch (Exception $e) {

            return ['status' => false, 'error' => $e->getMessage()];
        }
    }
        function Read($table){

            try{
            
            $stmt=$this->db->prepare("SELECT * FROM $table");
                $stmt->execute();
                return $stmt;
            }
            catch(Exception $e){
                echo $e->getMessage();
                return false;

            }


        }
}
