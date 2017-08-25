
<!DOCTYPE html>
<html>
<head>
<?php include("navigator.php"); ?>

</head>
<body>
  
  <div id ="space"> </div>
  
 

<div style="width:100%">
  <div id="inner">
      <label> Thank you. Your book has been added! </label>
      <label> title: <?php if(isset($_GET['title'])){
          echo $_GET['title'];
                  
          }?> </label>
      
      <label> isbn: <?php if(isset($_GET['isbn'])){
          echo $_GET['isbn'];
                  
          }?> </label>
      
    
   
  </div>
</div>
  
 
    
</body>

</body>
<footer>
   <?php include("footer.php"); ?>
</footer>
</html>
