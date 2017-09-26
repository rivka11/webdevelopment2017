<!DOCTYPE html>
<?php include("navigator.php");
if(!isset($_POST['seller'])){
    echo 'error';
    //RUN AWAY
}
else {
    include 'dbConnection.php';
    $sellerid = $_POST['seller'];
    include 'dbConnection.php';
  
    $stmt = mysqli_prepare($conn, "select userName, methodDesc, contactInfo from seller inner join contactMethods "
            . "on seller.prefContact = contactMethods.contactID where userID = ?") ;

    mysqli_stmt_bind_param($stmt, 'i',$sellerid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);
    $sellername = $row["userName"];
     $prefcontact = $row["methodDesc"];
      $contactInfo = $row["contactInfo"];

}
?>

      <div id ="space"> </div>
    <div style="width:100%;">
        <div id="inner" class="inner">
            <br>
            <div id="inner">
                <h2> Get in Touch </h2>
            <label>Contact seller <?php echo $sellername?> by <?php echo $prefcontact?>  
                at <?php echo $contactInfo ?></label>
            
            <br>
          
            <label>Tizku limitzvos!</label>
            
            <br>
            <br>
          
            </div>
         
            <br>
    </div>
    </div>
 
     <?php   include 'basicFooter.php';?>

