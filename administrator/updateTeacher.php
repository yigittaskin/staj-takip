<?php
session_start();
include '../connect.php';

$sorgu=$db->prepare("select * from users  where id=:id");
$sorgu->execute(array(
    "id"=>$_GET["id"]
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
                    <a href="/staj-takip/administrator/addUser.php" class="nav-link text-white ">
                        Kullanıcı Ekle
                    </a>
                </li>
                <li>
                    <a href="/staj-takip/administrator/studentList.php" class="nav-link text-white ">
                    Öğrenci Listesi
                    </a>
                </li>
                <li>
                    <a href="/staj-takip/administrator/teacherList.php" class="nav-link text-white active">
                        Öğretmen Listesi
                    </a>
                </li>
                <li>
                    <a href="/staj-takip/administrator/recourseList.php" class="nav-link text-white ">
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
            <h3 class="text-center mt-5">Öğretmen Güncelleme</h3>
            <form class="m-5"  method="POST">
                <div class="row">
                <div class="form-group col-md-6">
                        <label class="text-dark" for="soyad">Öğretmen No:</label>
                        <input class="form-control" type="text" name="kullanici_no" id="kullanici_no" value="<?php echo $satir['kullanici_no']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="soyad">İsim:</label>
                        <input class="form-control" type="text" name="isim" id="isim" value="<?php echo $satir['isim']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="soyisim">Soyisim:</label>
                        <input class="form-control" type="text" name="soyisim" id="soyisim" value="<?php echo $satir['soyisim']; ?>"  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="soyisim">E-Posta:</label>
                        <input class="form-control" type="text" name="eposta" id="eposta" value="<?php echo $satir['eposta']; ?>"  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="soyisim">Telefon Numarası:</label>
                        <input class="form-control" type="text" name="tel" id="tel" value="<?php echo $satir['tel']; ?>"  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="bolum">Bölüm:</label>
                        <input class="form-control" type="text" name="bolum" id="bolum" value="<?php echo $satir['bolum']; ?>"  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="fakulte_adi">Fakülte:</label>
                        <input class="form-control" type="text" name="fakulte_adi" id="fakulte_adi" value="<?php echo $satir['fakulte_adi']; ?>"  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sinif">Role:</label>
                        <select id="sinif" name="role" class="form-control" value="<?php echo $satir['role']; ?>" required>
                          <option value="öğretmen">öğretmen</option>
                          <option value="komisyon">komisyon</option>
                          <option value="öğrenci">öğrenci</option>
                        </select>
                      </div>
                    
                    
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-outline-success mt-5" name="ogretmen_guncelle" >Öğretmen Güncelle</button>
                    </div>
                </div>
              </form>
        </div>
</div>

<?php
        if (isset($_POST["ogretmen_guncelle"])) {
            $ogretmen_guncelle=$db->prepare("update users set
            kullanici_no=:kullanici_no,
            isim=:isim,
            soyisim=:soyisim,
            eposta=:eposta,
            tel=:tel,
            bolum=:bolum,
            fakulte_adi=:fakulte_adi,
            role=:role  where id=:id
            ");

            $kontrol=$ogretmen_guncelle->execute(array(
                "kullanici_no"=>$_POST["kullanici_no"],
                "isim"=>$_POST["isim"],
                "soyisim"=>$_POST["soyisim"],
                "eposta"=>$_POST["eposta"],
                "tel"=>$_POST["tel"],
                "bolum"=>$_POST["bolum"],
                "fakulte_adi"=>$_POST["fakulte_adi"],
                "role"=>$_POST["role"],
                "id"=>$_GET["id"]
            ));

            if ($kontrol) {
               header("location:/staj-takip/administrator/teacherList.php");
               exit;
            }else{
                echo "hata";
            }
        }
        ?>


</body>
</html>