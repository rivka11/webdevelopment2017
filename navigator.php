<?php
if (session_status() != PHP_SESSION_ACTIVE){
    session_start();
}

?>
    <!DOCTYPE html>
<html>
<head> 
    <title>Touro Textbook Gemach</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.sticky.js"></script>

<link rel="stylesheet" href= "styles/themeStyle.css"/>
<link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="32x32" />
<link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />

<script>
  $(document).ready(function(){
    $("#sticker").sticky({topSpacing:0});
  });
</script>


</head>
<body>
 
      <header>
      <a href="index.php">
          <img id="logo" src="images/logoburned.png" alt="logo">
      </a>
  
        </header>
       
       
   <div class="nav" id="sticker">
      <ul class="navul">
<!--        <li><a href="index.php"></a></li>-->
        <li id = "navli"><a  href="index.php">Home</a></li>
        <li id = "navli"><a href="signUp.php">Sign Up</a></li>
<!--        <li id = "navli"><a href="buyBook.php">Buy Book</a></li>-->

       <!--code below modified from w3school dropdown menu link is in css code javascript:void(0) means page wont reload on click the unbutton button-->
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">Search Books</a>
        <div class="dropdown-content">
            <a href="searchBooks.php">Search Books</a>
          <a href="myAddedBooks.php">View My Books</a>
         </div>
      </li>
  
  
<!--        <li id = "navli"><a href="searchBooks.php">Search Books</a></li>-->
        
        <li id = "navli"><a href="about.php">About</a></li>
        <li id = "navli"><a href="contact.php">Contact</a></li>
        <?php
        if(isset($_SESSION['user'])){
//            echo $_SESSION['user'];
            echo '<li id = "navli"><a href="signOut.php">Sign Out</a></li>';
            //dont add thingsto nav its not common
//            echo '<li id = "navli"><a href="myAddedBooks.php">My Books</a></li>';
        }
        else{
            echo '<li id = "navli"><a href="signIn.php">Sign in</a></li>';
        }
        ?>
         <li id = "navli"><a href="addBook.php">Add Book</a></li>
      </ul>
    </div>

 
    
</body>

</body>
</html>