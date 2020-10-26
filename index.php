<?php

SESSION_START();

include("database.php");

$db = new Database();

$nik = (isset($_SESSION['nik'])) ? $_SESSION['nik'] : "";

$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $nik)
{
   $result = $db->execute("SELECT * FROM user_tbl WHERE nik = '".$nik."' AND token = '".$token."' AND status = 1 ");

   if($result)
   {
       header("Location: http://localhost/course_backend/user/");
   }
}

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification)
{
   echo $notification;

   unset($_SESSION['notification']);
}
?>



PAGE : LOGIN

<form action="login/process.php" method="POST">

<table>

   <tr>

       <td>nik</td>

       <td>:</td>

       <td><input type="text" name="nik" required></td>

   </tr>

   <tr>

       <td>password</td>

       <td>:</td>

       <td><input type="password" name="password" required></td>

   </tr>

   <tr>

       <td colspan=3><input type="submit" value="LOGIN"></td>

   </tr>       

   </form>   

   <tr>

       <td colspan=3><button><a href="register.php">REGISTER</a></button></td>

   </tr>           

</table>