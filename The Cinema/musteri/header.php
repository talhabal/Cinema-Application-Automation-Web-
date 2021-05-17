<?php include '../system/connect.php';
ob_start();
session_start(); 
// Oturum Güvenliği
    $musteri=$db->prepare("SELECT * FROM musteriler");
    $musteri->execute();
    $musteri_check = $musteri->fetch(PDO::FETCH_ASSOC);
    if (empty($_SESSION['musteri_kullanici_adi'])) {
        header("Location:../signin.php");
        exit;
    } 
    else {
        $user_que=$db->prepare("SELECT * FROM musteriler WHERE musteri_kullanici_adi=:musteri_kullanici_adi");
        $user_que->execute(array('musteri_kullanici_adi'=>$_SESSION['musteri_kullanici_adi']));
        $result=$user_que->rowcount();
        if ($result==0) {
            header("Location:musteri/index.php");
        }    
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>THE CINEMA</title>
    <link href="../style.css" rel="stylesheet">
    <link href="../css/responsive/responsive.css" rel="stylesheet">
    

</head>

<body>

    <!-- Giriş Loder Kısmı Başlangıcı -->
    <div id="preloader">
        <div class="dorne-load"></div>
    </div>
    
    <!-- ***** Üst kısım başlangıcı ***** -->
    <header class="header_area" id="header">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-12 h-100">
                    <nav class="h-100 navbar navbar-expand-lg">
                        <a class="navbar-brand" href="index.php"><img src="../img/logo.png" width="250px;"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#dorneNav" aria-controls="dorneNav" aria-expanded="false" aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
                        <!-- Nav -->
                        <div class="collapse navbar-collapse" id="dorneNav">
                            <ul class="navbar-nav mr-auto" id="dorneMenu">
                                <div class="dorne-signin-btn">
                                    <a href="index.php">Ana Sayfa</a>
                                </div>
                                <div class="dorne-signin-btn">
                                    <a href="listing.php">Filmler</a>
                                </div>
                                <div class="dorne-signin-btn">
                                    <a href="about.php">Hakkımızda</a>
                                </div>
                                <div class="dorne-signin-btn">
                                    <a href="contact.php">İletişim</a>
                                </div>
                                <div class="dorne-signin-btn">
                                    <a href="profil_ayarlar.php">Profil</a>
                                </div>
                            </ul>
                            
                            <div class="dorne-search-btn">
                                <a id="search-btn" href="#"><i class="fa fa-search" aria-hidden="true"></i> Ara...</a>
                            </div>
                            
                            <div class="dorne-signin-btn">
                                <a href="">Hoş Geldin <b> <?php echo $_SESSION["musteri_kullanici_adi"] ?></b></a>
                            </div>
                            <div class="dorne-signin-btn">
                                <a href="logout.php">Çıkış Yap</a>
                            </div>
                            
                            
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Üst kısım bitişi -->
