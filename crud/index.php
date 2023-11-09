<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<title>Pendaftaran Vaksinasi</title>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Pendaftaran Vaksinasi Telkom University</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>FORMULIR PENDAFTARAN</center></h4>
        <?php
        include "koneksi.php";

        // Check if there's a "id_perse" parameter in the URL
        if (isset($_GET['id_perse'])) {
            $id_pasien = htmlspecialchars($_GET["id_perse"]); // Correct the parameter name

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Handle the form submission to update patient information
                $nama = htmlspecialchars($_POST['nama']);
                $status_pekerjaan = htmlspecialchars($_POST['status_pekerjaan']);
                $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
                $no_telepon = htmlspecialchars($_POST['no_telepon']);
                $alamat = htmlspecialchars($_POST['alamat']);

                // Update the patient's information in the database
                $sql = "UPDATE pasien SET Nama = '$nama', Status_Pekerjaan = '$status_pekerjaan', Jenis_Kelamin = '$jenis_kelamin', No_Telepon = '$no_telepon', alamat = '$alamat' WHERE id_pasien = $id_pasien";
                $result = mysqli_query($kon, $sql);

                if ($result) {
                    header("Location: index.php"); // Redirect to the list of patients after successful update
                } else {
                    echo "<div class='alert alert-danger'>Data Gagal Diupdate.</div>";
                }
            } else {
                // Fetch the patient's information for editing
                $sql = "SELECT * FROM pasien WHERE id_pasien = $id_pasien";
                $result = mysqli_query($kon, $sql);
                $patientData = mysqli_fetch_assoc($result);
            }
        }
        ?>

        <form method="post" action="">
            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status Pekerjaan</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th colspan='2'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $id_pasien; ?></td>
                        <td><input type="text" name="nama" value="<?php echo $patientData['Nama']; ?>"></td>
                        <td><input type="text" name="status_pekerjaan" value="<?php echo $patientData['Status_Pekerjaan']; ?>"></td>
                        <td><input type="text" name="jenis_kelamin" value="<?php echo $patientData['Jenis_Kelamin']; ?>"></td>
                        <td><input type="text" name="no_telepon" value="<?php echo $patientData['No_Telepon']; ?>"></td>
                        <td><input type="text" name="alamat" value="<?php echo $patientData['alamat']; ?>"></td>
                        <td>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <a href="index.php" class="btn btn-secondary" role="button">Kembali ke Daftar Pasien</a>
    </div>
</body>
</html>

