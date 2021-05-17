<?php include 'system/connect.php'; 
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
    echo "<script type='text/javascript'>alert('GİRİŞ YAPMADAN BİLET ALAMAZSINIZ!');</script>";
    header("Refresh: 0.1; url=$url");

?>