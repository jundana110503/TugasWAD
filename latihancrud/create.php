<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Lobmba</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        /* Custom CSS for form layout */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    include "koneksi.php";

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_squad = input($_POST["nama_squad"]);
        $sekolah = input($_POST["sekolah"]);
        $jurusan = input($_POST["jurusan"]);
        $no_hp = input($_POST["no_hp"]);
        $alamat = input($_POST["alamat"]);

        $sql = "INSERT INTO peserta (nama_squad, sekolah, jurusan, no_hp, alamat) VALUES
        ('$nama_squad', '$sekolah', '$jurusan', '$no_hp', '$alamat')";

        $hasil = mysqli_query($kon, $sql);

        if ($hasil) {
            header("Location: index.php");
        } else {
            echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2 class="text-center">Masukkan Data</h2>

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama Squad:</label>
            <input type="text" name="nama_squad" class="form-control"  required />
        </div>
        <div class="form-group">
            <label>Sekolah:</label>
            <input type="text" name="sekolah" class="form-control"  required/>
        </div>
        <div class="form-group">
            <label>Jurusan:</label>
            <input type="text" name="jurusan" class="form-control"  required/>
        </div>
        <div class="form-group">
            <label>No HP:</label>
            <input type="text" name="no_hp" class="form-control"  required/>
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="alamat" class="form-control" rows="5"  required></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary btn-block">kirim</button>
    </form>
</div>
</body>
</html>
