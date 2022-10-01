<?php
#koneksi dengan mysql
include("koneksi.php");

#ambil pesan jiaka ada
if (isset($_GET["pesan"])) {
    $pesan = $_GET["pesan"];
}

#cek form
if (isset($_GET["submit"])) {

    #ambil nilai nama
    $nama = htmlentities(strip_tags(trim($_GET["nama"])));

    #filter $nama untuk mencegas sql injektion
    $nama = mysqli_real_escape_string($link, $nama);

    #query pencarian
    $query = "SELECT*FROM master WHERE nama LIKE '%$nama%'";
    $query .= "ORDER BY name ASC";

    #buat pesan
    $pesan = "Hasil pencarian untuk nama <b>\"$nama\"</b> : ";
} else {
    $query = "SELECT*FROM master ORDER BY name ASC";
}
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
        <h2>Data Base Handphone</h2>
        <?php
        if (isset($pesan)) {
            echo "<div class=\"pesan\">$pesan</div>";
        }
        ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Merek</th>
                <th>Tipe</th>
                <th>OS</th>
                <th>Tanggal Produksi</th>
                <th>Kode</th>
                <th>Kode Produksi</th>
                <th>Email</th>
            </tr>

            <?php
            $result = mysqli_query($link, $query);
            if (!$result) {
                die("query eror:" . mysqli_errno($link) . "-" . mysqli_error($link));
            }

            while ($data = mysqli_fetch_assoc($result)) {
                $tanggal_php = strtotime($data["tanggal_produksi"]);
                $tanggal = date("d-m-Y", $tanggal_php);

                echo "<tr>";
                echo "<td>$data[id_hp]</td>";
                echo "<td>$data[merek_hp]</td>";
                echo "<td>$data[tipe_hp]</td>";
                echo "<td>$data[os_hp]</td>";
                echo "<td>$tanggal</td>";
                echo "<td>$data[kode_hp]</td>";
                echo "<td>$data[kode_produksi]</td>";
                echo "<td>$data[email]</td>";
                echo "</tr>";
            }

            mysqli_free_result($result);

            mysqli_close($link);
            ?>
        </table>
        <div id="footer">Copyright <?php echo date("Y"); ?>HAPE</div>
    </div>
</body>

</html>