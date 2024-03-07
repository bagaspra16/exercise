<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sistem Informasi RPL - Data Guru</title>
    <link rel="shortcut icon" href="assets/rpl_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body onload="print()">

    <div class="container px-4 px-lg-5">

    <div class="card my-5">
            <div class="card-header text_dark">
                <h1 style="font-weight:bolder;">Data Guru</h1>
            </div>
            <div class="card-body">

                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th>NO</th>
                        <th>NIS</th>
                        <th>NAMA</th>
                        <th>TEMPAT LAHIR</th>
                        <th>TANGGAL LAHIR</th>
                        <th>JENIS KELAMIN</th>
                        <th>AGAMA</th>
                        <th>MAPEL</th>
                        <th>ALAMAT</th>
                    </tr>
                    <?php        
                        $no = 1;
                        $tampil = mysqli_query($connection,"SELECT * FROM guru ORDER BY id_guru DESC");
                        while($data = mysqli_fetch_array($tampil)) :
                        ?>
                    <tr>
                        <td><?= $no++ ?>.</td>
                        <td><?= $data['nip']?></td>
                        <td><?= $data['nama']?></td>
                        <td><?= $data['tempat_lahir']?></td>
                        <td><?= $data['tgl_lahir']?></td>
                        <td><?= $data['jenis_kelamin']?></td>
                        <td><?= $data['agama']?></td>
                        <td><?= $data['mapel']?></td>
                        <td><?= $data['alamat']?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>