<?php
session_start();
include '../connect.php';

$sorgu=$db->prepare("select * from users");
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
                    <a href="/staj-takip/administrator/addUser.php" class="nav-link text-white active">
                        Kullanıcı Ekle
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
            <h3 class="text-center mt-5">Kullanıcı Ekleme</h3>
            <form class="m-5"  method="POST">
                <div class="row">
                <div class="form-group col-md-6">
                        <label class="text-dark" for="soyad">Kullanıcı No:</label>
                        <input class="form-control" type="text" name="kullanici_no" id="kullanici_no" placeholder="Kullanıcı numarası girin..." required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="soyad">İsim:</label>
                        <input class="form-control" type="text" name="isim" id="isim" placeholder="İsim girin..." required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="soyisim">Soyisim:</label>
                        <input class="form-control" type="text" name="soyisim" id="soyisim" placeholder="Soyisim girin..."  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="soyisim">TC Kimlik No:</label>
                        <input class="form-control" type="text" name="tc" id="tc" placeholder="Tc kimlik numarası girin..."  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="soyisim">E Posta:</label>
                        <input class="form-control" type="text" name="eposta" id="eposta" placeholder="E-Posta girin..."  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="soyisim">Telefon Numarası:</label>
                        <input class="form-control" type="text" name="tel" id="tel" placeholder="Telefon numarası girin..."  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="stajturu">Sınıf:</label>
                        <select id="sinif" name="sinif" class="form-control" placeholder="Sınıf seçin..."  required>
                          <option selected>Yok</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                        </select>
                      </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="bolum">Bölüm:</label>
                        <input class="form-control" type="text" name="bolum" id="bolum" placeholder="Bölüm girin..."  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="fakulte_adi">Fakülte:</label>
                        <input class="form-control" type="text" name="fakulte_adi" id="fakulte_adi" placeholder="Fakülte girin..."  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="fakulte_adi">Şifre:</label>
                        <input class="form-control" type="password" name="sifre" id="sifre" placeholder="TC Numarasının Son 6 Hanesi"  required>
                    </div>
                    <div class="form-group col-md-6 mt-3">
                        <label for="stajturu">Rol:</label>
                        <select id="role" name="role" class="form-control" placeholder="Role seçin..."  required>
                          <option selected>öğrenci</option>
                          <option>öğretmen</option>
                          <option>komisyon</option>
                        </select>
                      </div>
                      
                      <div class="form-group col-md-6 text-center">
                        <button class="btn btn-outline-success mt-5" id="sifre_ata" >Şifre Ata</button>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-outline-success mt-5 w-100" name="kullanici_ekle" id="kullanici_ekle" >Kullanıcı Ekle</button>
                    </div>
                </div>
              </form>
        </div>
</div>
<?php
        if (isset($_POST["kullanici_ekle"])) {
            $kullanici_ekle=$db->prepare("insert into users set
            kullanici_no=:kullanici_no,
            isim=:isim,
            soyisim=:soyisim,
            tc=:tc,
            eposta=:eposta,
            tel=:tel,
            sinif=:sinif,
            bolum=:bolum,
            fakulte_adi=:fakulte_adi,
            sifre=:sifre,
            role=:role  
            ");

            $kontrol=$kullanici_ekle->execute(array(
                "kullanici_no"=>$_POST["kullanici_no"],
                "isim"=>$_POST["isim"],
                "soyisim"=>$_POST["soyisim"],
                "tc"=>$_POST["tc"],
                "eposta"=>$_POST["eposta"],
                "tel"=>$_POST["tel"],
                "sinif"=>$_POST["sinif"],
                "bolum"=>$_POST["bolum"],
                "fakulte_adi"=>$_POST["fakulte_adi"],
                "sifre"=>md5($_POST["sifre"]),
                "role"=>$_POST["role"]
            ));

            if ($kontrol) {
               header("location:/staj-takip/administrator/addUser.php");
      
            }else{
                echo "hata";
            }
        }
        ?>

<script>

        const sifre = document.getElementById("sifre")
        const tc = document.getElementById("tc")
        const sifre_ata = document.getElementById("sifre_ata")

        
        sifre_ata.addEventListener('click', sifreAta)

        function sifreAta(e) {
            e.preventDefault()
            sifre.value = (tc.value).slice(5)
            sifre.innerHTML = sifre.value
            console.log(sifre.value)
        }

</script>
</body>
</html>