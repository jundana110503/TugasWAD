<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran</title>
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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_peserta
    if (isset($_GET['id_pasien'])) {
        $id_pasien=input($_GET["id_pasien"]);

        $sql="select * from peserta where id_pasien=$id_pasien";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);


    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_peserta=htmlspecialchars($_POST["id_pasien"]);
        $nama_squad=input($_POST["Nama"]);
        $sekolah=input($_POST["Status_Pekerjaan"]);
        $jurusan=input($_POST["Jenis_Kelamin"]);
        $no_hp=input($_POST["No_Telepon"]);
        $alamat=input($_POST["Alamat"]);

        //Query update data pada tabel anggota
        $sql="update pasien set
			Nama='$nama',
			Status_Pekerjaan='$status',
			Jenis_Kelamin='$gender',
			No_Telepon='$notelp',
			Alamat='$alamat'
			where id_pasien=$id_pasien";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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
        <div class="form-group">
            <label>No Telepon:</label>
            <input type="text" name="No_Telepon" class="form-control" placeholder="Masukan No Telepon" required/><label>No HP:</label>
            
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="Alamat" class="form-control" rows="5"placeholder="Masukan Alamat" required></textarea>
        </div>

        <input type="hidden" name="id_pasien" value="<?php echo $data['id_pasien']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>