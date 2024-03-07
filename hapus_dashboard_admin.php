<?php 
include 'koneksi.php';
$id_siswa = $_GET['id_siswa'];
$hapus = mysqli_query($connection,"DELETE FROM siswa WHERE id_siswa='$id_siswa'");
if($hapus){
    echo "<script>
                alert('Hapus data berhasil!');
                document.location='dashboard_admin.php';
                </script>";
}  else{
    echo "<script>
                alert('Hapus data gagal!');
                document.location='dashboard_admin.php';
            </script>";

}

$id_guru = $_GET['id_guru'];
$hapusGuru = mysqli_query($connection,"DELETE FROM guru WHERE id_guru='$id_guru'");
if($hapusGuru){
    echo "<script>
                alert('Hapus data berhasil!');
                document.location='dashboard_admin.php';
                </script>";
}  else{
    echo "<script>
                alert('Hapus data gagal!');
                document.location='dashboard_admin.php';
            </script>";

}
?>