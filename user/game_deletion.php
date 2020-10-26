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

$game_id = $_POST['game_id'];
$nama = $_POST['nama'];

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


<p class="message-title"> Anda yakin ingin menghapus <?php echo $nama ?> ?</p>
<p class="message-content"> Anda tidak dapat membatalkan tindakan ini setelah dihapus. </p>

<div class="btn-confirm-container">
    <form action="game_process.php" method="POST">
        <input type="hidden" name="opt" value="3"/>
        <input type="hidden" name="game_id" value="<?php echo $game_id ?>"/>
        <input type="hidden" name="nama" value="<?php echo $nama ?>"/>

        <button class="btn-confirm-yes" type="submit">Yes</button>
    </form>

    <a class="btn-confirm-no" href="games.php">No</a>
</div>
