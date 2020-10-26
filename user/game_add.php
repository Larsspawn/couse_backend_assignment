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

<form action="game_process.php" method="POST">
<table class="content" border=1>
    
    <tr><td class="title" align="center">Attribute</td><td class="title" align="center">Value</td></tr>
    <tr><td>Nama</td><td><input type="text" name="nama" placeholder="Nama Game" required></td></tr>
    <tr><td>Jumlah Level</td><td><input type="number" name="jumlah_level" placeholder="10" required></td></tr>
    <tr><td>Tipe leaderboard</td><td><input type="number" name="tipe_leaderboard" placeholder="1" required></td></tr>
    <tr><td>Status</td><td><input type="number" name="status" placeholder="1" required></td></tr>

    <tr><td colspan=5></td></tr>

    <input type="hidden" name="opt" value="0"/>

    <tr>
        <td class="btn-cell" colspan=5>
            <button class="btn w-100" type="submit">Add</button>
        </td>
    </tr>

    <tr><td colspan=5></td></tr>

    <tr>
        <td class="btn-cell" colspan=5>
            <a class="btn w-100" href="games.php">Cancel</button>
        </td>
    </tr>
</table>
</form>