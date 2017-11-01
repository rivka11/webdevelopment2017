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

<html>
<head>

    <link rel="stylesheet" href= "styles/searchbooksStyles.css">
   </head>
<body>
  
 
  
 

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
    $stmt = mysqli_prepare($conn, "SELECT `bookID`, `sellerID`, `ISBN`,`Title`,`Author`,`Edition`,`Notes`,`imageurl` FROM `book` "
            
            . "inner join seller on book.SellerID = seller.userID "
            . "where seller.email = ?") or die(mysqli_error($conn));
   
    
    mysqli_stmt_bind_param($stmt, 's', $useremail);
    
    
    mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);
   
   if(mysqli_num_rows($result)==0){
       echo '<h4>You do not have any open books.</h4>';
   }
 
    while($row = mysqli_fetch_array($result)){
        if($row['Edition']==0){
            $edition = "N/A";
        }
        else{
            $edition = $row['Edition'];
        }
       echo '<li>
        
        <figure>
         <img src="' . $row['imageurl'] . '" height =200px; width=200px;>
             <figcaption>Edition: '.$edition.
             
             '<br>'.$row['Notes'].'</figcaption>
         </figure>
            <h4> Title:' . $row['Title'] . '</h4>
          <p> ISBN: ' . $row['ISBN'] . '</p>
       
          <form method="post" action="deleteBook.php">
         <input type="hidden" name="seller" value='.$row["sellerID"].'>
         <input type="hidden" name="bookisbn" value='.$row["ISBN"].'>
      <input type="hidden" name="imageurl" value='.$row["imageurl"].'>
         <input type="hidden" name="book_id" value='.$row["bookID"].'>
         <input type="submit" value="Remove" />
        </form>
      </li>';
    }
    

 
?>
      </ul>
   <!--if javascript is not enabled cant actually remove book.....need to figure out better way!-->
<!--      <script>
          $(function(){
    $('form').submit(function(){
        if (confirm("Press a button!") === false) {
              return false;
}

    });
});
          </script>-->
</body>



</html>



