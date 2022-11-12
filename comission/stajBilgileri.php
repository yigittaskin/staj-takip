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

        <!-- MENU END -->

     
      <div class="col-md-10">
            <h3 class="text-center mt-5">Staj Bilgileri</h3>
            <form class="m-5"  method="POST">
                <div class="row">
                <div class="form-group col-md-6 mt-3">
                        <label for="stajturu">Staj Türü:</label>
                        <input disabled class="form-control" type="text" name="staj_tur" id="staj_tur" value="<?php echo $satir['staj_tur']; ?>">
                      </div>
                      <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="gunsayisi">Staj gün sayısı:</label>
                        <input class="form-control" type="text" name="is_gunu" id="is_gunu" value="<?php echo $satir['is_gunu']; ?>">
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="baslangicgunu" >Staj başlangıç tarihi:</label>
                        <input class="form-control" type="date" name="baslangic_gunu" min="2002-09-09" id="baslangic_gunu" value="<?php echo $satir['baslangic_gunu']; ?>">
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label class="text-dark" for="bitisgunu">Staj bitiş tarihi:</label>
                        <input class="form-control" type="date" name="bitis_gunu" min="2002-09-09" id="bitis_gunu" value="<?php echo $satir['bitis_gunu']; ?>" >
                    </div>
                    
                </div>
              </form>
        </div>
</div>

<?php
        if (isset($_POST["staj_bilgi"])) {
            $staj_bilgi=$db->prepare("update basvuru set
            staj_tur=:staj_tur,
            is_gunu=:is_gunu,
            baslangic_gunu=:baslangic_gunu,
            bitis_gunu=:bitis_gunu  where ogrenci_no=:ogrenci_no
            ");

            $kontrol=$staj_bilgi->execute(array(
                "staj_tur"=>$_POST["staj_tur"],
                "is_gunu"=>$_POST["is_gunu"],
                "baslangic_gunu"=>$_POST["baslangic_gunu"],
                "bitis_gunu"=>$_POST["bitis_gunu"],
                "ogrenci_no"=>$_GET["ogrenci_no"]
            ));

            if ($kontrol) {
                header("location:/staj-takip/comission/recourseList.php");
      exit;
            }else{
                echo "hata";
            }
        }
        ?>



</body>
</html>