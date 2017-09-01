<?php
if (session_status() != PHP_SESSION_ACTIVE){
    session_start();
}

?>
    <!DOCTYPE html>
<html>
<head> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.sticky.js"></script>

<link rel="stylesheet" href= "styles/themeStyle.css"/>
<script>
  $(document).ready(function(){
    $("#sticker").sticky({topSpacing:0});
  });
</script>


</head>
<body>
   <body >
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
        <li id = "navli"><a href="searchBooks.php">Search Books</a></li>
        <li id = "navli"><a href="about.php">About</a></li>
        <li id = "navli"><a href="contact.php">Contact</a></li>
        <?php
        if(isset($_SESSION['user'])){
            echo $_SESSION['user'];
            echo '<li id = "navli"><a href="signOut.php">Sign Out</a></li>';
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