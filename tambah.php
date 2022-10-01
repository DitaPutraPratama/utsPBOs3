<?php

#buka koneksi
include("koneksi.php");

#cek form
if (isset($_POST["submit"])) {
    $id_hp = htmlentities(strip_tags(trim($_POST["id_hp"])));
    $merek_hp = htmlentities(strip_tags(trim($_POST["merek_hp"])));
    $tipe_hp = htmlentities(strip_tags(trim($_POST["tipe_hp"])));
    $os_hp = htmlentities(strip_tags(trim($_POST["os_hp"])));
    $tgl = htmlentities(strip_tags(trim($_POST["tgl"])));
    $bln = htmlentities(strip_tags(trim($_POST["bln"])));
    $thn = htmlentities(strip_tags(trim($_POST["thn"])));
    $kode_hp = htmlentities(strip_tags(trim($_POST["kode_hp"])));
    $kode_produksi = htmlentities(strip_tags(trim($_POST["kode_produksi"])));
    $email = htmlentities(strip_tags(trim($_POST["email"])));

    #varible pesan eror
    $pesaneror = "";

    if (empty($id_hp)) {
        $pesaneror .= "ID belum di isi";
    } elseif (!preg_match("/^[0-9]{8}$/", $id_hp)) {
        $pesan_error .= "ID harus berupa 8 digit angka <br>";
    }

    $id_hp = mysqli_real_escape_string($link, $id_hp);
    $query = "SELECT * FROM master WHERE id_hp='$id_hp'";
    $hasil_query = mysqli_query($link, $query);

    $jumlah_data = mysqli_num_rows($hasil_query);
    if ($jumlah_data >= 1) {
        $pesan_error .= "ID yang sama sudah digunakan <br>";
    }

    if (empty($merek_hp)) {
        $pesan_error .= "Merek Hp belum diisi <br>";
    }

    if (empty($tipe_hp)) {
        $pesan_error .= "Tipe Hp belum diisi <br>";
    }

    if (empty($os_hp)) {
        $pesan_error .= "OS Hp belum diisi <br>";
    }
    if (empty($kode_hp)) {
        $pesan_error .= "Kode Hp belum diisi <br>";
    }
    if (empty($os_hp)) {
        $pesan_error .= "OS Hp belum diisi <br>";
    }
    if (empty($kode_produksi)) {
        $pesan_error .= "kode Produksi belum diisi <br>";
    }
    if (empty($email)) {
        $pesan_error .= "Email Hp belum diisi <br>";
    }

    if ($pesaneror === "") {

        $id_hp = mysqli_real_escape_string($link, $id_hp);
        $merek_hp = mysqli_real_escape_string($link, $merek_hp);
        $tipe_hp = mysqli_real_escape_string($link, $tipe_hp);
        $os_hp = mysqli_real_escape_string($link, $os_hp);
        $tgl = mysqli_real_escape_string($link, $tgl);
        $bln = mysqli_real_escape_string($link, $bln);
        $thn = mysqli_real_escape_string($link, $thn);
        $kode_hp = mysqli_real_escape_string($link, $kode_hp);
        $kode_produksi = mysqli_real_escape_string($link, $kode_produksi);
        $email = mysqli_real_escape_string($link, $email);

        $tanggal_produksi = $thn . "-" . $bln . "-" . $tgl;

        $query = "INSERT INTO master VALUES";
        $query .= "('$id_hp','$merek_hp','$tipe_hp','$os_hp',";
        $query .= "'$tanggal_produksi','$kode_hp','$kode_produkdi','$email')";

        $result = mysqli_query($link, $query);

        if ($result) {
            $pesan = "Handphon dengan merek = \"<b>$merek_hp</b>\" sudsh berhasil ditambahkan";
            $pesan = urlencode($pesan);
            header("Location: beranda.php?pesan={$pesan}");
        } else {
            die("query gagal dijalankan: " . mysqli_errno($link) . "_" . mysqli_error($link));
        }
    }
} else {
    $pesaneror = "";
    $id_hp = "";
    $merek_hp = "";
    $tipe_hp = "";
    $os_hp = "";
    $kode_hp = "";
    $kode_produksi = "";
    $email = "";
    $tgl = 1;
    $bln = "1";
    $thn = 2000;
}

