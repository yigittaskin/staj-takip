<?php
session_start();
include '../connect.php';

$sorgu=$db->prepare("select * from basvuru where ogrenci_no=:ogrenci_no");
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
                    <a href="/staj-takip/student/recourse.php" class="nav-link text-white ">
                        Staj Başvurusu
                    </a>
                </li>
                <li>
                <?php
                        echo "<a href='/staj-takip/student/fileUpload.php?ogrenci_no=".$_SESSION["kullanici_no"]."' class='nav-link text-white active' >
                        Staj Başvuru Belgeleri
                    </a>"
                    ?>
                </li>
                <li>
                <?php
                        echo "<a href='/staj-takip/student/stajDurum.php?ogrenci_no=".$_SESSION["kullanici_no"]."' class='nav-link text-white ' >
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

     
      <div class="col-md-9">
            <h3 class="text-center mt-5">Staj Başvuru Belgesi Yükleme</h3>
            <form class="m-5"  method="POST">
                <div class="row">
                <div class="form-group col-md-6">
                        <label class="text-dark" for="soyad">Öğrenci No:</label>
                        <input class="form-control" type="text" disabled name="ogrenci_no" id="ogrenci_no" value="<?php echo $satir['ogrenci_no']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="soyad">İsim:</label>
                        <input class="form-control" type="text" disabled name="isim" id="isim" value="<?php echo $satir['isim']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="soyisim">Soyisim:</label>
                        <input class="form-control" type="text" disabled name="soyisim" id="soyisim" value="<?php echo $satir['soyisim']; ?>"  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="file">Staj Başvuru Belgesi Drive Linki:</label>
                        <input class="form-control" type="text" name="file" id="file" placeholder="Dosya linkini girin.." value="<?php echo $satir['file']; ?>" required>
                    </div>
                    
                    
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-outline-success mt-5" name="dosya_gonder" >Dosya Yükle</button>
                    </div>
                </div>
              </form>
        </div>
</div>

<?php
        if (isset($_POST["dosya_gonder"])) {
            $dosya_gonder=$db->prepare("update basvuru set
            ogrenci_no=:ogrenci_no,
            isim=:isim,
            soyisim=:soyisim,
            file=:file  where ogrenci_no=:ogrenci_no
            ");

            $kontrol=$dosya_gonder->execute(array(
                "ogrenci_no"=>$_POST["ogrenci_no"],
                "file"=>$_POST["file"],
                "ogrenci_no"=>$_GET["ogrenci_no"]
            ));

            if ($kontrol) {
                header("location:/staj-takip/student/stajDurum.php");
               exit;
            }else{
                echo "hata";
            }
        }
        ?>

</body>
</html>