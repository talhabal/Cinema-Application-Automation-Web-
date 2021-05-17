<?php include "../system/connect.php";


?>
<?php include "header.php";?>

   <body>

   <!-- ***** Breadcumb Area Start ***** -->
   <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(../img/hero-1.jpg)">
    </div>
    <!-- ***** Breadcumb Area End ***** -->
    
            <div class="col-12" style="margin-left:-180px;margin-top:50px;">
                <div class="section-heading dark text-center">
                    <span></span>
                    <h4>Bİletlerİm</h4>
                </div>
            </div>
            
        
    <!-- Explore Area -->
    
 

<?php
                $musteri_id = $_SESSION['musteri_id'];
                $ticket = $db->prepare("SELECT * FROM bilet INNER JOIN musteriler ON bilet.bilet_musteri_id=musteriler.musteri_id  WHERE bilet_musteri_id =?");
                $ticket->execute(array($musteri_id));
                $ticket_cek = $ticket->fetchAll(PDO::FETCH_ASSOC);
                

                    ?>

    <section class="dorne-single-listing-area section-padding-50" style="margin-top:-100px;margin-left:-150px;">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Single Listing Content -->
                <div class="col-12 col-lg-8">
                    <div class="single-listing-content">
                        <div class="table-responsive"><br><br><br>
                        <table class="table table-borderless table-striped table-earning">
                            <thead> 
                                <tr>
                                    <th>Film Adı</th>
                                    <th>Kişi İsim</th>
                                    <th>Seans Saati</th>
                                    <th>Salon Adı</th>
                                    <th>Seans Tarihi</th>
                                    <th>Koltuk No</th>
                                    <th>İşlem</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($ticket_cek as $row) { ?>
                                    <tr>
                                        <td><?php echo $row["film_adi"] ?></td>
                                        <td><?php echo $row["musteri_adi_soyadi"] ?></td>
                                        <td><?php echo $row["seans_saat"] ?></td>
                                        <td><?php echo $row["salon_adi"] ?></td>
                                        <td><?php echo substr($row["seans_tarih"],0,-7); ?></td>
                                        <td><?php echo $row["koltuk_no"] ?></td>
                                        <td>
                                            <a href="../system/operations.php?biletsil_id=<?php echo $row["bilet_id"]; ?>" class="btn btn-danger btn-sm">İptal</a>
                                        </td>




                                        
                                        
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                      
                    </div>
                </div>

  
                 
                

                
                <div class="col-12 col-md-8 col-lg-4">
                   
<?php 
$person = $db->prepare("SELECT * FROM musteriler WHERE musteri_id =?");
$person->execute(array($musteri_id));
$person_cek = $person->fetch(PDO::FETCH_ASSOC);
?>
 <div class="col-12" style="margin-left:80px;margin-top:-40px;">
                <div class="section-heading dark text-center">
                    <span></span>
                    <h4>Profİl GÜncelleme</h4>
                </div>
            </div>
                    


                        <!-- Contact Form -->
                        <div class="contact-form contact-form-widget mt-50" style="margin-top:30px;margin-right:-120px;margin-left:80px;">
                            
                            <form action="../system/operations.php" method="POST">
                                <div class="row">
                                    <div class="col-12">
                                        <p style="font-size:13px;text-align:center;">Adı Soyadı</p>
                                        <input type="text" name="musteri_adi_soyadi" class="form-control" value="<?php echo $person_cek["musteri_adi_soyadi"] ?>">
                                        
                                        <p style="font-size:13px;text-align:center;">Kullanıcı Adı</p>
                                        <input type="text" name="musteri_kullanici_adi" class="form-control" value="<?php echo $_SESSION["musteri_kullanici_adi"] ?>">
                                    
                                        <p style="font-size:13px;text-align:center;">E-Posta</p>
                                        <input type="email" name="musteri_mail" class="form-control" value="<?php echo $person_cek["musteri_mail"] ?>">
                                    
                                        <p style="font-size:13px;text-align:center;">Parola</p>
                                        <input type="password" name="musteri_parola" class="form-control" value="<?php echo $person_cek["musteri_parola"] ?>" >
                                    
                                        <button type="submit" name="update" class="btn dorne-btn btn-block">Güncelle</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
        
    <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-yui_3_17_2_1_1567795542108_278025">

 

    <?php include "footer.php";?>
</body>

</html>