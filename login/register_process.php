<?php

SESSION_START();

include("../database.php"); 

$db = new Database(); 

$nik = $_POST['nik'];

$nama_depan = $_POST['nama_depan'];

$nama_belakang = $_POST['nama_belakang'];

$nomor_handphone = $_POST['nomor_handphone'];

$tanggal_lahir = $_POST['tanggal_lahir'];

$tempat_lahir = $_POST['tempat_lahir'];

$email = $_POST['email'];

$alamat = $_POST['alamat'];

$kode_pos = $_POST['kode_pos'];

$kota_id = $_POST['kota_id'];

$token = "";

$status = 1;

$password = md5($_POST['password']);

$password2 = md5($_POST['password2']);   

if($password == $password2)
{

    if($nik && $nama_depan && $nama_belakang && $nomor_handphone && $tanggal_lahir && $tempat_lahir && $email && $alamat && $kode_pos && $kota_id)
    {
        $result = $db->execute("INSERT INTO user_tbl(
            nik,
            nama_depan,
            nama_belakang,
            nomor_handphone,
            tanggal_lahir,
            tempat_lahir,
            email,
            alamat,
            kode_pos,
            kota_id,
            token,
            status,
            password
        ) VALUES(
            '".$nik."',
            '".$nama_depan."',
            '".$nama_belakang."',
            '".$nomor_handphone."',
            '".$tanggal_lahir."',
            '".$tempat_lahir."',
            '".$email."',
            '".$alamat."',
            ".$kode_pos.",
            ".$kota_id.",
            '".$token."',
            ".$status.",
            '".$password."'
        )");

        if($result){ $_SESSION["notification"] = "Register User Berhasil"; }

        else { $_SESSION["notification"] = "Register User Gagal"; }

    }
}

header("Location: http://localhost/course_backend/");   

?>