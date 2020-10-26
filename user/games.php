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

<table class="content" border=1 >
    <tr>
        <td class="btn-cell" colspan=6>
            <a class="btn w-100" href="game_add.php">+ Add Game</button>
        </td>
    </tr>

    <tr><td colspan=6></td></tr>
    
    <tr><td align="center" colspan=6 class="title">DAFTAR GAME</td></tr>
    <tr><td>ID</td><td>Nama</td><td>Jumlah Level</td><td>Tipe Leaderboard</td><td>Status</td><td>option</td></tr>
    <?php
        while($row = mysqli_fetch_assoc($games))
        {
    ?>
        <tr>
            <td class="numeric-cell"><?php echo $row['game_id']?></td>
            <td><?php echo $row['nama']?></td>
            <td class="numeric-cell"><?php echo $row['jumlah_level']?></td>
            <td class="numeric-cell"><?php echo $row['tipe_leaderboard']?></td>
            <td class="numeric-cell"><?php echo $row['status']?></td>     
            <td>
                <form action="game_edit.php" method="POST">
                    <input type="hidden" name="game_id" value="<?php echo $row['game_id']?>"/>
                    <button type="submit">Edit</button>
                </form>
                <form action="game_deletion.php" method="POST">
                    <input type="hidden" name="nama" value="<?php echo $row['nama'] ?>">
                    <input type="hidden" name="game_id" value="<?php echo $row['game_id']?>"/>
                    <button type="submit">Delete</button>
                </form>
            </td>          
        </tr>

        <?php

        }
   ?>

</table>