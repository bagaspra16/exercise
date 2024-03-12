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
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color: rgb(0, 0, 53);">
        <img src="assets/rpl_logo.png" alt="" style="width: 6%;">
        <h1><a href="index.html" class="navbar-brand" style="font-size: 70%; font-weight: bolder;">Sistem Informasi RPL</a></h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="nav-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="font-weight: bolder;">
                <li class="nav-item"><a class="nav-link" href="index.html">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="event.html">Event</a></li>
                <li class="nav-item"><a class="nav-link" href="siswa.php">Siswa</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page"  href="guru.php">Guru</a></li>
                <li class="nav-item me-3"><a class="nav-link btn btn-outline-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#modalLogin" style="width: fit-content;">Login</a></li>        
            </ul>
        </div>
    </nav>

    <div class="container px-4 px-lg-5">

    <br>
        <br>
        <br>
        <br>

    <div class="card my-3">
            <div class="card-header text_dark">
                <h1 style="font-weight:bolder;">Data Guru</h1>
            </div>
            <div class="card-body">

                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>TEMPAT LAHIR</th>
                        <th>TANGGAL LAHIR</th>
                        <th>JENIS KELAMIN</th>
                        <th>AGAMA</th>
                        <th>MAPEL</th>
                    </tr>
                    <?php        
                        $no = 1;
                        $tampil = mysqli_query($connection,"SELECT * FROM guru ORDER BY id_guru DESC");
                        while($data = mysqli_fetch_array($tampil)) :
                        ?>
                    <tr>
                        <td><?= $no++ ?>.</td>
                        <td><?= $data['nama']?></td>
                        <td><?= $data['tempat_lahir']?></td>
                        <td><?= $data['tgl_lahir']?></td>
                        <td><?= $data['jenis_kelamin']?></td>
                        <td><?= $data['agama']?></td>
                        <td><?= $data['mapel']?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria_labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Login User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="cek_login.php" method="post">
                        <div class="mb-3">
                            <label for="Lusername" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="Lusername" placeholder="Masukan Username Admin" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="Lpassword" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="Lpassword" placeholder="Masukan Password Admin" autocomplete="off">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Masuk</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>

    <footer class="bg-dark text-center text-white">
        <div class="text-center p-4" style="background-color: rgba(26, 26, 26, 0.527);">
            2024 Copyright : 
            <a class="text-white" href="index.html">Bagas Pratama Junianika</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>