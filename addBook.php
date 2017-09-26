<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href= "styles/jquery.mThumbnailScroller.css">
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
     <!-- plugin script -->
     <script type="text/javascript" src="jquery.mThumbnailScroller.js"></script>
</head>
<?php
include("navigator.php"); 
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ===0) {
   // not logged in
    die(header("location:redirectLogin.php?login=false&reason=not_logged_in"));
 } else {
   //logged in 
if(isset($_GET['error'])){
   $rsn= $_GET['reason'];
}
else {
    $rsn = '';
 }
 }
?>

      <div id ="space"> </div>
    <div style="width:100%;">
        <div id="inner" class="inner">
            <br/>
            <div id="inner">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label>ISBN(10 or 13):</label>
            <input type ="text" name = "isbn" required/>*
            <br/>
            <br/>
            <label>Title:</label>
            <input type ="text" name = "title"  required/>*
            <br/>
            <br/>
            <label>Author:</label>
            <input type ="text" name = "author" required/>*
            <br/>
            <br/>
            <label>Edition:</label>
            <input type ="text" name = "edition"/>
            <br/>
            <br/>
            <label>Notes:</label>
            <textarea  maxlength="100" name = "notes" rows ="3" cols="50" placeholder="enter information here (ie. book condition)"></textarea>
            <br/>
            <br/>
                      
            <label>Select image to upload:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br/>
            <br/>
            <input type="submit" value="Add Book" name="submit"/>

        </form>
                <label style="color:red;" class="error"> <?php echo $rsn;?> </label>
            </div>
            <br/>
    </div>
    </div>
      

     

<footer>
   
 <?php// include 'footer2.php'; ?>
     <?php   include 'footer.php';?>
 
</footer>
       <?php   include 'basicFooter.php';?>