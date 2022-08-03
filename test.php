<?php 
$_POST=[
    "ad"=> "Özcan",
    "soyad"=> "Öner",
    "kurs" => "Yapay Zeka",
    "fiyat"=> 50 
];
function islem($deger){

    return($deger."=?,");//veriden gelenleri sonuna =? ekler.

}
echo "<pre>";
$sonuc=array_map("islem",$_POST);
print_r($sonuc);
print_r(array_keys($_POST)); //veriden gelenleri index ve tanımlarıyla getirir.








?>
