<?php
session_start();
include '../connect.php';

$sorgu=$db->prepare("select * from basvuru  where ogrenci_no=:ogrenci_no ");
$sorgu->execute(array(
    "ogrenci_no"=>$_GET["ogrenci_no"]

));
$satir=$sorgu->fetch(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="./style/teacher.css">
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
                    <a href="/staj-takip/administrator/studentList.php" class="nav-link text-white ">
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
                    <a href="/staj-takip/administrator/studentInformation.php" class="nav-link text-white active">
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


      <!-- Öğrenci Bilgi -->

     
      <div class="col-md-10">
            <h3 class="text-center mt-5">Staj Değerlendirme</h3>
            <form class="m-5"  method="POST">
                <div class="row">
                <div class="form-group col-md-12 mt-5" >
                        <label class="text-dark">Staj Defteri ve Diğer Belgeler:</label>
                        <div  class="form-group p-2 " style="background-color:#E8F0FE; border-radius:24px;">
                        <a href="<?php echo $satir['staj_defter']; ?>" target="_blank"> <?php echo $satir['staj_defter']; ?> </a>
                        </div>
                    </div>
                    <div class="form-group col-md-6 mt-5" >
                        <label class="text-dark">Staj Durumu:</label><br>
                        <input disabled class="text-center p-2 text-dark" value="<?php echo $satir['staj_durum']; ?>">
                    </div>
                    <div class="form-group col-md-12 mt-3">
                        <label for="staj_durum">Stajı Değerlendir:</label><br>
                        <input class="mr-2" type="radio" name="staj_not" value="Başarılı">Başarılı<br>
                        <input class="mr-2" type="radio" name="staj_not" value="Başarısız">Başarısız
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-outline-success mt-5" name="staj_not_durum" >Değerlendirmeyi Tamamla</button>
                    </div>
                </div>
              </form>
        </div>

        <!-- Öğrenci Bilgi END -->
</div>



<?php

        if (isset($_POST["staj_not_durum"])) {
            $staj_not_durum=$db->prepare("update basvuru set
            staj_not=:staj_not,
            staj_defter=:staj_defter
            where ogrenci_no=:ogrenci_no
            ");

            $kontrol=$staj_not_durum->execute(array(
                "staj_not"=>$_POST["staj_not"],
                "staj_defter"=>$_POST["staj_defter"],
                "ogrenci_no"=>$_GET["ogrenci_no"]
            ));

            if ($kontrol) {
               header("location:/staj-takip/teacher/studentInformation.php");
      exit;
            }else{
                echo "hata";
            }
        }
        ?>


</body>
</html>