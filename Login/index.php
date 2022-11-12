<?php
session_start();


if (isset($kullanici_no)|| isset($sifre)) {
       $kullanici_no= $_POST['kullanici_no'];
       $sifre= md5($_POST['sifre']);
       
}


if (isset($_POST["admin"])) {
       include '../connect.php';
       
       $kullanici_no= $_POST['kullanici_no'];
       $sifre= md5($_POST['sifre']);
       

       $sorgu=$db->prepare("select kullanici_no,sifre from users where kullanici_no=:kullanici_no");
       $sorgu->execute(['kullanici_no'=>$kullanici_no]);
       $kullanici=$sorgu->fetch(PDO::FETCH_ASSOC);

       //print_r($kullanici);
       if ($kullanici) {
              //kullanici varsa
              if ($sifre===$kullanici['sifre']) {
                    //giriş doğru
                    $_SESSION['kullanici_no']=$kullanici_no;
                    header('location:/staj-takip/Login/yonlendir.php');
  
                    //echo "giriş yaptınız";
              }else{
                     //giriş yanlış
                     echo "<h2 class='alert alert-danger text-center mt-5'>Girdiğiniz Şifre Hatalı! Lütfen Tekrar Deneyiniz...</h2>";
              }
       }else{
              //kullanici yoksa
              echo "<h2 class='alert alert-danger text-center mt-5'>Kullanıcı numarası bulunamadı! Lütfen Tekrar Deneyiniz...</h2>";
       }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/login.css">
    <title>KOU STAJ TAKİP</title>
</head>
<body style="background-color:#d9d9d9;">

<div class="container d-flex justify-content-center align-items-center mt-5">
        <form class="border shadow p-3 rounded bg-white"
              action="/staj-takip/Login/index.php"
              method="post" 
              style="width: 600px;">
              <h1 class="text-center p-3">Giriş Yap</h1>

            <div class="mb-3">
            <label for="kullanici_no" 
                   class="form-label">Kullanıcı No:</label>
            <input type="text" 
                   class="form-control" 
                   name="kullanici_no" 
                   id="kullanici_no">
          </div>
          <div class="mb-3">
            <label for="sifre" 
                   class="form-label">Şifre:</label>
            <input type="password" 
                   name="sifre" 
                   class="form-control" 
                   id="sifre">
          </div>
          <button class='btn btn-success text-center' name="admin">GİRİŞ YAP</button>
          <div class="container mt-5">
          <div class="col-md-12 mt-2 text-dark p-2" style=' border:2px solid #27A659 !important;'><h6 class="text-center pt-1" style='color: red;'>Şifreniz TC Kimlik Numaranızın <strong>son 6 hanesidir.</strong></h6></div>
<div class="col-md-12 mt-2 text-dark p-2" style=' border:2px solid #27A659 !important;'><h5 style='color: #27A659;'>STAJ-1</h5>
Staj-1  en erken 2.sınıfın yazında en geç 3.sınıfın yazında yapılacak olup dönem sonu büt haftasından 1 hafta sonra başlayacak şekilde 30 iş günü süresince yapılması zorunludur.</div>
<div class="col-md-12 mt-2 text-dark border p-2" style=' border:2px solid #27A659 !important;'><h5 style='color: #27A659;'>STAJ-2</h5>
Staj-2 en erken 3.sınıfın yazında en geç 4.sınıfın yazında yapılacak olup dönem sonu büt haftasından 1 hafta sonra başlayacak şekilde 30 iş günü süresince yapılması zorunludur.</div>
<div class="col-md-12 mt-2 text-dark border p-2" style=' border:2px solid #27A659 !important;'><h5 style='color: #27A659;'>İş Yeri Eğitimi</h5>
İş yeri eğitimi 4. sınıfın güz veya bahar döneminde 70 iş günü yapılması zorunlu olup alttan laboratuvar dersi olmayan öğrenciler tarafından yapılacaktır. Aksi taktirde alttan laboratuvar dersi alan öğrenciler iş yeri eğitimi yapamayacaktır.</div>
</div>
        </form>
      </div>
      
</body>
</html>

