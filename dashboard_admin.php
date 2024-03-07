<?php
session_start();
include "koneksi.php";

// Periksa apakah pengguna telah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>
            alert('Anda belum melakukan login user!');
            document.location='index.html';
          </script>";
}
// Periksa apakah pengguna memiliki hak akses ke halaman ini berdasarkan peran
if ($_SESSION['id_user'] == 1) {
    echo "<script>
            alert('Login Admin Berhasil!');
          </script>";
} elseif ($_SESSION['id_user'] == 2) {
    echo "<script>
            alert('Login Guru Berhasil!');
          </script>";
} else {
    // Jika peran pengguna tidak dikenali, arahkan ke halaman lain atau berikan pesan kesalahan
    echo "<script>
            alert('Username/Password yang anda masukan salah!');
          </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sistem Informasi RPL - Dashboard Admin</title>
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
                <li class="nav-item"><a class="nav-link text-muted" href="">User : Admin</a></li>
                <li class="nav-item"><a class="nav-link btn btn-outline-danger" href="index.html" style="width: fit-content;" data-bs-toggle="modal" data-bs-target="#modalLogout">Logout</a></li>        
            </ul>
        </div>
    </nav>

    <div class="container px-4 px-lg-5">
        <div class="card my-3">
            <div class="card-header text-dark">
                <h1 style="font-weight:bolder;">Dashboard Data Siswa</h1>
            </div>
            <div class="card-body">

            <div class="row gx-0 gx-lg-1">
                <div class="col-lg-1">
                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah" style="width:140%">
                + Data Siswa</button>
                </div>
                <div class="col-lg-3 ms-5">
                <a href="pdf_siswa.php" class="btn btn-danger mb-3" style="width:60%">Generate Laporan</a>
                </div>
                </div>

                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th>NO</th>
                        <th>NIS</th>
                        <th>NAMA</th>
                        <th>TEMPAT LAHIR</th>
                        <th>TANGGAL LAHIR</th>
                        <th>JENIS KELAMIN</th>
                        <th>AGAMA</th>
                        <th>ALAMAT</th>
                        <th>EDIT</th>
                        <th>HAPUS</th>
                    </tr>
                    <?php        
                        $no = 1;
                        $tampil = mysqli_query($connection,"SELECT * FROM siswa ORDER BY id_siswa DESC");
                        while($data = mysqli_fetch_array($tampil)) :
                        ?>
                    <tr>
                        <td><?= $no++ ?>.</td>
                        <td><?= $data['nis']?></td>
                        <td><?= $data['nama']?></td>
                        <td><?= $data['tempat_lahir']?></td>
                        <td><?= $data['tgl_lahir']?></td>
                        <td><?= $data['jenis_kelamin']?></td>
                        <td><?= $data['agama']?></td>
                        <td><?= $data['alamat']?></td>
                        <td>
                            <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $no ?>">Ubah</a>
                        </td>
                        <td>
                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>">Hapus</a>
                        </td>
                    </tr>

        <div class="modal fade" id="modalEdit<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria_labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="proses_admin.php" method="post">
                    <input type="hidden" class="form-control" name="id_siswa" value="<?= $data['id_siswa'] ?>">
                        <div class="row">

                        <div class="col">
                        <div class="mb-3">
                            <label for="Lnis" class="form-label">NIS</label>
                            <input type="number" class="form-control" name="nis" value="<?= $data['nis'] ?>" id="Lnis" placeholder="Masukan NIS Siswa" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="Lnama" class="form-label">NAMA</label>
                            <input type="text" class="form-control" name="nama" id="Lnama" value="<?= $data['nama'] ?>" placeholder="Masukan Nama Siswa" autocomplete="off">
                        </div>
                        <label for="LtempatLahir" class="form-label">TEMPAT LAHIR</label>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="tempat_lahir" id="LtempatLahir" value="<?= $data['tempat_lahir'] ?>" placeholder="Masukan Tempat Lahir" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="LtglLahir" class="form-label">TANGGAL LAHIR</label>
                            <input type="date" class="form-control" name="tgl_lahir" id="LtglLahir"  value="<?= date('y-m-d', strtotime($data['tgl_lahir'])) ?>" autocomplete="off">
                        </div>
                        </div>

                        <div class="col">
                        <div class="mb-3">
                            <label for="Ljk" class="form-label">JENIS KELAMIN</label>
                            <select name="jenis_kelamin" class="form-select" id="Ljk" placeholder="Pilih Jenis Kelamin" autocomplete="off">
                                <option selected value="<?= $data['jenis_kelamin'] ?>"><?= $data['jenis_kelamin'] ?></option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Lagama" class="form-label">AGAMA</label>
                            <select name="agama" id="Lagama" class="form-select" placeholder="Pilih Agama Siswa" autocomplete="off">
                                <option selected value="<?= $data['agama'] ?>"><?= $data['agama'] ?></option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen Katolik">Kristen Katolik</option>
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Kong Hu Chu">Kong Hu Chu</option>
                            </select>
                        </div>
                        
                        <label for="Lalamat" class="form-label">ALAMAT</label>
                        <div class="mb-3">
                            <textarea type="text" class="form-control" name="alamat" id="Lalamat" placeholder="Masukan Alamat Siswa" autocomplete="off"><?= $data['alamat'] ?></textarea>
                        </div>
                        </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="bedit">Ubah Data</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
        </div>

        <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria_labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="proses_admin.php" method="post">
                    <input type="hidden" class="form-control" name="id_siswa" value="<?= $data['id_siswa'] ?>">
                    <h4 class="text-center">Yakin Ingin Menghapus Data Ini?</h4>
                    <br>
                    <h5 class="text-center text-danger"><?= $data['nis'] ?> - <?= $data['nama'] ?></h5>
                </div>
                <div class="modal-footer">
                    <a href="hapus_dashboard_admin.php?id_siswa=<?php echo $data['id_siswa']; ?>" class="btn btn-primary">Hapus Data</a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
        </div>

                    <?php endwhile; ?>
                </table>
            </div>
        </div>


    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria_labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="proses_admin.php" method="post">
                        <div class="row">

                        <div class="col">
                        <div class="mb-3">
                            <label for="Lnis" class="form-label">NIS</label>
                            <input type="number" class="form-control" name="nis" id="Lnis" placeholder="Masukan NIS Siswa" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="Lnama" class="form-label">NAMA</label>
                            <input type="text" class="form-control" name="nama" id="Lnama" placeholder="Masukan Nama Siswa" autocomplete="off">
                        </div>
                        <label for="LtempatLahir" class="form-label">TEMPAT LAHIR</label>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="tempat_lahir" id="LtempatLahir" placeholder="Masukan Tempat Lahir" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="LtglLahir" class="form-label">TANGGAL LAHIR</label>
                            <input type="date" class="form-control" name="tgl_lahir" id="LtglLahir" autocomplete="off">
                        </div>
                        </div>

                        <div class="col">
                        <div class="mb-3">
                            <label for="Ljk" class="form-label">JENIS KELAMIN</label>
                            <select name="jenis_kelamin" class="form-select" id="Ljk" placeholder="Pilih Jenis Kelamin" autocomplete="off">
                                <option disabled selected value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Lagama" class="form-label">AGAMA</label>
                            <select name="agama" id="Lagama" class="form-select" placeholder="Pilih Agama Siswa" autocomplete="off">
                                <option disabled selected value="">Pilih Agama Siswa</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen Katolik">Kristen Katolik</option>
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Kong Hu Chu">Kong Hu Chu</option>
                            </select>
                        </div>
                        
                        <label for="Lalamat" class="form-label">ALAMAT</label>
                        <div class="mb-3">
                            <textarea type="text" class="form-control" name="alamat" id="Lalamat" placeholder="Masukan Alamat Siswa" autocomplete="off"></textarea>
                        </div>
                        </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="bsimpan">Simpan Data</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!------------------------------------------------------------------CRUD GURU--------------------------------------------------------->

    <div class="card my-3">
            <div class="card-header text-dark">
                <h1 style="font-weight:bolder;">Dashboard Data Guru</h1>
            </div>
            <div class="card-body">

            <div class="row gx-0 gx-lg-1">
                <div class="col-lg-1">
                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahGuru" style="width:120%">
                + Data Guru</button>
                </div>
                <div class="col-lg-3 ms-4">
                <a href="pdf_guru.php" class="btn btn-danger mb-3" style="width:60%">Generate Laporan</a>
                </div>
                </div>

                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th>NO</th>
                        <th>NIP</th>
                        <th>NAMA</th>
                        <th>TEMPAT LAHIR</th>
                        <th>TANGGAL LAHIR</th>
                        <th>JENIS KELAMIN</th>
                        <th>AGAMA</th>
                        <th>MATA PELAJARAN</th>
                        <th>ALAMAT</th>
                        <th>EDIT</th>
                        <th>HAPUS</th>
                    </tr>
                    <?php        
                        $number = 1;
                        $tampilGuru = mysqli_query($connection,"SELECT * FROM guru ORDER BY id_guru DESC");
                        while($dataGuru = mysqli_fetch_array($tampilGuru)) :
                        ?>
                    <tr>
                        <td><?= $number++ ?>.</td>
                        <td><?= $dataGuru['nip']?></td>
                        <td><?= $dataGuru['nama']?></td>
                        <td><?= $dataGuru['tempat_lahir']?></td>
                        <td><?= $dataGuru['tgl_lahir']?></td>
                        <td><?= $dataGuru['jenis_kelamin']?></td>
                        <td><?= $dataGuru['agama']?></td>
                        <td><?= $dataGuru['mapel']?></td>
                        <td><?= $dataGuru['alamat']?></td>
                        <td>
                            <a class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#modalEditGuru<?= $number ?>">Ubah</a>
                        </td>
                        <td>
                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapusGuru<?= $number ?>">Hapus</a>
                        </td>
                    </tr>

        <div class="modal fade" id="modalEditGuru<?= $number ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria_labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data Guru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="proses_admin.php" method="post">
                    <input type="hidden" class="form-control" name="id_guru" value="<?= $data['id_guru'] ?>">
                        <div class="row">

                        <div class="col">
                        <div class="mb-3">
                            <label for="Lnip" class="form-label">NIP</label>
                            <input type="number" class="form-control" name="nip" value="<?= $dataGuru['nip'] ?>" id="Lnip" placeholder="Masukan NIP Guru" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="Lnama" class="form-label">NAMA</label>
                            <input type="text" class="form-control" name="nama" id="Lnama" value="<?= $dataGuru['nama'] ?>" placeholder="Masukan Nama Guru" autocomplete="off">
                        </div>
                        <label for="LtempatLahir" class="form-label">TEMPAT LAHIR</label>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="tempat_lahir" id="LtempatLahir" value="<?= $dataGuru['tempat_lahir'] ?>" placeholder="Masukan Tempat Lahir" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="LtglLahir" class="form-label">TANGGAL LAHIR</label>
                            <input type="date" class="form-control" name="tgl_lahir" id="LtglLahir"  value="<?= date('y-m-d', strtotime($dataGuru['tgl_lahir'])) ?>" autocomplete="off">
                        </div>
                        </div>

                        <div class="col">
                        <div class="mb-3">
                            <label for="Ljk" class="form-label">JENIS KELAMIN</label>
                            <select name="jenis_kelamin" class="form-select" id="Ljk" placeholder="Pilih Jenis Kelamin" autocomplete="off">
                                <option selected value="<?= $dataGuru['jenis_kelamin'] ?>"><?= $dataGuru['jenis_kelamin'] ?></option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Lagama" class="form-label">AGAMA</label>
                            <select name="agama" id="Lagama" class="form-select" placeholder="Pilih Agama Guru" autocomplete="off">
                                <option selected value="<?= $dataGuru['agama'] ?>"><?= $dataGuru['agama'] ?></option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen Katolik">Kristen Katolik</option>
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Kong Hu Chu">Kong Hu Chu</option>
                            </select>
                        </div>

                        <div class="mb-3">
                              <label for="Lmapel" class="form-label">Mapel</label>
                              <select class="form-select" aria-label="Default select" id="Lmapel" name="mapel">
                              <option selected value="<?= $dataGuru['mapel']?>"><?= $dataGuru['mapel']?></option>
                              <option value="Pemrogaman Dasar">Pemrograman Dasar</option>
                              <option value="Dasar Desain Grafis">Dasar Desain Grafis</option>
                              <option value="Internet Of Things">Internet Of Things</option>
                              <option value="Pendidikan Kewirausahaan">Pendidikan Kewirausahaan</option>
                              <option value="Pemodelan Perangkat Lunak">Pemodelan Perangkat Lunak</option>
                              <option value="Pemrograman Berbasis Objek">Pemrograman Berbasis Objek</option>
                              <option value="Pemrogaman Web">Pemrograman Web</option>
                              <option value="Basis Data">Basis Data</option>
                              </select>
                              </div>
                        
                        <label for="Lalamat" class="form-label">ALAMAT</label>
                        <div class="mb-3">
                            <textarea type="text" class="form-control" name="alamat" id="Lalamat" placeholder="Masukan Alamat Guru" autocomplete="off"><?= $dataGuru['alamat'] ?></textarea>
                        </div>
                        </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="beditGuru">Ubah Data</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
        </div>

        <div class="modal fade" id="modalHapusGuru<?= $number ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria_labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data Guru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="proses_admin.php" method="post">
                    <input type="hidden" class="form-control" name="id_guru" value="<?= $dataGuru['id_guru'] ?>">
                    <h4 class="text-center">Yakin Ingin Menghapus Data Ini?</h4>
                    <br>
                    <h5 class="text-center text-danger"><?= $dataGuru['nip'] ?> - <?= $dataGuru['nama'] ?></h5>
                </div>
                <div class="modal-footer">
                    <a href="hapus_dashboard_admin.php?id_guru=<?php echo $dataGuru['id_guru']; ?>" class="btn btn-primary">Hapus Data</a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
        </div>

                    <?php endwhile; ?>
                </table>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modalTambahGuru" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria_labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Guru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="proses_admin.php" method="post">
                        <div class="row">

                        <div class="col">
                        <div class="mb-3">
                            <label for="Lnip" class="form-label">NIP</label>
                            <input type="number" class="form-control" name="nip" id="Lnip" placeholder="Masukan NIP Guru" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="Lnama" class="form-label">NAMA</label>
                            <input type="text" class="form-control" name="nama" id="Lnama" placeholder="Masukan Nama Guru" autocomplete="off">
                        </div>
                        <label for="LtempatLahir" class="form-label">TEMPAT LAHIR</label>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="tempat_lahir" id="LtempatLahir" placeholder="Masukan Tempat Lahir" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="LtglLahir" class="form-label">TANGGAL LAHIR</label>
                            <input type="date" class="form-control" name="tgl_lahir" id="LtglLahir" autocomplete="off">
                        </div>
                        </div>

                        <div class="col">
                        <div class="mb-3">
                            <label for="Ljk" class="form-label">JENIS KELAMIN</label>
                            <select name="jenis_kelamin" class="form-select" id="Ljk" placeholder="Pilih Jenis Kelamin" autocomplete="off">
                                <option disabled selected value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Lagama" class="form-label">AGAMA</label>
                            <select name="agama" id="Lagama" class="form-select" placeholder="Pilih Agama Siswa" autocomplete="off">
                                <option disabled selected value="">Pilih Agama Guru</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen Katolik">Kristen Katolik</option>
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Kong Hu Chu">Kong Hu Chu</option>
                            </select>
                        </div>

                        <div class="mb-3">
                              <label for="Lmapel" class="form-label">Mapel</label>
                              <select class="form-select" aria-label="Default select" id="Lmapel" name="mapel">
                              <option disabled selected value=""></option>
                              <option value="Pemrogaman Dasar">Pemrograman Dasar</option>
                              <option value="Dasar Desain Grafis">Dasar Desain Grafis</option>
                              <option value="Internet Of Things">Internet Of Things</option>
                              <option value="Pendidikan Kewirausahaan">Pendidikan Kewirausahaan</option>
                              <option value="Pemodelan Perangkat Lunak">Pemodelan Perangkat Lunak</option>
                              <option value="Pemrograman Berbasis Objek">Pemrograman Berbasis Objek</option>
                              <option value="Pemrogaman Web">Pemrograman Web</option>
                              <option value="Basis Data">Basis Data</option>
                              </select>
                        </div>
                        
                        <label for="Lalamat" class="form-label">ALAMAT</label>
                        <div class="mb-3">
                            <textarea type="text" class="form-control" name="alamat" id="Lalamat" placeholder="Masukan Alamat Guru" autocomplete="off"></textarea>
                        </div>
                        </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="bsimpanGuru">Simpan Data</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
                        </div>



    <div class="modal fade" id="modalLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria_labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Peringatan!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="logout.php" method="post">
                    <br>
                    <h5 class="text-center text-danger">Yakin ingin keluar dari halaman dashboard?</h5>
                    <br>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Keluar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>

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