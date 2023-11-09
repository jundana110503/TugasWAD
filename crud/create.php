<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Vaksinasi Covid</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama=input($_POST["Nama"]);
        $status=input($_POST["Status_Pekerjaan"]);
        $gender=input($_POST["Jenis_Kelamin"]);
        $notelp=input($_POST["No_Telepon"]);
        $alamat=input($_POST["Alamat"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into pendaftaran (Nama,Status_Pekerjaan,Jenis_Kelamin,No_Telepon,Alamat) values
		('$nama','$status','$gender','$notelp','$alamat')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal Disimpan.</div>";

        }

    }
    ?>
    <h2>Input Data</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="Nama" class="form-control" placeholder="Masukan Nama" required />

        </div>
        <div class="form-group">
            <label>Status Pekerjaan:</label>
            <input type="text" name="Status_Pekerjaan" class="form-control" placeholder="Masukan Status Pekerjaan" required/>
        </div>
       <div class="form-group">
            <label>Jenis Kelamin :</label>
            <input type="text" name="Jenis_Kelamin" class="form-control" placeholder="Masukan Jenis Kelamin" required/>
        </div>
                </p>
        <div class="form-group">
            <label>No Telepon:</label>
            <input type="text" name="No_Telepon" class="form-control" placeholder="Masukan No Telepon" required/>
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="Alamat" class="form-control" rows="5"placeholder="Masukan Alamat" required></textarea>
        </div>       

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>