<?php

include '../connect.php';

//PREPARE: PDO içinde bulunan bir yapı ve içine parametre olarak SQL sorgusu yazılır.
$sil = $db->prepare("delete from users where id=:id");
//Girilen sorguyu çalıştırıyoruz.
$kontrol=$sil->execute(array(
    "id"=>$_GET["id"]
));

if ($kontrol) {
    header("location:studentList.php");
}else{
    echo "hata";
}



?>