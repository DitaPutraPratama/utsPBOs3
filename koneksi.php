<?php
#koneksi dengan db
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "DitaPutraPratama";
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

#periksa koneksi
if (!$link) {
    die("Koneksi dengan database gagal: " . mysqli_connect_errno() . " - " . mysqli_connect_error());
}
