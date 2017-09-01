
<!DOCTYPE html>
<html>
<head>
<?php include("navigator.php"); ?>

</head>
<body>
 
      <div id ="space"> </div>
    
    <div style="width:100%;">
        <div id="inner" class="inner">
            <br>
            <div id="inner">
                <h2>Your book has been added!</h2>
                <label> title: <?php if(isset($_GET['title'])){
          echo $_GET['title'];
                  
          }?> </label>
      
      <label> isbn: <?php if(isset($_GET['isbn'])){
          echo $_GET['isbn'];
                  
          }?> </label>
            </div>
            <br>
    </div>
    </div>
 
</body>
  
 
    
</body>

</body>
<!--<footer>
   <?php //include("footer.php"); ?>
</footer>-->
</html>
