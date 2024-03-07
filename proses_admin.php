<?php

include "koneksi.php";

if (isset($_POST['bsimpan'])){

    $simpan = mysqli_query($connection,"INSERT INTO siswa(nis, nama, tempat_lahir, tgl_lahir,jenis_kelamin, agama, alamat)
                                        VALUES ('$_POST[nis]',
                                                '$_POST[nama]',
                                                '$_POST[tempat_lahir]',
                                                '$_POST[tgl_lahir]',
                                                '$_POST[jenis_kelamin]',
                                                '$_POST[agama]',
                                                '$_POST[alamat]') ");
    if($simpan){
        echo "<script>
                    alert('Simpan data berhasil!');
                    document.location='dashboard_admin.php';
                    </script>";
    }  else{
        echo "<script>
                    alert('Simpan data gagal!');
                    document.location='dashboard_admin.php';
                </script>";
    }                                          
}

if (isset($_POST['bedit'])){

    $edit = mysqli_query($connection,"UPDATE siswa SET 
                                                    nis = '$_POST[nis]',
                                                    nama = '$_POST[nama]',
                                                    tempat_lahir = '$_POST[tempat_lahir]',
                                                    tgl_lahir = '$_POST[tgl_lahir]',
                                                    jenis_kelamin = '$_POST[jenis_kelamin]',
                                                    agama = '$_POST[agama]',
                                                    alamat = '$_POST[alamat]'
                                                WHERE id_siswa = '$_POST[id_siswa]'
                                                ");
    if($edit){
        echo "<script>
                    alert('Edit data berhasil!');
                    document.location='dashboard_admin.php';
                    </script>";
    }  else{
        echo "<script>
                    alert('Edit data gagal!');
                    document.location='dashboard_admin.php';
                </script>";
    }                                          
}

if (isset($_POST['bsimpanGuru'])){

    $simpanGuru = mysqli_query($connection,"INSERT INTO guru(nip, nama, tempat_lahir, tgl_lahir,jenis_kelamin, agama, mapel, alamat)
                                        VALUES ('$_POST[nip]',
                                                '$_POST[nama]',
                                                '$_POST[tempat_lahir]',
                                                '$_POST[tgl_lahir]',
                                                '$_POST[jenis_kelamin]',
                                                '$_POST[agama]',
                                                '$_POST[mapel]',
                                                '$_POST[alamat]') ");
    if($simpanGuru){
        echo "<script>
                    alert('Simpan data berhasil!');
                    document.location='dashboard_admin.php';
                    </script>";
    }  else{
        echo "<script>
                    alert('Simpan data gagal!');
                    document.location='dashboard_admin.php';
                </script>";
    }                                          
}

if (isset($_POST['beditGuru'])){

    $editGuru = mysqli_query($connection,"UPDATE guru SET 
                                                    nip = '$_POST[nip]',
                                                    nama = '$_POST[nama]',
                                                    tempat_lahir = '$_POST[tempat_lahir]',
                                                    tgl_lahir = '$_POST[tgl_lahir]',
                                                    jenis_kelamin = '$_POST[jenis_kelamin]',
                                                    agama = '$_POST[agama]',
                                                    mapel = '$_POST[mapel]',
                                                    alamat = '$_POST[alamat]'
                                                WHERE id_guru = '$_POST[id_guru]'
                                                ");
    if($editGuru){
        echo "<script>
                    alert('Edit data berhasil!');
                    document.location='dashboard_admin.php';
                    </script>";
    }  else{
        echo "<script>
                    alert('Edit data gagal!');
                    document.location='dashboard_admin.php';
                </script>";
    }                                          
}

?>