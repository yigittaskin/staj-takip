<?php

session_start();

include '../connect.php';

//PREPARE: PDO içinde bulunan bir yapı ve içine parametre olarak SQL sorgusu yazılır.
    $sorgu = $db->query("SELECT * FROM basvuru");
//Girilen sorguyu çalıştırıyoruz.
    $sorgu->execute();


    if ($_SESSION['kullanici_no']=="") {
        header('location:/staj-takip/Login/index.php');
    }
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
    <link rel="stylesheet" href="./style/comission.css">
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
                <li>
                    <a href="/staj-takip/comission/recourseList.php" class="nav-link text-white active ">
                        Başvuru Yapan Öğrenci Listesi
                    </a>
                </li>
                <li>
                    <a href="/staj-takip/Login/logout.php" class="nav-link text-w">
                        Çıkış
                    </a>
                </li>
            </ul>
        </div>
            <div class="col-md-10 container-fluid">
            <table class="table table-striped table-responsive table-hover mt-5" style="border: 1px solid black;">
                   <thead class="thead-dark">
                        <tr>
                           <th scope="col" class="text-center">Öğrenci No</th>
                           <th scope="col" class="text-center">İsim</th>
                           <th scope="col" class="text-center">Soyisim</th>
                           <th scope="col" class="text-center">Bölüm</th>
                           <th scope="col" class="text-center">Sınıf</th>
                           <th scope="col" class="text-center">Staj Not</th>
                           <!-- <th scope="col">Fakülte</th> -->
                           <th scope="col" class="text-center">Staj Durumu</th>
                           <!-- <th scope="col"></th> -->
                           <th scope="col" class="text-center">Atanan Öğretmen</th>
                           <th scope="col" colspan='6' class="text-center">İşlemler</th>
                       </tr>
            </thead>
            <tbody>

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

                echo "<tr>";
                echo "<td>".$satir["ogrenci_no"]."</td>";
                echo "<td>".$satir["isim"]."</td>";
                echo "<td>".$satir["soyisim"]."</td>";
                echo "<td>".$satir["bolum"]."</td>";
                echo "<td>".$satir["sinif"]."</td>";
                echo "<td>".$satir["staj_not"]."</td>";
                //echo "<td>".$satir["fakulte_adi"]."</td>";
                echo "<td style='".$stajOnayStyle." color:white;'>".$stajOnay."</td>";
                //echo "<td>".$hocaVar."</td>";
                while($satir2=$sorgu3->fetch(PDO::FETCH_ASSOC)){
                    echo "<td style='".$hocaVarStyle."color:white;'>".$satir2['isim']." ".$satir2['soyisim']."</td>";
                }
                echo "<td><a class='btn btn-info' role='button' href='stajBilgileri.php?ogrenci_no=$satir[ogrenci_no]'>Staj Bilgilerini Gör</a></td>";
                echo "<td><a class='btn btn-info' role='button' href='firmaBilgileri.php?ogrenci_no=$satir[ogrenci_no]'>Firma Bilgilerini Gör</a></td>";
                echo "<td class='text-center'><a class='btn btn-info' role='button' href='stajOnay.php?ogrenci_no=$satir[ogrenci_no]'>Staj Onayla/Reddet</a><a class='btn btn-info mt-2' role='button' href='degerlendirecekHoca.php?ogrenci_no=$satir[ogrenci_no]'>Öğretmen Ata</a></td>";
                echo "<td><a class='btn btn-warning' role='button' href='basariDurumu.php?ogrenci_no=$satir[ogrenci_no]'>Başarı Durumu Gir</a></td>";
                echo "<td><a class='btn btn-danger' id='basvuruSil' role='button' href='deleteRecourse.php?ogrenci_no=$satir[ogrenci_no]'>Başvuruyu Sil</a></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
            </table>
            </div>
</div>
</body>
</html>

