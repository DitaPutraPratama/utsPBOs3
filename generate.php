<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$link = mysqli_connect($dbhost, $dbuser, $dbpass);

#cek koneksi ke db
if (!$link) {
    die("koneksi gagal" . mysqli_connect_errno() . "-" . mysqli_connect_error());
}

#membuat data base
$query = "CREATE DATABASE IF NOT EXISTS DitaPutraPratama";
$result = mysqli_query($link, $query);
if (!$result) {
    die("query eror:" . mysqli_errno($link) . "-" . mysqli_error($link));
} else {
    echo "Alhamdulilah Database <b>DitaPutraPratama</b> berhasil dibuat :) <br>";
}

#memilih data base
$result = mysqli_select_db($link, "DitaPutraPratama");
if (!$result) {
    die("query error" . mysqli_errno($link) . " - " . mysqli_error($link));
} else {
    echo "Alhamdulilah Database <b>DitaPutraPratama</b> berhasil dipilih :) <br>";
}

#hapus tabel master bils sudah ada
$query = "DROP TABLE IF EXISTS master";
$hasil_query = mysqli_query($link, $query);
if (!$hasil_query) {
    die("query eror:" . mysqli_errno($link) . "-" . mysqli_error($link));
} else {
    echo "Alhamdulilah Tabel <b>Master</b> berhasil dihapus :) <br>";
}

#membuat tabel master
$query = "CREATE TABLE master (id_hp Int(11), merek_hp Varchar(100),";
$query .= "tipe_hp Varchar(30), os_hp varchar(50),";
$query .= "tanggal_produksi DATE, kode_hp int(50),";
$query .= "kode_produksi int(15), email varchar(50), PRIMARY KEY(id_hp))";
$hasil_query = mysqli_query($link, $query);
if (!$hasil_query) {
    die("query eror:" . mysqli_errno($link) . "-" . mysqli_error($link));
} else {
    echo "Alhamdulilah Tabel <b>Master</b> berhasil dibuat :) <br>";
}

#mengisi tabel master
$query = "INSERT INTO master VALUES";
$query .= "('11111111111', 'ipon', 'ios', 'ios', ";
$query .= "'2021-04-02','01','45','james@gmail.com')";
$hasil_query = mysqli_query($link, $query);
if (!$hasil_query) {
    die("query eror:" . mysqli_errno($link) . "-" . mysqli_error($link));
}
echo "Alhamdulilah Tabel <b>Master</b> berhasil diisi :) <br>";

#menghapus tabel admin bila sudah ada
$query = "DROP TABLE IF EXISTS admin";
$hasil_query = mysqli_query($link, $query);
if (!$hasil_query) {
    die("query eror:" . mysqli_errno($link) . "-" . mysqli_error($link));
} else {
    echo "Alhamdulilah Tabel <b>Admin</b> berhasil dihapus :) <br>";
}

#membuat tabel admin
$query = "CREATE TABLE admin (username VARCHAR(50), password CHAR(40))";
$hasil_query = mysqli_query($link, $query);
if (!$hasil_query) {
    die("query eror:" . mysqli_errno($link) . "-" . mysqli_error($link));
} else {
    echo "Alhamdulilah Tabel <b>Admin</b> berhasil dibuat :) <br>";
}

#membuat username admin
$username = "dita";
$password = "admin";

#memasukan username ke tabel admin
$query = "INSERT INTO admin VALUE ('$username','$password')";
$hasil_query = mysqli_query($link, $query);
if (!$hasil_query) {
    die("query eror:" . mysqli_errno($link) . "-" . mysqli_error($link));
} else {
    echo "Alhamdulilah Tabel <b>Admin</b> berhasil diisi :) <br>";
}

#penutup sql
mysqli_close($link);