$arr_bln = array(
    "1" => "Januari",
    "2" => "Februari",
    "3" => "Maret",
    "4" => "April",
    "5" => "Mei",
    "6" => "Juni",
    "7" => "Juli",
    "8" => "Agustus",
    "9" => "September",
    "10" => "Oktober",
    "11" => "Nopember",
    "12" => "Desember"
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data base Handphone</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 id="logo">Data base <span>Handphone</span></h1>
            <p id="tanggal"><?php echo date("d M Y") ?></p>
        </div>
        <hr>
        <nav>
            <ul>
                <li><a href="beranda.php">Tampil</a></li>
                <li><a href="tambah.php">Tambah</a>
                <li><a href="edit.php">Edit</a>
                <li><a href="hapus.php">Hapus</a></li>
                <li><a href="logout.php">Logout</a>
            </ul>
        </nav>
        <form id="searh" action="beranda.php" method="GET">
            <p>
                <label for="merek_hp">Merek</label>
                <input type="text" name="nama" id="nama" placeholder="search">
                <input type="submit" name="submit" value="search">
            </p>
        </form>
        <h2>Data Base Handphon</h2>
        <?php
        if ($pesaneror !== "") {
            echo "<div class=\"eror\">$pesaneror</div>";
        }
        ?>
        <form id="form_hp" action="tambah.php" method="POST">
            <fieldset>
                <legend>Barang Baru</legend>
                <p>
                    <label for="id_hp">ID:</label>
                    <input type="text" name="id_hp" id="id_hp" value="<?php echo $id_hp ?>" placeholder="12345678">(8 digit angka)
                </p>
                <p>
                    <label for="merek_hp">Merek:</label>
                    <input type="text" name="merek_hp" id="merek_hp" value="<?php echo $merek_hp ?>">
                </p>
                <p>
                    <label for="tipe_hp">Type:</label>
                    <input type="text" name="tipr_hp" id="tipe_hp" value="<?php echo $tipe_hp ?>">
                </p>
                <p>
                    <label for="os_hp">OS:</label>
                    <input type="text" name="os_hp" id="os_hp" value="<?php echo $os_hp ?>">
                </p>
                <p>
                    <label for="tgl">Tanggal Produksi:</label>
                    <select name="tgl" id="tgl">
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            if ($i == $tgl) {
                                echo "<option value = $i selected>";
                            } else {
                                echo "<option value = $i >";
                            }
                            echo str_pad($i, 2, "0", STR_PAD_LEFT);
                            echo "</option>";
                        }
                        ?>
                    </select>
                    <select name="bln">
                        <?php
                        foreach ($arr_bln as $key => $value) {
                            if ($key == $bln) {
                                echo "<option value=\"{$key}\" selected>{$value}</option>";
                            } else {
                                echo "<option value=\"{$key}\">{$value}</option>";
                            }
                        }
                        ?>
                    </select>
                    <select name="thn">
                        <?php
                        for ($i = 2000; $i <= 2030; $i++) {
                            if ($i == $thn) {
                                echo "<option value = $i selected>";
                            } else {
                                echo "<option value = $i >";
                            }
                            echo "$i </option>";
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="kode_hp">kode Hp:</label>
                    <input type="text" name="kode_hp" id="kode_hp" value="<?php echo $kode_hp ?>">
                </p>
                <p>
                    <label for="kode_produksi">Kode Produksi:</label>
                    <input type="text" name="kode_produksi" id="kode_produksi" value="<?php echo $kode_produksi ?>">
                </p>
                <p>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" value="<?php echo $email ?>">
                </p>
            </fieldset>
            <br>
            <p>
                <input type="submit" name="submit" value="Tambah Data">
            </p>
        </form>
        <div id="footer">
            Copyright © <?php echo date("Y"); ?>
        </div>
    </div>
</body>

</html>
<?php mysqli_close($link); ?>