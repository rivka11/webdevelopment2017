<?php
//session_set_cookie_params(0);//should destroy session when browser is closed, appears to work
//TODO user should be signed out on browser close
//session_start();
?>
<!DOCTYPE html>
<?php include("navigator.php"); 
?>

   
      <div id ="space"> </div>
       <?php
    if(isset($_GET['loginFailed'])){
    $er = $_GET['reason'];
}
else{
    $er ='';
}
    ?>
    <div style="width:100%;">
        <div id="inner" class="inner">
            <br/>
            <div id="inner">
                <form method="post" action="validateUser.php">
            <label>enter email</label>
            <input type ="text" name="email" <?php if(isset($_COOKIE['userNameCookie'])){echo 'value ="'.$_COOKIE['userNameCookie'].'"';}?> required/>*
         
            <br/>
            <br/>
            <label>enter password</label>
            <input type ="password" name="psw" required/>*
            
            <br/>
            <br/>
            <input type ="submit" value="sign in"/>
            <input type="checkbox"  value = "remember" name="rememberMe"  /> remember me
               
        </form>
                <label style="color:red;">
                    <?php echo $er; ?>
                </label>
            </div>
            <br/>
            
    </div>
    </div>
 

<footer>
 <?php include 'footer2.php';?>
</footer>
 <?php   include 'basicFooter.php';?>