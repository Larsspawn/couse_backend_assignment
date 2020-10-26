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


// user_game_data_tbl Process //

$outputTitle = "";
$outputText = "";

$opt = $_POST['opt'];

switch ($opt) {
    
    case 0 : // Create or Add a user game data

        $game_id = $_POST['game_id'];
        $level = $_POST['level'];
        $score = $_POST['score'];

        $maxlevel = $db->get("SELECT jumlah_level FROM game_tbl WHERE game_id = $game_id; ");
        $maxlevel = mysqli_fetch_assoc($maxlevel);

        $result = "";

        if ($level > 0 && $level <= $maxlevel['jumlah_level'])
        {
            $result = $db->execute("INSERT INTO user_game_data_tbl 
                VALUES (NULL, '$nik', $game_id, $level, $score, 1);    
            ");
        }
        
        if ($result)
        {
            $outputTitle = "Score Berhasil disubmit!";
            $outputText = "Silakan cek score anda di Leaderboard";
        }
        else
        {
            if ($level <= 0 || $level > $maxlevel['jumlah_level'])
            {
                $outputTitle = "Gagal Submit Score :(";
                $outputText = "Level yang anda masukkan tidak sesuai, pastikan lebih dari 0 dan tidak melebihi jumlah level maksimal pada game yang dipilih";
            }
            else
            {
                $outputTitle = "Gagal Submit Score :(";
                $outputText = "Silakan submit ulang score, jika masih bermasalah hubungilah admin (admin@agate.id)!";
            }
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
<a class="btn" href="leaderboard.php" style="display :inline-block; padding: 20px 40px; margin: 100px 46% 0; ">Back</a>
