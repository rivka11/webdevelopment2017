<?php
session_start();
?>
<!DOCTYPE html>
<?php include("navigator.php"); 
?>
<body>
   
      <div id ="space"> </div>
       <?php
    if(isset($_GET['LoginFailed'])){
    echo $_GET['reason'];
}
    ?>
    <div style="width:100%;">
        <div id="inner" class="inner">
            <br>
            <div id="inner">
                <form method="post" action="validateUser.php">
            <label>enter email</label>
            <input type ="text" name="email"/>
            <br>
            <br>
            <label>enter password</label>
            <input type ="password" name="psw"/>
            
            <br>
            <br>
            <input type ="submit" value="sign in"/>
            
        </form>
            </div>
            <br>
    </div>
    </div>
 
</body>