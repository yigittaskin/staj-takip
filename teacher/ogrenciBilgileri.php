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
            <h3 class="text-center mt-5">Öğrenci Bilgileri</h3>
            <form class="m-5"  method="POST">
                <div class="row">
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">Öğrenci Numarası:</label>
                        <input class="form-control" disabled type="text" name="ogrenci_no"  id="ogrenci_no" value="<?php echo $satir['ogrenci_no']; ?>" >
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="gunsayisi">Adı:</label>
                        <input class="form-control" disabled type="text" name="isim" id="isim" value="<?php echo $satir['isim']; ?>">
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="baslangicgunu" >Soyadı:</label>
                        <input class="form-control" disabled type="text" name="soyisim" id="soyisim" value="<?php echo $satir['soyisim']; ?>">
                        </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">Doğum Tarihi:</label>
                        <input class="form-control" disabled type="date" name="dogum_tarihi"  id="dogum_tarihi" value="<?php echo $satir['dogum_tarihi']; ?>" >
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">E-Posta:</label>
                        <input class="form-control" disabled type="text" name="eposta"  id="eposta" value="<?php echo $satir['eposta']; ?>" >
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">Telefon Numarası:</label>
                        <input class="form-control" disabled type="text" name="tel"  id="tel" value="<?php echo $satir['tel']; ?>" >
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">Sınıf:</label>
                        <input class="form-control" disabled type="text" name="sinif"  id="sinif" value="<?php echo $satir['sinif']; ?>" >
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">Bölüm:</label>
                        <input class="form-control" disabled type="text" name="bolum"  id="bolum" value="<?php echo $satir['bolum']; ?>" >
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">İl:</label>
                        <input class="form-control" disabled type="text" name="ogr_il"  id="ogr_il" value="<?php echo $satir['ogr_il']; ?>" >
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">İlçe:</label>
                        <input class="form-control" disabled type="text" name="ogr_ilce"  id="ogr_ilce" value="<?php echo $satir['ogr_ilce']; ?>" >
                    </div>
                </div>
              </form>
        </div>
</div>

<?php
        if (isset($_POST["firma_bilgi"])) {
            $firma_bilgi=$db->prepare("update basvuru set
               ogrenci_no=:ogrenci_no,
               isim=:isim,
               soyisim=:soyisim,
               sinif=:sinif,
               bolum=:bolum,
               dogum_tarihi=:dogum_tarihi,
               ogr_il=:ogr_il,
               ogr_ilce=:ogr_ilce,
               eposta=:eposta,
               tel=:tel  where ogrenci_no=:ogrenci_no
            ");

            $kontrol=$firma_bilgi->execute(array(
                "ogrenci_no"=>$_POST["ogrenci_no"],
                "isim"=>$_POST["isim"],
                "soyisim"=>$_POST["soyisim"],
                "sinif"=>$_POST["sinif"],
                "bolum"=>$_POST["bolum"],
                "dogum_tarihi"=>$_POST["dogum_tarihi"],
                "ogr_il"=>$_POST["ogr_il"],
                "ogr_ilce"=>$_POST["ogr_ilce"],
                "eposta"=>$_POST["eposta"],
                "tel"=>$_POST["tel"],
                "ogrenci_no"=>$_GET["ogrenci_no"]
            ));

            if ($kontrol) {
                exit;
            }else{
                echo "hata";
            }
        }
        ?>



</body>
</html>