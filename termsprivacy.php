<?php include("navigator.php"); 
?>

   
      <div id ="space"> </div>
       <?php
    if(isset($_GET['LoginFailed'])){
    echo $_GET['reason'];
}
    ?>
    <div style="width:100%;">
        <div id="inner" class="inner">
            <br/>
            <div id="inner">
                <h1>Terms and Privacy</h1>
                <label> We like to steal your info! try us!</label>
                <p>
                    The username you provide will be public. 
The contact information you provide will also be visible to users who want to initiate contact. 
The email you use to sign up will NOT be visible to other users.
                </p>
            </div>
            <br/>
    </div>
    </div>
 
     <?php   include 'basicFooter.php';?>

