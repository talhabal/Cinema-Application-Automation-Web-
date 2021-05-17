<?php include "../system/connect.php"; 
$filmler = $db->prepare("SELECT DISTINCT film_adi,resim_php,film_turu,film_id,seans_saat,seans_tarih,salon_adi FROM film_seans WHERE seans_tarih > = getdate()");
$filmler->execute();
$film_cek = $filmler->fetchAll(PDO::FETCH_ASSOC);
?>
 
<?php include "header.php"; ?>

<div class="breadcumb-area bg-img bg-overlay" style="background-image: url(../img/hero-1.jpg)"></div>

<!-- ***** Listing Destinations Area Start ***** -->
<section class="dorne-listing-destinations-area section-padding-100-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading dark text-center">
                    <span></span>
                    <h4>Fİlmler</h4>
                    <p>Vizyondaki Filmler</p>
                </div>
            </div>
        </div>
        <div class="book-a-table-widget">
            <h6>Film Arama Panel</h6>
            <form action="" method="POST">
                <input class="custom-select" name="keyword" placeholder="Film Adı , Film Türü , Salon Adı ve Seans Saatine Göre Arama...">

                
                <br>
                <button type="submit" value="submit" class="btn dorne-btn bg-white text-dark"><input type="submit" class="d-none" value="submit"><i class="fa fa-search pr-2" aria-hidden="true"></i> Search</button>
            </form>
        </div>
        <br>
        <div class="row">
        <?php
            include "../system/connect.php";
            if (isset($_POST["keyword"])) {
                $keyword=$_POST["keyword"];
                
                $filmler = $db->prepare("SELECT DISTINCT film_adi,resim_php,film_turu,film_id,seans_saat,seans_tarih,salon_adi FROM film_seans WHERE seans_tarih >= getdate() AND film_adi LIKE '$keyword' OR film_turu  LIKE '$keyword' OR salon_adi LIKE '$keyword' OR seans_saat LIKE '$keyword'");
                $filmler->execute();
                $film_cek = $filmler->fetchALL(PDO::FETCH_ASSOC);

                foreach ($film_cek as $film_icerik) {
                    //$rest = substr($film_icerik["seans_tarih"],0,10);


            ?>
                <!-- Single Features Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-features-area">
                        <img src="../img/<?php echo $film_icerik["resim_php"]; ?>" style="width: 500px;height: 450px;padding: 35px;">
                        <div class="price-start">
                                <p><?= $film_icerik["salon_adi"]; ?></p>
                            </div>
                        <div class="feature-content d-flex align-items-center justify-content-between">
                            <div class="feature-title">
                                <h5><?= $film_icerik["film_adi"]; ?></h5>
                                <p><?php echo $film_icerik["film_turu"]; ?></p>
                                <p><?php echo $film_icerik["seans_saat"]; ?></p>
                                <p><?php echo substr($film_icerik["seans_tarih"],0,-7); ?></p>
                            </div>
                            <div class="feature-favourite">
                                
                                    <a href="film-detail.php?film_id=<?php echo $film_icerik["film_id"] ?>">
                                        <i class="fa fa-calendar fa-2x"></i>
                                    </a>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
            } else {
                foreach ($film_cek as $film_icerik) {

                ?>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-features-area">
                        <img src="../img/<?php echo $film_icerik["resim_php"]; ?>" style="width: 500px;height: 450px;padding: 35px;">
                        <div class="price-start">
                                <p><?= $film_icerik["salon_adi"]; ?></p>
                            </div>
                        <div class="feature-content d-flex align-items-center justify-content-between">
                            <div class="feature-title">
                                <h5><?= $film_icerik["film_adi"]; ?></h5>
                                <p><?php echo $film_icerik["film_turu"]; ?></p>
                                <p><?php echo $film_icerik["seans_saat"]; ?></p>
                                <p><?php echo substr($film_icerik["seans_tarih"],0,-7); ?></p>
                            </div>
                            <div class="feature-favourite">
                                
                                    <a href="film-detail.php?film_id=<?= $film_icerik["film_id"] ?>">
                                        <i class="fa fa-calendar fa-2x"></i>
                                    </a>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
            } ?>
        </div>
    </div>
</section>
<!-- ***** Listing Destinations Area End ***** -->
<?php include "footer.php"; ?>