<?php
 session_start();
 if(!isset($_SESSION['name'])){
header('Location: index.php');
 }
 ?>
 <!DOCTYPE html>
<html>
<head>
	  <meta charset="UTF-8">
  <title>Profile</title>
<link rel="stylesheet" type="text/css" href="index.css">
<style type="text/css">
button{
  background-color: #99ff99;
  color:black;
}

body{
    background-image: url('4.jpg');
    background-size: 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;

}

</style>
</head>
<body>
    <div>
        <?php  include "top.php"; 
          include "connect.php"; ?>
       </div>
       <div align="center">
         
        <?php 
        $user_mail = $_SESSION["email"];
       $dizi= mysqli_query($conn,"SELECT * FROM user WHERE user_mail='$user_mail'");
       $rowa = mysqli_fetch_array($dizi);?>
       <h3 style="font-style: oblique;">
         <?php 
       echo $rowa['user_name']." ".$rowa['user_surname'];
        ?>
       </h3>
       
      

       </div>
       



       <div align="center">
<form method="POST" action="image.php" enctype="multipart/form-data">
 <input type="file" name="myimage">
 <input type="submit" name="submit_image" value="Upload">
</form>
  <?php 

  


$select_path="SELECT * FROM user WHERE user_mail='$user_mail'";

$var1=mysqli_query($conn,$select_path);

while($row=mysqli_fetch_array($var1))
{

  if($row['user_photo']){
    $image_name=$row['user_photo'];
 $image_path=$row['user_folder'];
 echo '<img src="'.$image_name.'"  height="140">';
}else{
  echo '<img src="noldu.jpeg"  height="140">';
}
} ?>

</div>
<div align="center">
  <form action="profile.php" method="POST">
     <button  style="margin-bottom: 2px; width: 200px" type="submit" value="watched" name = "cho" >Watched Movies</button>
     <button  style="margin-bottom: 2px; width: 200px" type="submit" value="moviesto" name = "cho" >Movies to Watch</button>
     <button  style="margin-bottom: 2px; width: 200px" type="submit" value="recom" name = "cho1" >Get Recommendation</button>
     </form>
</div>
  <?php 
    if (isset($_POST['cho'])) {
        $choise = $_POST['cho'];
        if ($choise=="watched") {
            $sql = "SELECT title, poster_path,id FROM movietable where id IN (SELECT user_movieid FROM movie WHERE user_mail='$user_mail' and status=0) ORDER BY revenue desc LIMIT 25";
        }
        elseif ($choise=="moviesto") {
             $sql = "SELECT title, poster_path,id FROM movietable where id IN (SELECT user_movieid FROM movie WHERE user_mail='$user_mail' and status=1) ORDER BY revenue desc LIMIT 25";
        }




$result = $conn->query($sql);


if ($result->num_rows > 0) : ?>
    
  <marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" 
scrolldelay="60" style="position: absolute; bottom: 15px;" loop="99999">
 <?php   while($row = $result->fetch_assoc()) :
  
    echo '<a href="moviepage.php?movieid='.$row['id'].'"><img alt='.$row['title'].' width="150" height="240" src="https://image.tmdb.org/t/p/original'. $row['poster_path'].'"></a>' ;

/*$path="https://image.tmdb.org/t/p/original".$row['poster_path'];

echo $path."'\'".$row['title'].";".$row['id'].";";*/
    endwhile;?>
    </marquee>
<?php endif; 






    }elseif (isset($_POST['cho1']) or !isset($_POST['cho'])){

$re = mysqli_query($conn,"SELECT user_rec FROM user WHERE user_mail='$user_mail'");
//$re ="448290,5422";
$rearray = mysqli_fetch_array($re);
if($rearray['user_rec']=="") :?>
  <marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" 
scrolldelay="60" style="position: absolute; bottom: 15px;" loop="99999">
 
<?php   $r = mysqli_query($conn,"SELECT title, poster_path,id FROM movietable where vote_count>20 ORDER BY vote_average/vote_count desc LIMIT 25");
   
while($ow = $r->fetch_assoc()){
echo '<a href="moviepage.php?movieid='.$ow['id'].'"><img alt='.$ow['title'].' width="150" height="240" src="https://image.tmdb.org/t/p/original'. $ow['poster_path'].'"></a>' ;
}?>
</marquee>
<?php
else:
 
   $arr = explode(",", $rearray['user_rec']);?>
    <marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" 
scrolldelay="60" style="position: absolute; bottom: 15px;" loop="99999">
<?php 
for($i=0;$i<count($arr);$i++){

  $r = mysqli_query($conn,"SELECT title,poster_path,id FROM movietable WHERE id=$arr[$i]");
   
while($ow = $r->fetch_assoc()){
echo '<a href="moviepage.php?movieid='.$ow['id'].'"><img alt='.$ow['title'].' width="150" height="240" src="https://image.tmdb.org/t/p/original'. $ow['poster_path'].'"></a>' ;
}
}
endif;
 
    }
?>
   </marquee>



</body>
</html>