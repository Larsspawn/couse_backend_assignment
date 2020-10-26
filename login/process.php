<?php

SESSION_START();

include("../database.php");

$db = new Database();

$nik = $_POST['nik'];

$password = md5($_POST['password']);

$result = $db->get("SELECT nik FROM user_tbl WHERE nik= '".$nik."' AND password='".$password."' ");

if($result)
{
    $_SESSION['notification'] = "Berhasil Login, Selamat Datang";

    $token = md5($nik."coursebackend".date("Y-m-d H:i:s"));

    $db->execute("UPDATE user_tbl SET token = '".$token."' WHERE nik  = '".$nik."'");

    $_SESSION['token'] = $token;

    $_SESSION['nik'] = $nik;

    header("Location: http://localhost/course_backend/user/");
}

$_SESSION['notification'] = "Gagal Login, Coba lagi";

header("Location: http://localhost/course_backend/");

?>