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

    $games = $db->get("SELECT * FROM game_tbl");               

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

// game_tbl Process //

$outputTitle = "";
$outputText = "";

$opt = $_POST['opt'];

switch ($opt) {
    
    case 0 : // Create or Add a Game

        $nama = $_POST['nama'];
        $jumlah_level = $_POST['jumlah_level'];
        $tipe_leaderboard = $_POST['tipe_leaderboard'];
        $status = $_POST['status'];

        $result = $db->execute("INSERT INTO game_tbl 
            VALUES (NULL, '$nama', $jumlah_level, $tipe_leaderboard, $status);    
        ");

        if ($result)
        {
            $outputTitle = "Daftar Game Berhasil!";
            $outputText = "Game <span class='bold'>".$nama."</span> berhasil di tambah ke dalam database";
        }
        else
        {
            $outputTitle = "Daftar Game Gagal!";
            $outputText = "Silakan submit ulang data game, pastikan sudah sesuai dan benar!";
        }
        break;

    case 2 : // Edit game    

        $game_id = $_POST['game_id'];
        $nama = $_POST['nama'];
        $jumlah_level = $_POST['jumlah_level'];
        $tipe_leaderboard = $_POST['tipe_leaderboard'];
        $status = $_POST['status'];

        $result = $db->execute("UPDATE game_tbl SET 
            nama = '$nama',
            jumlah_level = $jumlah_level,
            tipe_leaderboard = $tipe_leaderboard,
            status = $status
            WHERE game_id = $game_id;  
        ");

        if ($result)
        {
            $outputTitle = "Update Data Game Berhasil!";
            $outputText = "Game <span class='bold'>".$nama."</span> berhasil diperbarui";
        }
        else
        {
            $outputTitle = "Update Data Game Gagal!";
            $outputText = "Silakan submit ulang data game, pastikan sudah sesuai dan benar!";
        }

        break;
    
    case 3 : // Delete a Game

        $game_id = $_POST['game_id'];

        $nama = $_POST['nama'];

        $result = $db->execute("DELETE FROM game_tbl WHERE game_id = $game_id");

        if ($result)
        {
            $outputTitle = "Penghapusan Game Berhasil!";
            $outputText = "Game <span class='bold'>".$nama."</span> berhasil dihapus";
        }
        else
        {
            $outputTitle = "Penghapusan Game Gagal!";
            $outputText = "Error unknown";
        }

        break;
}


?>


<title>Games - Game Data</title>
<link rel="stylesheet" href="../style.css">

<h1 class="title">GAMES PAGE</h1>
<h6 class="userinfo">Welcome <?php echo $nik ?></h6>


<table class="nav">
    <tr>
        <th><a href="http://localhost/course_backend/user/">HOME</a></th>
        <th class="active"><a href="http://localhost/course_backend/user/games.php">GAMES</a></th>
        <th><a href="http://localhost/course_backend/user/statistik.php">STATISTIK</a></th>       
        <th><a href="http://localhost/course_backend/user/leaderboard.php">LEADERBOARD</a></th>
        <th class="logout"><a href="http://localhost/course_backend/user/logout.php">LOGOUT</a></th>
    </tr>
</table>




<p class="message-title"> <?php echo $outputTitle ?> </p>
<p class="message-content"> <?php echo $outputText ?> </p>
<a class="btn" href="games.php" style="display :inline-block; padding: 20px 40px; margin: 100px 46% 0; ">Back</a>