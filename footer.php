<!DOCTYPE html>
<head>
    <link rel="stylesheet" href= "styles/footerStyles.css">
    <link rel="stylesheet" href= "styles/jquery.mThumbnailScroller.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- plugin script -->
    <script type="text/javascript" src="jquery.mThumbnailScroller.js"></script>
</head>
<div id="my-thumbs-list" class="mThumbnailScroller footer" data-mts-axis="x">
<?php
include 'dbConnection.php';
//populate images
$sql  = "SELECT `imageurl` "
           . "FROM `book` ";
    $result = mysqli_query($conn, $sql); 
    

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            //     echo'<li>
            // <h2>'.$row['Title'].'</h2>
            // <div class="body"><img src="'. $row['imageurl'].'" height =200px; width=200px;></div>
            //  <div class="cta"><a href="">Call to action!</a></div>
            //   </li>';
            echo '<li>
          <a href="#">
         <img src="' . $row['imageurl'] . '" height =200px; width=200px;>
          
        </a>
         
      </li>';
        }
    }

?>
</div>

<!--<div id ="footer">
    <span> Rivka Schuster </span>
</div>-->
