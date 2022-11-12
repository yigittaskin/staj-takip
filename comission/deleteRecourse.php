<?php

include '../connect.php';

//PREPARE: PDO içinde bulunan bir yapı ve içine parametre olarak SQL sorgusu yazılır.
$sil = $db->prepare("delete from basvuru where ogrenci_no=:ogrenci_no");
//Girilen sorguyu çalıştırıyoruz.
$kontrol=$sil->execute(array(
    "ogrenci_no"=>$_GET["ogrenci_no"]
));

if ($kontrol) {
    header("location:recourseList.php");
}else{
    echo "hata";
}



?>