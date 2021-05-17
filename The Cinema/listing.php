<?php include "system/connect.php"; ?>

<?php include "header.php"; ?>

<div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/hero-1.jpg)"></div>

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
        <div class="row"> 
            <?php
            $filmler = $db->prepare("SELECT DISTINCT film_adi,resim_php,film_turu,seans_tarih from film_seans WHERE seans_tarih > = getdate()");
            $filmler->execute();
            $x = $filmler->fetchALL(PDO::FETCH_ASSOC);
            foreach ($x as $m) { ?>
                <!-- Single Features Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-features-area">
                        <img src="img/<?php echo $m["resim_php"]; ?>" style="width: 500px;height: 450px;padding: 35px;">
                        <div class="feature-content d-flex align-items-center justify-content-between">
                            <div class="feature-title">
                                <h5><?php echo $m["film_adi"]; ?></h5>
                                <p><?php echo $m["film_turu"]; ?></p>
                            </div>
                            <div class="feature-favourite">
                                <button class="btn btn-link">
                                    <a href="control.php">
                                        <i class="fa fa-calendar fa-2x"></i>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<!-- ***** Listing Destinations Area End ***** -->
<?php include "footer.php"; ?>