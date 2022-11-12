<?php

session_start();

include '../connect.php';
$ogrenci = $_SESSION["kullanici_no"];
//PREPARE: PDO içinde bulunan bir yapı ve içine parametre olarak SQL sorgusu yazılır.
    $sorgu = $db->query("SELECT * FROM basvuru where ogrenci_no='{$ogrenci}'");
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
    <link rel="stylesheet" href="./style/recourse.css">
    <title>KOU STAJ TAKİP</title>
</head>
<body>

<div class="row">
       <!-- MENU -->

       <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-yesil col-md-3 menu">
            <div class="mb-3 m-1 mb-md-0 me-md-auto text-white text-decoration-none border p-2">
                <span class="fs-4 text-center">Hoşgeldin <?php
                echo $_SESSION["isim"];
                ?></span>
            </div>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="/staj-takip/student/recourse.php" class="nav-link text-white">
                        Staj Başvurusu
                    </a>
                </li>
                <li>
                <?php
                        echo "<a href='/staj-takip/student/fileUpload.php?ogrenci_no=".$_SESSION["kullanici_no"]."' class='nav-link text-white ' >
                        Staj Başvuru Belgeleri
                    </a>"
                    ?>
                </li>
                <li>
                <?php
                        echo "<a href='/staj-takip/student/stajDurum.php?ogrenci_no=".$_SESSION["kullanici_no"]."' class='nav-link text-white active' >
                        Staj Durum
                    </a>"
                    ?>
                </li>
                <li>
                <?php
                        echo "<a href='/staj-takip/student/stajDefterUpload.php?ogrenci_no=".$_SESSION["kullanici_no"]."' class='nav-link text-white ' >
                        Staj Defteri ve Diğer Belgeler
                    </a>"
                    ?>
                </li>
                </li>
                <li>
                <a href="/staj-takip/Login/logout.php" class="nav-link text-white">
                        Çıkış
                    </a>
                </li>
            </ul>
        </div>

        <!-- MENU END -->
        <div class="col-md-9 mt-5 px-5">
        <div class="container px-3 py-2" style=' border:2px solid #27A659 !important;'>
            <h5 class='text-center' style='color: #27A659;'>Staj Adımları</h5>
            <p class='text-center'>Öğrencinin stajı onaylandıysa <strong>Staj Defteri ve Diğer Belgeler</strong> sayfasına girip staj defterini ve diğer dosyalarını atmış olduğu Google Drive linki sisteme girilecektir. Staj onaylanmadıysa eğer red nedeniyle birlikte komisyon öğretmene eposta atılacak olup tekrar başvuru yapılmalıdır.</p>
        </div>
            <table class="table table-striped table-responsive table-hover mt-5">
                   <thead class="thead-dark">
                        <tr>
                           <th scope="col" class="text-center">Öğrenci No</th>
                           <th scope="col" class="text-center">İsim</th>
                           <th scope="col" class="text-center">Soyisim</th>
                           <th scope="col" class="text-center">Staj Onaylanma Durumu</th>
                           <th scope="col" class="text-center">Atanan Öğretmen</th>
                           <th scope="col" class="text-center">Başarı Durumu</th>
                           <th scope="col" class="text-center">Mesaj</th>
                       </tr>
            </thead>
            <tbody style="border: 1px solid black;">

            <?php
            while($satir=$sorgu->fetch(PDO::FETCH_ASSOC)){

                $ogretmen = $satir['atanan_hoca'];
                $sorgu3 = $db->query("SELECT * FROM users where kullanici_no='{$ogretmen}'");
                $sorgu3->execute();

                if ($satir["atanan_hoca"] == "") {
                    $hocaVarStyle = "background-color:red;";
                    $hocaVar = "Öğretmen Atanmadı.";
                }
                else {
                    $hocaVarStyle = "background-color:green;";
                    $hocaVar = $satir["atanan_hoca"];
                }



                if ($satir["staj_durum"] == "Staj Reddedildi") {
                    $stajOnayStyle = "background-color:red;";
                    $stajOnay = "Staj Reddedildi.";
                }
                elseif ($satir["staj_durum"] == "") {
                    $stajOnayStyle = "background-color:#FFC107;";
                    $stajOnay = "Staj Henüz Değerlendirilmedi.";
                }
                else {
                    $stajOnayStyle = "background-color:green;";
                    $stajOnay = "Staj Onaylandı.";
                }

                if ($satir["staj_not"] == "Staj Reddedildi") {
                    $stajOnayStyle = "background-color:red;";
                    $stajNotText = $satir["staj_not"];
                }
                elseif ($satir["staj_not"] == "") {
                    $stajNot = "background-color:#FFC107;";
                    $stajNotText = "Henüz Başarı Durumu Girilmedi.";
                }
                else {
                    $stajNot = "background-color:green;";
                    $stajNotText = $satir["staj_not"];
                }

                echo "<tr>";
                echo "<td>".$satir["ogrenci_no"]."</td>";
                echo "<td>".$satir["isim"]."</td>";
                echo "<td>".$satir["soyisim"]."</td>";
                //echo "<td>".$satir["fakulte_adi"]."</td>";
                echo "<td style='".$stajOnayStyle."color:white;'>".$stajOnay."</td>";
                //echo "<td>".$hocaVar."</td>";
                while($satir2=$sorgu3->fetch(PDO::FETCH_ASSOC)){
                    echo "<td style='".$hocaVarStyle."color:white;'>".$satir2['isim']." ".$satir2['soyisim']."</td>";
                }
                echo "<td style='".$stajNot." color:white;'>".$stajNotText."</td>";
                echo "<td>".$satir["red_neden"]."</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
            </table>
            </div>
</div>

</body>
</html>