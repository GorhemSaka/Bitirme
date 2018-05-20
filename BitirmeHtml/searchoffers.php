<!DOCTYPE html>

<html>
    <head>
    <meta charset="UTF-8">
    <title>Search</title>
<link rel="stylesheet" type="text/css" href="index.css">
    
    </head>
    <body>
        <?php  include "top.php"; ?>
    	<?php 
       session_start();
        include "connect.php"; 
        if(isset($_POST['search'])) : ?>

        <?php 
        $cond = "";
        
        if($_POST['title']) : 
          $title = $_POST['title'];
          $title="%".$title."%";
          $cond = "title LIKE '$title'";
          endif;



          if($_POST['actor']) {  
          $actor = $_POST['actor'];
            $actor="%".$actor."%";
           $actorsorgu=mysqli_query($conn,"SELECT actor_id FROM actor
              WHERE actor_name LIKE '$actor'");
             $actorresult=mysqli_fetch_array($actorsorgu);
             $acid = $actorresult['actor_id'];
              $actormoviesorgu=mysqli_query($conn,"SELECT movie_id FROM movieactor
              WHERE actor_id = '$acid'");
             //  $actormoviesorguarray=mysqli_fetch_array($actormoviesorgu);
          }else{
               $actormoviesorgu=mysqli_query($conn,"SELECT movie_id FROM movieactor");
               //$actormoviesorguarray=mysqli_fetch_array($actormoviesorgu);

          }





           if($_POST['year']) :  
          $year = $_POST['year'];
          if($cond == ""){
            $cond = "release_date = '$year'";
          }else{
            $cond = "$cond AND release_date = '$year'";
          }
          endif;
           if($_POST['language']) :  
          $language = $_POST['language'];
          if($cond == ""){
            $cond = "language = '$language'";
          }else{
            $cond = "$cond AND language = '$language'";
          }
          endif;



           if($_POST['productor']){
          $production = $_POST['productor'];
           $production="%".$production."%";
          $productionsorgu=mysqli_query($conn,"SELECT production_id FROM production
              WHERE production_name LIKE '$production'");
             $productionresult=mysqli_fetch_array($productionsorgu);
             $proid = $result1['production_id'];
              $productionmoviesorgu=mysqli_query($conn,"SELECT movie_id FROM movieproduction
              WHERE production_id = '$proid'");
             // $productionmoviesorguarray=mysqli_fetch_array($productionmoviesorgu);
          }else{
          $productionmoviesorgu=mysqli_query($conn,"SELECT movie_id FROM movieproduction");
         // $productionmoviesorguarray=mysqli_fetch_array($productionmoviesorgu);

          }





           if($_POST['minrate']) :  
          $minrate = $_POST['minrate'];
          if($cond == ""){
            $cond = "vote_average >= $minrate AND vote_count>=10";
          }else{
            $cond = "$cond AND vote_average >= $minrate AND vote_count>=10";
          }
          endif;
           if($_POST['maxrate']) :  
          $maxrate = $_POST['maxrate'];
          if($cond == ""){
            $cond = "vote_average <= $maxrate AND vote_count>=10";
          }else{
            $cond = "$cond AND vote_average <= $maxrate AND vote_count>=10";
          }
          endif;




             if($_POST['category']){
          $category = $_POST['category'];
           $category="%".$category."%";
      $categorysorgu=mysqli_query($conn,"SELECT category_id FROM category
              WHERE category_name LIKE '$category'");
             $categoryresult=mysqli_fetch_array($categorysorgu);
             $catid = $result1['category_id'];
              $categorymoviesorgu=mysqli_query($conn,"SELECT movie_id FROM moviecategory
              WHERE category_id = '$catid'");
             // $categorymoviesorguarray=mysqli_fetch_array($categorymoviesorgu);
          }else{
             $categorymoviesorgu=mysqli_query($conn,"SELECT movie_id FROM moviecategory");
             //$categorymoviesorguarray=mysqli_fetch_array($categorymoviesorgu);
          }


          if($cond == ""){
            $sorgu=mysqli_query($conn,"SELECT id FROM movietable ");
             //$sorguarray=mysqli_fetch_array($sorgu);
          }else{

             
            $sorgu=mysqli_query($conn,"SELECT id FROM movietable WHERE $cond");
           // $sorguarray=mysqli_fetch_array($sorgu);

          }
          $s1=[];
          $a=0;
          while($row1 = $sorgu->fetch_assoc()){
              $s1[$a]=$row1['id'];
              $a++;
          }
         $s2=[];
          $b=0;
          while($row2 = $actormoviesorgu->fetch_assoc()){
              $s2[$b]=$row2['movie_id'];
              $b++;
          }
          $s3=[];
          $c=0;
          while($row3 = $categorymoviesorgu->fetch_assoc()){
              $s3[$b]=$row1['movie_id'];
              $c++;
          }
          $s4=[];
          $d=0;
          while($row1 = $productionmoviesorgu->fetch_assoc()){
              $s4[$d]=$row1['movie_id'];
              $d++;
          }

          $sonuc = array_intersect($s1, $s2);
          $sonuc1 = array_intersect($sonuc,$s3);
          $sonuc2 = array_intersect($sonuc1, $s4);
echo "string".$s1[0];
echo "string".$s2[0];
echo "string".$s3[0];
echo "string".$s4[0];
          
          if (count($sonuc2) > 0) :?>
          <h1>Search</h1>
          <div class="form">
          <?php for ($i=0; $i < count($sonuc2); $i++)  :

$a=$sonuc2[$i];
 $fetch=mysqli_query($conn,"SELECT title FROM movietable WHERE id='$a'");
$fetcharray=mysqli_fetch_array($fetch);
echo "string".$sonuc2[$i];
           ?>
              
            <form action="moviepage.php" method="get">          
            <button type="submit" name = "movietitle"  value = <?php echo '"'.$fetcharray['title'].'"' ?> class="btn"  /> <?php echo $fetcharray['title'] ?> </button>
            </form>
            <?php endfor;?>



            <h2></h2>
            <form action="searchoffers.php" method="post">          
            <button type="submit"/>New Search</button>
            </form>
            </div>

             <?php else:?>
             <h1>Search Offers</h1>

             <div class="form">
             <h2>No Result!!</h2>
             <form action="searchoffers.php" method="post">          
            <button type="submit"/>New Search</button>
            </form>


             </div>
            <?php endif;
        ?>   
    	<?php else:?> 
    	<h1>Search</h1>
    	 <div class="form">
        <form action="?" method="post">       

        	   <div class="field-wrap">
              <label>
                Movie Title<span class="req"></span>
              </label>
              <input type="text" name="title"  />
            </div>

            <div class="field-wrap">
              <label>
                Actor<span class="req"></span>
              </label>
              <input type="text" name="actor"  />
            </div>

            <div class="field-wrap">
              <label>
               Year<span class="req"></span>
              </label>
              <input type="text" name="year"  />
            </div>

            <div class="field-wrap">
              <label>
                Language<span class="req"></span>
              </label>
              <input type="text" name="language"  />
            </div>

            <div class="field-wrap">
              <label>
                Productor<span class="req"></span>
              </label>
              <input type="text" name="productor"  />
            </div>

            <div class="field-wrap">
              <label>
                Min Rate.<span class="req"></span>
              </label>
              <input type="text" name="minrate"  />
            </div>
            <div class="field-wrap">
              <label>
                Max Rate<span class="req"></span>
              </label>
              <input type="text" name="maxrate"  />
            </div>

            <div class="field-wrap">
              <label>
                Category<span class="req"></span>
              </label>
              <input type="text" name="category"  />
            </div>
          
            <button type="submit" name="search"/>Search</button>
        </form>
        
        </div>

    	<?php endif; ?>
    </body>
</html>