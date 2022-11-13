<?php
session_start();
include '../connect.php';

$sorgu=$db->prepare("select * from users where role='öğretmen' ");
$sorgu->execute();

$sorgu2=$db->prepare("select * from basvuru  where ogrenci_no=:ogrenci_no ");
$sorgu2->execute(array(
    "ogrenci_no"=>$_GET["ogrenci_no"]

));
$satir=$sorgu2->fetch(PDO::FETCH_ASSOC);
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
                    <a href="/staj-takip/administrator/recourseList.php" class="nav-link text-white active">
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


     
      <div class="col-md-10">
            <h3 class="text-center mt-5">Değerlendirecek Öğretmen Seçme</h3>
            <form class="m-5"  method="POST">
                <div class="row">

                    <div class="form-group col-md-6 mt-3">
                        <label for="sinif">Atanacak Öğretmen:</label>

                        <?php
                         while($satir=$sorgu->fetch(PDO::FETCH_ASSOC)){
                            echo "<br>";
                            echo "<input type='radio' name='atanan_hoca' value=".$satir['kullanici_no'].">".$satir['isim']." ".$satir["soyisim"]."<br>";
                        }
                        ?>

                      </div>

                      <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-outline-success mt-5" name="hoca_ata" >Öğretmeni Ata</button>
                    </div>
                    
                </div>
              </form>
        </div>
</div>
<?php
        if (isset($_POST["hoca_ata"])) {
            $hoca_ata=$db->prepare("update basvuru set
            atanan_hoca=:atanan_hoca
              where ogrenci_no=:ogrenci_no
            ");

            $kontrol=$hoca_ata->execute(array(
                "atanan_hoca"=>$_POST["atanan_hoca"],
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