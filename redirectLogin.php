<!DOCTYPE html>
<?php include("navigator.php"); 
if(isset($_GET['reason'])){
    if($_GET['reason']=='not_logged_in'){
    $mesg = 'You need to be logged in to add a book';
    }
}
else{
    $mesg='';
}
?>
<body>
      <div id ="space"> </div>
    <div style="width:100%;">
        <div id="inner" class="inner">
            <br>
            <img style="display:block; margin: auto; width:25%" src="images/warning-5-128.png"/>
            <h2 style="display:inline-block; text-align: center; width: 100%"><?php echo $mesg ?></h2>
           
            <div id="inner">
                
             
                <a class="button" href="searchBooks.php">Go Back to Search</a>
                <a class="button" href="signin.php">Continue to Sign in</a>
                <a class="button" href="signUp.php" >Sign me up!</a>
          
            
        </form>
            </div>
            <br>
    </div>
    </div>
 
</body>