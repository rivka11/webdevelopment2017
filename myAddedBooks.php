<!DOCTYPE html>

<html>
<head>
<?php
include("navigator.php"); 
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ===0 || !isset($_SESSION['user'])) {
   // not logged in
    die(header("location:redirectLogin.php?login=false&reason=not_logged_in"));
 } else {
       //logged in 
$useremail = $_SESSION['user'];
 }
?>
    <link rel="stylesheet" href= "styles/searchbooksStyles.css">
</head>
<body>
  
  <div id ="space"> </div>
  
 

<div style="width:100%">
  <div id="inner">
      
  </div>
    
      <br>      
      <br>
      <ul class="books">
   <?php
    require 'dbConnection.php';
    $result = NULL;

   echo "<h1> Hello ".$_SESSION['username']."!</h1>";
    //get selected books from the db
    $stmt = mysqli_prepare($conn, "SELECT `sellerID`, `ISBN`,`Title`,`Author`,`Edition`,`Notes`,`imageurl` FROM `book` "
            . "inner join `seller_book` on book.isbn = seller_book.bookisbn "
            . "inner join seller on seller_book.SellerID = seller.userID "
            . "where seller.email = ?") or die(mysqli_error($conn));
   
    
    mysqli_stmt_bind_param($stmt, 's', $useremail);
    
    
    mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);
   
    while($row = mysqli_fetch_array($result)){
       echo '<li>
        
         <img src="' . $row['imageurl'] . '" height =200px; width=200px;>
            <h4> Title:' . $row['Title'] . '</h4>
          <p> ISBN: ' . $row['ISBN'] . '</p>
       
          <form method="post" action="deleteBook.php">
         <input type="hidden" name="seller" value='.$row["sellerID"].'>
          <input type="submit" value="Remove" />
        </form>
      </li>';
    }
    

//    $result = mysqli_query($conn, $sql); 
//    
//
//    if (mysqli_num_rows($result) > 0) {
//        // output data of each row
//        while ($row = mysqli_fetch_assoc($result)) {
//            //     echo'<li>
//            // <h2>'.$row['Title'].'</h2>
//            // <div class="body"><img src="'. $row['imageurl'].'" height =200px; width=200px;></div>
//            //  <div class="cta"><a href="">Call to action!</a></div>
//            //   </li>';
//            echo '<li>
//          <a href="#">
//         <img src="' . $row['imageurl'] . '" height =200px; width=200px;>
//            <h4> Title:' . $row['Title'] . '</h4>
//          <p> ISBN: ' . $row['ISBN'] . '</p>
//        </a>
//          <form method="post" action="buyBook.php">
//         <input type="hidden" name="seller" value='.$row["sellerID"].'>
//         <input type="submit" value="Connect!" />
//        </form>
//      </li>';
//        }
//    } else {
//        echo "0 results";
//    }
 
?>
      </ul>
   
</div>
  
 

</body>

<footer>
    
</footer>


</html>



