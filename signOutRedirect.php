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
                <h1>You must sign out to continue</h1>
                <label> We match those who have books with those who do not. It's simple!</label>
            </div>
            <br/>
    </div>
    </div>
 
     <?php include 'basicFooter.php';?>
