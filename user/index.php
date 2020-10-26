<?php

SESSION_START();

include("../database.php"); 

$db = new Database(); 

$nik = (isset($_SESSION['nik'])) ? $_SESSION['nik'] : "";

$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $nik)
{

    $result = $db->execute("SELECT * FROM user_tbl WHERE nik = '".$nik."' AND token = '".$token."' AND status = 1 ");

    if(!$result)
    {
        header("Location: http://localhost/course_backend/");
    }

    $userdata = $db->get("SELECT user_tbl.nik as nik, user_tbl.nama_depan as nama_depan, user_tbl.nama_belakang as nama_belakang,

                        user_tbl.alamat as alamat, user_tbl.kode_pos as kode_pos, kota_tbl.nama_kota as nama_kota,

                        provinsi_tbl.nama_provinsi as nama_provinsi

                        from user_tbl,kota_tbl, provinsi_tbl WHERE user_tbl.nik = '".$nik."' AND

                        user_tbl.kota_id = kota_tbl.kota_id AND kota_tbl.provinsi_id = provinsi_tbl.provinsi_id");               

    $userdata = mysqli_fetch_assoc($userdata);                       
}
else
{
   header("Location: http://localhost/course_backend/");
}

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification)
{
   echo $notification;

   unset($_SESSION['notification']);   
}

?>


<title>Home - Game Data</title>
<link rel="stylesheet" href="../style.css">

<h1 class="title">HOME PAGE</h1>
<h6 class="userinfo">Welcome <?php echo $nik ?></h6>

<table class="nav">
   <tr>
       <th class="active"><a href="http://localhost/course_backend/user/">HOME</a></th>
       <th><a href="http://localhost/course_backend/user/games.php">GAMES</a></th>
       <th><a href="http://localhost/course_backend/user/statistik.php">STATISTIK</a></th>       
       <th><a href="http://localhost/course_backend/user/leaderboard.php">LEADERBOARD</a></th>
       <th><a href="http://localhost/course_backend/user/logout.php">LOGOUT</a></th>
   </tr>
</table>

<table class="content" border=1>
   <tr><td class="title" align="center" colspan=5>Profile</td></tr>
   <tr><td>NIK</td><td colspan=4><?php echo $userdata['nik'];?></td></tr>
   <tr><td>Nama</td><td colspan=4><?php echo $userdata['nama_depan']." ".$userdata['nama_belakang'];?></td></tr>
   <tr><td>alamat</td><td colspan=4><?php echo $userdata['alamat'].". Kode Pos: ".$userdata['kode_pos'];?></td></tr>
   <tr><td>Kota</td><td colspan=4><?php echo $userdata['nama_kota'];?></td></tr>   
   <tr><td>Provinsi</td><td colspan=4><?php echo $userdata['nama_provinsi'];?></td></tr>
</table>