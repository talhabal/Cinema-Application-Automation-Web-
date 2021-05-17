<?php include "../system/connect.php"; ?>
<?php include "header.php";

$film_id = $_GET["film_id"];
$movie = $db->prepare("SELECT * FROM film_seans WHERE film_id= ?");
$movie->execute(array($film_id));
$movie_check = $movie->fetch(PDO::FETCH_ASSOC);
?>
<div class="breadcumb-area bg-img bg-overlay" style="background-image: url(../img/hero-1.jpg)"></div>
<section class="dorne-single-listing-area section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="../img/<?php echo $movie_check["resim_php"]; ?>" style="width:350px;height:500px;">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-10">
                <div class="product__details__text" style="text-align:center;margin-top:120px;">
                    <h3><?php echo $movie_check["film_adi"]; ?></h3>
                    <p><?php echo $movie_check["film_turu"]; ?></p>
                    <ul>
                        <li><b> <span><?php echo substr($movie_check["seans_tarih"],0,-7); ?></span></b></li><br>
                        <li><b> <span><?php echo $movie_check["salon_adi"]; ?></span></b></li><br>
                        <li><b> <span><?php echo $movie_check["seans_saat"]; ?></span></b></li><br>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container" style="width: 680px; height:40px;background-color:black;margin-left:100px;">
        <p style="color: white; font-size:25px;text-align:center;margin-top:50px;">PERDE</p>
    </div><br>

    <div class="container" style="width: 500px; height:500px;margin-left:200px;">
        <div class="row">
            <?php
            $ticket = $db->prepare("SELECT b.bilet_id,b.koltuk_no FROM bilet b INNER JOIN film_seans f ON f.film_adi=b.film_adi WHERE f.film_adi = ? AND f.salon_adi= ? AND f.seans_tarih = ?");
            $ticket->execute(array($movie_check["film_adi"], $movie_check["salon_adi"], $movie_check["seans_tarih"]));
            $ticket_check = $ticket->fetchAll(PDO::FETCH_ASSOC);
            $booked = array();
            foreach ($ticket_check as $chair) {
                $booked[] = $chair['koltuk_no'];
            }
            for ($i = 1; $i < 26; $i++) {
                if (in_array($i, $booked)) {
            ?>
                    <button type="button" class="btn btn-warning" style="width: 100px; height:100px;" disabled>
                        <img src="../img/dolu.png" width="60px;" height="60px;">
                        <?php echo $i ?>
                    </button>
                <?php
                } else {
                ?>
                    <button type="button" class="btn btn-warning" style="width: 100px; height:100px;">
                        <img src="../img/bos.png" width="60px;" height="60px;">
                        <?php echo $i ?>
                    </button>
            <?php
                }
            } ?>
        </div>
    </div>

    <div class="container" style="width: 600px; height:300px;margin-left:900px; margin-top:-450px;">
        <form action="../system/operations.php?film_id=<?= $film_id ?>" method="post">
            <div class="row form-group">
                <div class="col col-md-9">
                    <div class="input-group input-group-icon">
                        <input name="bilet_isim" type="hidden" value="<?php echo $_SESSION["musteri_kullanici_adi"] ?>" class="form-control input-lg" />
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <div class="col col-md-9">
                    <div class="input-group input-group-icon">
                        <input value="<?php echo $movie_check["film_adi"]; ?>" name="film_adi" type="hidden" class="form-control input-lg" placeholder="Seans Tarihi" />
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <div class="col col-md-9">
                    <div class="input-group input-group-icon">
                        <input value="<?php echo $movie_check["seans_tarih"]; ?>" name="seans_tarih" type="hidden" class="form-control input-lg" />
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <div class="col col-md-9">
                    <div class="input-group input-group-icon">
                        <input value="<?php echo $movie_check["seans_saat"] ?>" name="seans_saat" type="hidden" class="form-control input-lg" />
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <div class="col col-md-9">
                    <div class="input-group input-group-icon">
                        <input value="<?php echo $movie_check["salon_adi"] ?>" name="salon_adi" type="hidden" class="form-control input-lg" />
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <div class="col col-md-9">
                    <select name="koltuk_no" class="form-control">
                        <option>Koltuk Numarası</option>
                        <?php
                        for ($i = 1; $i < 26; $i++) {
                            if (in_array($i, $booked)) { ?>
                            <?php } 
                            else { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php echo $i ?>
                            <?php
                            }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col col-md-9">
                    <input style="margin-left:60px;" type="radio" name="musteri_tipi" value="Öğrenci"> Öğrenci</input>
                    <input style="margin-left:100px;" type="radio" name="musteri_tipi" value="Yetişkin"> Yetişkin</input>
                </div>
            </div>

            <div class="row form-group">
                <div class="col col-md-9">
                    <button class="btn btn-primary btn-block" name="bilet">Bilet Al</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</section>
<br><br><br><br>

<?php include "footer.php"; ?>