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

   $statisticdata = $db->get("SELECT game_tbl.nama as game, MIN(user_game_data_tbl.score) as min, MAX(user_game_data_tbl.score) as max,

                               AVG(user_game_data_tbl.score) as avg FROM user_game_data_tbl, game_tbl

                               WHERE user_game_data_tbl.game_id = game_tbl.game_id AND user_game_data_tbl.nik = '".$nik."' group by user_game_data_tbl.game_id");   

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


<title>Statistics - Game Data</title>
<link rel="stylesheet" href="../style.css">

<h1 class="title">STATISTIC PAGE</h1>
<h6 class="userinfo">Welcome <?php echo $nik ?></h6>

<table class="nav">
    <tr>
        <th><a href="http://localhost/course_backend/user/">HOME</a></th>
        <th><a href="http://localhost/course_backend/user/games.php">GAMES</a></th>
        <th class="active"><a href="http://localhost/course_backend/user/statistik.php">STATISTIC</a></th>       
        <th><a href="http://localhost/course_backend/user/leaderboard.php">LEADERBOARD</a></th>
        <th><a href="http://localhost/course_backend/user/logout.php">LOGOUT</a></th>
    </tr>
</table>

<table class="content" border=1>
    <tr><td class="title" align="center" colspan=4>USER STATISTIK SKOR GAME</td></tr>
    <tr><td>GAME</td><td>MIN</td><td>MAX</td><td>AVG</td></tr>
    <?php
        while($row = mysqli_fetch_assoc($statisticdata))
        {
    ?>
        <tr>
            <td><?php echo $row['game']?></td>
            <td class="numeric-cell"><?php echo $row['min']?></td>
            <td class="numeric-cell"><?php echo $row['max']?></td>
            <td class="numeric-cell"><?php echo $row['avg']?></td>               
        </tr>

        <?php

        }
   ?>
</table>