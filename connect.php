<?php

    try {
        //PHPMYADMIN veritabanı ile bağlantı
        $db = new PDO("mysql:host=localhost;dbname=staj_takip;charset=utf8", "root", "");
        //echo "başarılı";
        
    } catch (PDOException $e) {
        echo ($e->getMessage());
        
    }

?>