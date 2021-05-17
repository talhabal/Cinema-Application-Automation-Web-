<?php
$koltuk_no = $_POST["koltuk_no"];
$status = $db->prepare("SELECT * FROM bilet where koltuk_no=?");
$status->execute(array($koltuk_no));
$koltuk_durum = $status->fetch(PDO::FETCH_OBJ);
if ($koltuk_no) {
    foreach ($koltuk_no as $durum) { ?>
        <button type="button" class="btn btn-warning" value="1">
            <img src="../img/dolu.png ?>" width="75px;" height="75px;">
        </button><?php
                }
            } else { ?>
    <button type="button" class="btn btn-warning" value="1">
        <img src="../img/bos.png ?>" width="75px;" height="75px;">
    </button>
    <?php
            }?>
            