<?php 

require_once 'connect/classCrud.php';
$db=new Crud();


if (!isset($_SESSION['admins']) && isset($_COOKIE['adminsLogin'])) {

    $adminsLogin=json_decode($_COOKIE['adminsLogin']);

    $sonuc=$db->adminsLogin($adminsLogin->admins_username,$adminsLogin->admins_pass,true);

    if ($sonuc['status']) {
         
        header("Location:index.php");
        exit;
    }
}
    else {

}

if(!isset($_SESSION['admins']) && !isset($_COOKIE['adminsLogin'])){

    header('Location:login.php');
    exit;
}
?>