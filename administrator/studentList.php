<?php

session_start();

include '../connect.php';

//PREPARE: PDO içinde bulunan bir yapı ve içine parametre olarak SQL sorgusu yazılır.
    $sorgu = $db->query("select * from users where role='öğrenci'");
//Girilen sorguyu çalıştırıyoruz.
    $sorgu->execute();
    if ($_SESSION['kullanici_no']=="") {
        header('location:/staj-takip/Login/index.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/admin.css">
    <title>KOU STAJ TAKİP</title>
</head>
<body>

<div class="row">
       <!-- MENU -->

       <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-yesil col-md-2 menu">
       <div class="mb-3 m-1 mb-md-0 me-md-auto text-white text-decoration-none border p-2">
                <span class="fs-4 text-center">Hoşgeldin <?php
                echo $_SESSION["isim"];
                ?></span>
            </div>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link disabled text-white" aria-current="page">
                        Admin Paneli
                    </a>
                </li>
                <li>
                    <a href="/staj-takip/administrator/importUser.php" class="nav-link text-white">
                        Toplu Kullanıcı Ekle
                    </a>
                </li>
                <li>
                    <a href="/staj-takip/administrator/addUser.php" class="nav-link text-white">
                        Bireysel Kullanıcı Ekle
                    </a>
                </li>
                <li>
                    <a href="/staj-takip/administrator/studentList.php" class="nav-link text-white active">
                    Öğrenci Listesi
                    </a>
                </li>
                <li>
                    <a href="/staj-takip/administrator/teacherList.php" class="nav-link text-white">
                        Öğretmen Listesi
                    </a>
                </li>
                <li>
                    <a href="/staj-takip/administrator/recourseList.php" class="nav-link text-white">
                        Başvuruları Görüntüle
                    </a>
                </li>
                <li>
                    <a href="/staj-takip/administrator/studentInformation.php" class="nav-link text-white">
                        Başvuruları Değerlendir
                    </a>
                </li>
                </li>
                    <a href="/staj-takip/Login/logout.php" class="nav-link text-w">
                        Çıkış
                    </a>
                </li>
            </ul>
        </div>

        <!-- MENU END -->

            <div class="col-md-9">
            <table class="table table-striped table-responsive table-hover mt-5" style="border: 1px solid black;">
                   <thead class="thead-dark">
                        <tr>
                           <th scope="col">Öğrenci No</th>
                           <th scope="col">İsim</th>
                           <th scope="col">Soyisim</th>
                           <th scope="col">Eposta </th>
                           <th scope="col">Telefon Numarası</th>
                           <th scope="col">Sınıf</th>
                           <th scope="col">Bölüm</th>
                           <th scope="col">Fakülte</th>
                           <th scope="col"></th>
                           <th scope="col"></th>
                       </tr>
            </thead>
            <tbody>

            <?php
            while($satir=$sorgu->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>".$satir["kullanici_no"]."</td>";
                echo "<td>".$satir["isim"]."</td>";
                echo "<td>".$satir["soyisim"]."</td>";
                echo "<td>".$satir["eposta"]."</td>";
                echo "<td>".$satir["tel"]."</td>";
                echo "<td>".$satir["sinif"]."</td>";
                echo "<td>".$satir["bolum"]."</td>";
                echo "<td>".$satir["fakulte_adi"]."</td>";
                echo "<td><a class='btn btn-warning' role='button' href='updateStudent.php?kullanici_no=$satir[kullanici_no]'>Güncelle</a></td>";
                echo "<td><a class='btn btn-danger' role='button' href='deleteStudent.php?kullanici_no=$satir[kullanici_no]'>Sil</a></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
            </table>
            </div>
</div>

</body>
</html>