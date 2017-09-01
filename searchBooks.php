<!DOCTYPE html>

<html>
<head>
<?php
include("navigator.php");
?>
    <link rel="stylesheet" href= "styles/searchbooksStyles.css">
</head>
<body>
  
  <div id ="space"> </div>
  
 

<div style="width:100%">
  <div id="inner">
      <form action="#" method="post">
      <input class="bigsearch" name = "search" type="text" placeholder="enter book title or ISBN"  /> 
      <input type="image"  src="images/search-9-64.png" width="25" height="25" alt="Submit">
             
       <br>
     
        <?php
        require 'dbConnection.php';

        $result=mysqli_query($conn, "select campusName FROM campus");
        $options=" ";       
        
        
        // Add checkbox options
        while($row = mysqli_fetch_array($result))
        {
          $options .='<input type="checkbox" name = "'.$row["campusName"].'"/>' . $row["campusName"];
          echo $options;
        }

        ?>

      </form>
  </div>
    
      <br>      
      <br>
      <ul class="books">
   <?php
    require 'dbConnection.php';
    $result = NULL;
    
if (isset($_POST['search'])) {
   
    //get selected books from the db
    $stmt = mysqli_prepare($conn, "SELECT `sellerID`, `ISBN`,`Title`,`Author`,`Edition`,`Notes`,`imageurl` FROM `book` inner join `seller_book`"
            . "on book.isbn = seller_book.bookisbn" 
            . " WHERE `Title` like CONCAT('%',?,'%') or  `ISBN` like CONCAT('%',?,'%')") or die(mysqli_error($conn));
    $search = $_POST['search'];
    
    mysqli_stmt_bind_param($stmt, 'ss', $search, $search);
    
    
    mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);
   
    while($row = mysqli_fetch_array($result)){
       echo '<li>
          <a href="#">
         <img src="' . $row['imageurl'] . '" height =200px; width=200px;>
            <h4> Title:' . $row['Title'] . '</h4>
          <p> ISBN: ' . $row['ISBN'] . '</p>
        </a>
          <form method="post" action="buyBook.php">
         <input type="hidden" name="seller" value='.$row["sellerID"].'>
         <input type="submit" value="Connect!" />
        </form>
      </li>';
    }
    
}

 else {
   $sql    = "SELECT `sellerID`, `ISBN`, `Title`, `Author`, `Edition`, `Notes`, `imageurl` "
           . "FROM `book` inner join seller_book on book.isbn = seller_book.bookisbn";
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
            <h4> Title:' . $row['Title'] . '</h4>
          <p> ISBN: ' . $row['ISBN'] . '</p>
        </a>
          <form method="post" action="buyBook.php">
         <input type="hidden" name="seller" value='.$row["sellerID"].'>
         <input type="submit" value="Connect!" />
        </form>
      </li>';
        }
    } else {
        echo "0 results";
    }
 }
?>
      </ul>
   
</div>
  
 

</body>

<footer>
    
</footer>


</html>



