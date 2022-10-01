<?php

#ambil pesan jika ada
if (isset($_GET["pesan"])) {
    $pesan = $_GET["pesan"];
}

#cek form
if (isset($_POST["submit"])) {
    #form telah di submit

    #ambil nilai form
    $username = htmlentities(strip_tags(trim($_POST["username"])));
    $password = htmlentities(strip_tags(trim($_POST["password"])));

    #variabel pesan eror
    $pesaneror = "";

    #cek username
    if (empty($username)) {
        $pesaneror .= "username belum diisi<br>";
    }

    #cek pass
    if (empty($password)) {
        $pesaneror .= "password belum diisi<br>";
    }

    #koneksi ke mysql
    include("koneksi.php");

    #filter
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);

    #generate hasing
    $password_sha1 = ($password);

    #cek username dan pass ada di tabel admin atau tidak
    $query = "SELECT*FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 0) {

        #data tidak ditemukan
        $pesaneror .= "username dan atau password tidak sesuai";
    }
    mysqli_free_result($result);
    mysqli_close($link);
    if ($pesaneror == "") {
        session_start();
        $_SESSION["nama"] = $username;
        header("Location:beranda.php");
    }
} else {
    $pesaneror = "";
    $username = "";
    $password = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data base Handphone</title>
    <style>
        .error {
            background-color: greenyellow;
            padding: 10px 15px;
            margin: 0 0 20px 0;
            border: 1px;
        }
    </style>
</head>

<body>
    <div class="form">
        <?php
        if (isset($pesan)) {
            echo "<div class=\"pesan\">$pesan</div>";
        }
        if ($pesaneror !== "") {
            echo "<div class=\"error\">$pesaneror</div>";
        }
        ?>
        <form action="login.php" method="post">
            <fieldset>
                <legend>Login</legend>
                <p>
                    <label for="username">Username : </label>
                    <input type="text" name="username" id="username" value="<?php echo $username ?>">
                </p>
                <p>
                    <label for="password">Password : </label>
                    <input type="password" name="password" id="password" value="<?php echo $password ?>">
                </p>
                <p>
                    <input type="submit" name="submit" value="Log In">
                </p>
            </fieldset>
        </form>
    </div>
</body>

</html>