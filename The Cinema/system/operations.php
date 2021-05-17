<?php include "connect.php";
error_reporting(E_ALL & ~E_NOTICE);
ob_start();
session_start();
extract($_POST);

    if(isset($_POST['login'])){
        if (!$musteri_kullanici_adi || !$musteri_parola ) {
            echo "<script type='text/javascript'>alert('Lütfen boş bırakmayınız!');</script>";
            header("Refresh: 0.1; url=../signin.php");
        } 
        else {
            $users=$db->prepare("SELECT * FROM musteriler WHERE musteri_kullanici_adi= :musteri_kullanici_adi AND musteri_parola= :musteri_parola");
            $users->execute(array(
                'musteri_kullanici_adi'=>$_POST['musteri_kullanici_adi'],
                'musteri_parola'=>$_POST['musteri_parola']
            ));
            $user_check = $users->fetch(PDO::FETCH_ASSOC);
            if ($user_check) {		   
                $_SESSION['musteri_kullanici_adi']=$_POST['musteri_kullanici_adi'];
                $_SESSION['musteri_id']=$user_check['musteri_id'];
                header("Refresh: 0.1; url=../musteri/index.php");
            }
            else {
               echo "<script type='text/javascript'>alert('Kullanıcı Adı veya Şifre Hatalı!');</script>";
               header("Refresh: 0.1; url=../signin.php");
            }
        }
    }

    if (isset($_POST['bilet'])) {
        $url = htmlspecialchars($_SERVER['HTTP_REFERER']); // Bir önceki sayfaya geri dönme kodu 
            $bilet_musteri_id = $_SESSION["musteri_id"];
            $film_adi=$_POST["film_adi"];
            $seans_tarih=$_POST["seans_tarih"];
            $seans_saat=$_POST["seans_saat"];
            $koltuk_no=$_POST["koltuk_no"];
            $bilet_isim=$_POST["bilet_isim"];
            $musteri_tipi = $_POST["musteri_tipi"];
        if ( !$bilet_isim) {
            echo "<script type='text/javascript'>alert('Lütfen formu eksiksiz doldurunuz!');</script>";
            header("Refresh: 0.1; url=../musteri/listing.php");
        } 
        else {
            
             $bilet = $db->prepare("INSERT INTO bilet(film_adi, seans_tarih, seans_saat, koltuk_no, bilet_isim, salon_adi, musteri_tipi, bilet_musteri_id)
                VALUES (:film_adi, :seans_tarih, :seans_saat, :koltuk_no, :bilet_isim, :salon_adi, :musteri_tipi, :bilet_musteri_id)");
                    
             $insert = $bilet->execute(array(
            'bilet_musteri_id' => $bilet_musteri_id,
            'film_adi' => $film_adi,
             'seans_tarih' => $seans_tarih,
             'seans_saat' => $seans_saat,
             'koltuk_no' => $koltuk_no,
             'bilet_isim' => $bilet_isim,
             'salon_adi' => $salon_adi,
             'musteri_tipi' =>$musteri_tipi
         ));
                if ($insert) {
                      echo "<script type='text/javascript'>alert('Bilet Rezerve Edildi!');</script>";
                       header("Refresh: 0.1; url=$url");
                }
                else {
                       echo "<script type='text/javascript'>alert('Bir hata oluştu!');</script>";
                }
    
            
         }
    }
 

    if(isset($_POST['register'])) {

        $musteri_kullanici_adi = $_POST['musteri_kullanici_adi'];
        $musteri_mail = $_POST['musteri_mail'];
        $musteri_parola = $_POST['musteri_parola'];


        if (!$musteri_kullanici_adi || !$musteri_mail || !$musteri_parola ) {
            echo "<script type='text/javascript'>alert('LÜTFEN BOŞ ALAN BIRAKMAYINIZ!');</script>";
            header("Refresh: 0.1; url=../register.php");

        }
        else {
             $messages=$db->prepare("INSERT INTO musteriler(musteri_kullanici_adi, musteri_mail,musteri_adi_soyadi, musteri_parola) VALUES(:musteri_kullanici_adi, :musteri_mail, :musteri_adi_soyadi,:musteri_parola)");
             $insert = $messages->execute(array(
            'musteri_kullanici_adi' => $_POST['musteri_kullanici_adi'],
             'musteri_mail' => $_POST['musteri_mail'],
             'musteri_adi_soyadi' => $_POST['musteri_adi_soyadi'],
             'musteri_parola' => $_POST['musteri_parola']
         ));
             if ($insert) {
                 echo "<script type='text/javascript'>alert('KAYIT İŞLEMİ BAŞARILI!');</script>";
                 header("Refresh: 0.1; url=../index.php");


             }
             else {
                 echo "<script type='text/javascript'>alert('Bir Hata Oluştu!');</script>";
                 header("Refresh: 0.1; url=../register.php");


             }
        }
    }
    
    if (isset($_POST['update'])) {
        $update=$db->prepare("UPDATE musteriler SET 
            musteri_adi_soyadi=:musteri_adi_soyadi,
            musteri_mail=:musteri_mail,
            musteri_parola=:musteri_parola,
            musteri_kullanici_adi=:musteri_kullanici_adi WHERE musteri_id= :musteri_id");
        $update->execute(array(
            'musteri_adi_soyadi'=>$_POST['musteri_adi_soyadi'],
            'musteri_mail'=>$_POST['musteri_mail'],
            'musteri_parola'=>$_POST['musteri_parola'],
            'musteri_kullanici_adi'=>$_POST['musteri_kullanici_adi'],
            'musteri_id'=>$_SESSION['musteri_id']));
        if ($update) {
            echo "<script type='text/javascript'>alert('BİLGİLERİNİZ GÜNCELENDİ.LÜTFEN TEKRAR GİRİŞ YAPINIZ...');</script>";
            header("Refresh: 0.1; url=../signin.php");
        }
        else {
            echo "<script type='text/javascript'>alert('Hiçbir değişiklik yapılmadı!');</script>";
            header("Refresh: 0.1; url=../musteri/profil_ayarlar.php");
        }
    }

    $biletsil_id = $_GET["biletsil_id"];
if (isset($biletsil_id)) {
    $url = htmlspecialchars($_SERVER['HTTP_REFERER']); 
	$tickets = $db->prepare("DELETE FROM bilet WHERE bilet_id=?");
	$delete = $tickets->execute(array($biletsil_id));
	if ($delete) {
        echo "<script type='text/javascript'>alert('Bilet İptal Edildi!');</script>";
        header("Refresh: 0.1; url=$url");	
    } 
    else {
        echo "<script type='text/javascript'>alert('İptal İşlemi Başarısız!');</script>";
        header("Refresh: 0.1; url=$url");		}
}

 ?>