<?php

include '../connect.php';

//PREPARE: PDO içinde bulunan bir yapı ve içine parametre olarak SQL sorgusu yazılır.
$sil = $db->prepare("delete from users where kullanici_no=:kullanici_no");
//Girilen sorguyu çalıştırıyoruz.
$kontrol=$sil->execute(array(
    "kullanici_no"=>$_GET["kullanici_no"]
));

if ($kontrol) {
    header("location:teacherList.php");
}else{
    echo "hata";
}



?>