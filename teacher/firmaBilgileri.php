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

       <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-yesil col-md-3 menu">
       <div class="mb-3 m-1 mb-md-0 me-md-auto text-white text-decoration-none border p-2">
                <span class="fs-4 text-center">Hoşgeldin <?php
                echo $_SESSION["isim"];
                ?></span>
            </div>
            <hr>
            <!-- ÇİZGİ EKLENCEK -->
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="/staj-takip/teacher/studentInformation.php" class="nav-link text-white active">
                        Öğrenci Listesi
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
            <h3 class="text-center mt-5">Firma Bilgileri</h3>
            <form class="m-5"  method="POST">
                <div class="row">
                      <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="gunsayisi">Firma Adı:</label>
                        <input class="form-control" disabled type="text" name="firma_adi" id="firma_adi" value="<?php echo $satir['firma_adi']; ?>">
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="baslangicgunu" >Faaliyet Alanı:</label>
                        <input class="form-control" disabled type="text" name="faal_alan" id="faal_alan" value="<?php echo $satir['faal_alan']; ?>">
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">Firma Tel:</label>
                        <input class="form-control" disabled type="number" name="firma_tel"  id="firma_tel" value="<?php echo $satir['firma_tel']; ?>" >
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">Firma E-posta:</label>
                        <input class="form-control" disabled type="email" name="firma_eposta"  id="firma_eposta" value="<?php echo $satir['firma_eposta']; ?>" >
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">Firma İl:</label>
                        <input class="form-control" disabled type="text" name="firma_il"  id="firma_il" value="<?php echo $satir['firma_il']; ?>" >
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">Firma İlçe:</label>
                        <input class="form-control" disabled type="text" name="firma_ilce"  id="firma_ilce" value="<?php echo $satir['firma_ilce']; ?>" >
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">Firma Açık Adres:</label>
                        <input class="form-control" disabled type="text" name="firma_acik_adres"  id="firma_acik_adres" value="<?php echo $satir['firma_acik_adres']; ?>" >
                    </div>
                </div>
              </form>
        </div>
</div>

<?php
        if (isset($_POST["firma_bilgi"])) {
            $firma_bilgi=$db->prepare("update basvuru set
               firma_adi=:firma_adi,
               faal_alan=:faal_alan,
               firma_tel=:firma_tel,
               firma_eposta=:firma_eposta,
               firma_il=:firma_il,
               firma_ilce=:firma_ilce,
               firma_acik_adres=:firma_acik_adres  where ogrenci_no=:ogrenci_no
            ");

            $kontrol=$firma_bilgi->execute(array(
                "firma_adi"=>$_POST["firma_adi"],
                "faal_alan"=>$_POST["faal_alan"],
                "firma_tel"=>$_POST["firma_tel"],
                "firma_eposta"=>$_POST["firma_eposta"],
                "firma_il"=>$_POST["firma_il"],
                "firma_ilce"=>$_POST["firma_ilce"],
                "firma_acik_adres"=>$_POST["firma_acik_adres"],
                "ogrenci_no"=>$_GET["ogrenci_no"]
            ));

            if ($kontrol) {
               //header("location:addStudent.php");
                exit;
            }else{
                echo "hata";
            }
        }
        ?>



</body>
</html>