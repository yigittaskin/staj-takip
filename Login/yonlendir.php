<?php

session_start();

include '../connect.php';
$roleKullanici = $_SESSION['kullanici_no'];
       $sorgu2 = $db->query("select * from users where kullanici_no='{$roleKullanici}'");
       //Girilen sorguyu çalıştırıyoruz.
       $sorgu2->execute();

       while($satir=$sorgu2->fetch(PDO::FETCH_ASSOC)){
//giriş doğru
              if ($satir["role"]=='admin') {
              header('location:/staj-takip/administrator/addUser.php');
              $_SESSION['isim'] = $satir['isim'];
              }
              elseif ($satir["role"]=='öğrenci') {
              header('location:/staj-takip/student/recourse.php');
              $_SESSION['isim'] = $satir['isim'];
              }
              elseif ($satir["role"]=='öğretmen') {
              header('location:/staj-takip/teacher/studentInformation.php');
              $_SESSION['isim'] = $satir['isim'];
              }
              elseif ($satir["role"]=='komisyon') {
              header('location:/staj-takip/comission/recourseList.php');
              $_SESSION['isim'] = $satir['isim'];
              }
              }

?>