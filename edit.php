<?php
include("koneksi.php");
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
        if ((isset($_GET["pesan"]))) {
            echo "<div class=\"pesan\">{$_GET["pesan"]}</div>";
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
            $query = "SELECT*FROM master ORDER BY merek_hp ASC";
            $result = mysqli_query($link, $query);

            if (!$result) {
                die("query eror: " . mysqli_errno($link) . " - " . mysqli_error($link));
            }

            while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>$data[id_hp]</td>";
                echo "<td>$data[merek_hp]</td>";
                echo "<td>$data[tipe_hp]</td>";
                echo "<td>$data[os_hp]</td>";
                echo "<td>$tanggal_produksi</td>";
                echo "<td>$data[kode_hp]</td>";
                echo "<td>$data[kode_produksi]</td>";
                echo "<td>$data[email]</td>";
                echo "</tr>";
            ?>
                <form action="form_edit.php" method="POST">
                    <input type="hidden" name="id_hp" value="<?php echo "$data[id_hp]"; ?>">
                    <input type="submit" name="submit" value="Edit">
                </form>
            <?php
                echo "</td>";
                echo "</tr>";
            }
            mysqli_free_result($result);
            mysqli_close($link);
            ?>
        </table>
        <div id="footer">Copyright © <?php echo date("Y"); ?></div>
    </div>
</body>

</html>