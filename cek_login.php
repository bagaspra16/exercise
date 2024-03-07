<?php
session_start();

include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $connection->prepare("SELECT * FROM `users` WHERE `username`=? AND `password`=?");
$stmt->bind_param("ss", $username, $password);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $_SESSION['id_user'] = $row['id_users'];
    $_SESSION['logged_in'] = true; 
    if ($row['id_users'] == 1) {
        header("Location: dashboard_admin.php");
    } elseif ($row['id_users'] == 2) {
        header("Location: dashboard_guru.php");
    } else {
        
        echo "Peran pengguna tidak valid.";
    }
} else {
    
    echo "<script>
            alert('Username/Password yang anda masukan salah!');
            document.location='index.html';
          </script>";
}

$stmt->close();
$connection->close();
?>
