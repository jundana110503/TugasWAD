<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand {
            color: #ffffff;
        }

        .table {
            background-color: #ffffff;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .table-primary {
            background-color: #007bff;
            color: #ffffff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert-danger {
            background-color: #dc3545;
            color: #ffffff;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #a52d38;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-warning:hover {
            background-color: #d39e00;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark">
        <span class="navbar-brand mb-0 h1">Selamat Datang Di Pendaftaran Tournamen Mini Soccer Antar SMA/SMK</span>
    </nav>
    <div class="container">
        <h4 class="text-center mt-4">DAFTAR TEAM TOURNAMEN MINI SOCCER</h4>
        <?php
        include "koneksi.php";

        if (isset($_GET['id_peserta'])) {
            $id_peserta = htmlspecialchars($_GET["id_peserta"]);
            $sql = "delete from peserta where id_peserta='$id_peserta'";
            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location:index.php");
            } else {
                echo "<div class='alert alert-danger'>Data Gagal dihapus.</div>";
            }
        }
        ?>

        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Squad</th>
                        <th>Sekolah</th>
                        <th>Jurusan</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <th colspan='2'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "koneksi.php";
                    $sql = "select * from peserta order by id_peserta desc";
                    $hasil = mysqli_query($kon, $sql);
                    $no = 0;
                    while ($data = mysqli_fetch_array($hasil)) {
                        $no++;
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data["nama_squad"]; ?></td>
                            <td><?php echo $data["sekolah"]; ?></td>
                            <td><?php echo $data["jurusan"]; ?></td>
                            <td><?php echo $data["no_hp"]; ?></td>
                            <td><?php echo $data["alamat"]; ?></td>
                            <td>
                                <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>"
                                    class="btn btn-warning" role="button">Update</a>
                                <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id_peserta=<?php echo $data['id_peserta']; ?>"
                                    class="btn btn-danger" role="button">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a href="create.php" class="btn btn-primary" role="button">Add Data</a>
    </div>
</body>

</html>
