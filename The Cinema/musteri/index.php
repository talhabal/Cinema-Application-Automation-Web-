<?php include "../system/connect.php";?>
<?php include "header.php";?>

    <!-- ***** Ana Sayfa Başlangıcı ***** -->
    <section class="dorne-welcome-area bg-img bg-overlay" style="background-image: url(../img/home.png);">
        <div class="container h-100">
        <div class="col-12 col-md-10">
                    <div class="hero-content">
                        <!-- *****  <h2 style="float:left;margin-top:180px;margin-left:-120px;" >Hoş Geldiniz!</h2> ***** -->
                         
                    </div>
                </div>
            <div class="row h-100 align-items-center justify-content-center">
                
            </div>
        </div>
    </section>
    <!-- ***** Ana Sayfa Bitişi ***** -->
    <div class="dorne-search-form d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="search-close-btn" id="closeBtn">
                    <i class="pe-7s-close-circle" aria-hidden="true"></i>
                </div>
                <form method="post">
                    <input type="search" name="keyword" id="keyword" placeholder="Film Adı , Film Türü , Seans Saati ve Seans Tarihlerine göre arama yapabilirsiniz...">
                    <input type="submit" class="d-none" value="submit">
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- ***** Tanıtım Kartları Başlangıcı ***** -->
    <section class="dorne-catagory-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="all-catagories">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md">
                                <div class="single-catagory-area wow fadeInUpBig" data-wow-delay="0.2s">
                                    <div class="catagory-content">
                                    <i class="fa fa-registered fa-3x"></i>
                                        <a href="#">
                                            <h6>Anında <br>Rezervasyon <br>Hizmeti</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md">
                                <div class="single-catagory-area wow fadeInUpBig" data-wow-delay="0.4s">
                                    <div class="catagory-content">
                                    <i class="fa fa-credit-card fa-3x"></i>
                                        <a href="#">
                                            <h6>İstediğiniz <br>Kart ile<br> Ödeme Yöntemi</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md">
                                <div class="single-catagory-area wow fadeInUpBig" data-wow-delay="0.6s">
                                    <div class="catagory-content">
                                    <i class="fa fa-window-close fa-3x"></i>
                                        <a href="#">
                                            <h6>Filmden 1 Saat <br> Öncesine Kadar Bilet İptal Seçeneği</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md">
                                <div class="single-catagory-area wow fadeInUpBig" data-wow-delay="0.8s">
                                    <div class="catagory-content">
                                    <i class="fa fa-ellipsis-h fa-4x"></i>
                                        <a href="#">
                                            <h6>Ve Birçok Ayrıcaklıklar Sizi Bekliyor...</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Tanıtım Kartları Bitişi ***** -->

    

    
    <!-- ***** Vizyondaki Filmler Başlangıç ***** -->
    <section class="dorne-features-destinations-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading dark text-center">
                        <span></span>
                        <h4>VİZYONDA OLAN FİLMLER</h4>
                        
                    </div>
                </div>
            </div>


            


            <div class="row">
            <div class="col-12">
                <div class="features-slides owl-carousel">

                    <?php
                    if (isset($_POST["keyword"])) {
                        $keyword=$_POST["keyword"];
                        $filmler = $db->prepare("SELECT DISTINCT film_id,film_adi,resim_php,film_turu,seans_saat,seans_tarih from film_seans where film_adi like '$keyword' or film_turu like '$keyword' or seans_tarih like '$keyword' or seans_saat like '$keyword'");
                        $filmler->execute(array());
                        $x = $filmler->fetchALL(PDO::FETCH_ASSOC);

                        foreach ($x as $m) {
                    ?>
                            <!-- Single Features Area -->
                            <div class="single-features-area">
                                <img src="../img/<?php echo $m["resim_php"]; ?>">
                                <div class="price-start">
                                <p><?= $m["film_turu"]; ?></p>
                            </div>
                                <div class="feature-content d-flex align-items-center justify-content-between">
                                    <div class="feature-title">
                                        <h5><?php echo $m["film_adi"]; ?></h5>
                                        <p><?php echo $m["seans_saat"]; ?></p>
                                <p><?php echo $m["seans_tarih"]; ?></p>

                                    </div>
                                    <div class="feature-favourite">
                                        <a href="film-detail.php?film_id=<?= $m["film_id"] ?>"><i class="fa fa-calendar"></i></a>
                                    </div>
                                </div>
                            </div>


                        <?php
                        }
                    } else {
                        $filmler = $db->prepare("SELECT  DISTINCT film_id,film_adi,resim_php,film_turu,seans_saat,seans_tarih FROM film_seans WHERE seans_tarih >= getdate() ");
                        $filmler->execute(array());
                        $x = $filmler->fetchALL(PDO::FETCH_ASSOC);

                        foreach ($x as $m) {
                        ?>
                            <!-- Single Features Area -->
                            <div class="single-features-area">
                                <img src="../img/<?php echo $m["resim_php"]; ?>">
                                <div class="price-start">
                                <p><?= $m["film_turu"]; ?></p>
                            </div>
                                <div class="feature-content d-flex align-items-center justify-content-between">
                                    <div class="feature-title">
                                        <h5><?php echo $m["film_adi"]; ?></h5>
                                        <p><?php echo $m["seans_saat"]; ?></p>
                                <p><?php echo substr($m["seans_tarih"],0,-7); ?></p>

                                    </div>
                                    <div class="feature-favourite">
                                        <a href="film-detail.php?film_id=<?= $m["film_id"] ?>"><i class="fa fa-calendar"></i></a>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>


</section>

    
    <!-- ***** Vizyondaki Filmler Bitiş ***** -->

   
    

    

<?php include "footer.php";?>
</body>

</html>