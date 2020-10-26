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


<title>Leaderboards - Game Data</title>
<link rel="stylesheet" href="../style.css">

<h1 class="title">LEADERBOARD PAGE</h1>
<h6 class="userinfo">Welcome <?php echo $nik ?></h6>

<table class="nav">
   <tr>
       <th><a href="http://localhost/course_backend/user/">HOME</a></th>
       <th><a href="http://localhost/course_backend/user/games.php">GAMES</a></th>
       <th><a href="http://localhost/course_backend/user/statistik.php">STATISTIK</a></th>       
       <th class="active"><a href="http://localhost/course_backend/user/leaderboard.php">LEADERBOARD</a></th>
       <th><a href="http://localhost/course_backend/user/logout.php">LOGOUT</a></th>
   </tr>
</table>

<br>

<form action="http://localhost/course_backend/user/leaderboard.php" method='GET'>

    <p class="paragraph">Pilih Game

        <select name="gameid">

            <?php

            $gamedata = $db->get("SELECT game_id,nama FROM game_tbl WHERE status=1");                                

            while($row = mysqli_fetch_assoc($gamedata))

            {

                ?>

                <option value="<?php echo $row['game_id']?>"><?php echo $row['nama']?></option>

                <?php

            }

            ?>

        </select>

        <input type="checkbox" id="orderbylevel" name="orderbylevel" value="order by level" style="margin:0 10px 0 50px;"/>
        <label for="orderbylevel">Order by Level</label>

        <br><br>

        <input type="submit" value="Tampilkan Leaderboard">

    </p>

</form>

<?php

if(isset($_GET['gameid']))
{
    $game_id = $_GET['gameid'];

    echo "<p class='paragraph'>LEADERBOARD GAME ID :".$game_id."</p>";

    $nama_game = mysqli_fetch_assoc($db->get("SELECT nama FROM game_tbl WHERE game_id = $game_id; "))['nama'];

    ?>

    <table class="content" border=1>

        

        <tr><td colspan=4 align="center"><?php echo $nama_game ?></td></tr>
        <tr><td>NO</td><td>NAMA</td><td>LEVEL</td><td>SCORE</td></tr>

        <?php

        $leaderboarddata = "";

        if (!isset($_GET['orderbylevel']))
            $leaderboarddata = $db->get("SELECT user_tbl.nama_depan as nama_depan, user_tbl.nama_belakang as nama_belakang, user_game_data_tbl.level as level, max(user_game_data_tbl.score) as score FROM user_tbl, user_game_data_tbl WHERE user_tbl.nik = user_game_data_tbl.nik AND user_game_data_tbl.game_id = ".$_GET['gameid']." GROUP BY user_tbl.nik, user_game_data_tbl.level ORDER BY score DESC, user_game_data_tbl.level ASC");
        else
            $leaderboarddata = $db->get("SELECT user_tbl.nama_depan as nama_depan, user_tbl.nama_belakang as nama_belakang, user_game_data_tbl.level as level, max(user_game_data_tbl.score) as score FROM user_tbl, user_game_data_tbl WHERE user_tbl.nik = user_game_data_tbl.nik AND user_game_data_tbl.game_id = ".$_GET['gameid']." GROUP BY user_tbl.nik, user_game_data_tbl.level ORDER BY user_game_data_tbl.level ASC, score DESC");

        $no = 0;

        while($row = mysqli_fetch_assoc($leaderboarddata))
        {
            $no++;

            ?>

            <tr>
                <td class="numeric-cell"><?php echo $no?></td>
                <td><?php echo $row['nama_depan']." ".$row['nama_belakang']?></td>
                <td class="numeric-cell"><?php echo $row['level'] ?></td>
                <td class="numeric-cell"><?php echo $row['score']?></td>               
            </tr>

            <?php
        }

        ?>

    </table>

    <?php

}

?>



<h1 class="section-title" style="margin-top:150px;">SUBMIT SKOR USER</h1>

<form action="score_process.php" method="POST">
<table class="content" border=1 style="margin-bottom: 200px;">
    
    <tr><td class="title" align="center">Attribute</td><td class="title" align="center">Value</td></tr>
    <tr><td>Game</td>
        <td>
            <select name="game_id" required>

                <option value="" >-- Pilih Game --</option>

            <?php

            $gamedata = $db->get("SELECT game_id,nama FROM game_tbl WHERE status=1");                                

            while($row = mysqli_fetch_assoc($gamedata))
            {

                ?>

                <option value="<?php echo $row['game_id']?>"><?php echo $row['nama']?></option>

                <?php

            }

            ?>

            </select>
        </td>
    </tr>
    <tr><td>Level</td><td><input type="number" name="level" placeholder="10" required></td></tr>
    <tr><td>Score</td><td><input type="number" name="score" placeholder="100" required></td></tr>

    <tr><td colspan=5></td></tr>

    <input type="hidden" name="opt" value="0"/>

    <tr>
        <td class="btn-cell" colspan=5>
            <button class="btn w-100" type="submit">Submit</button>
        </td>
    </tr>

</table>
</form>