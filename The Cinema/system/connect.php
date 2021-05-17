<?php
try {
	$db = new PDO("sqlsrv:server=.\SQLEXPRESS;Database=sinema_otomasyon;");	
} catch (Exception $e) {
	echo "başarısız";
}
?>