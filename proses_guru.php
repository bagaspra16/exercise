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
                    document.location='dashboard_guru.php';
                    </script>";
    }  else{
        echo "<script>
                    alert('Simpan data gagal!');
                    document.location='dashboard_guru.php';
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
                    document.location='dashboard_guru.php';
                    </script>";
    }  else{
        echo "<script>
                    alert('Edit data gagal!');
                    document.location='dashboard_guru.php';
                </script>";
    }                                          
}

?>