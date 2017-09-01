<?php 
 session_start(); 
 
 
 if(!empty($_POST)){
    //check if anything is incomplete
    $rqrd = array('email', 'psw');
  $error = false;
foreach($rqrd as $field) {
  if (empty($_POST[$field])) {
    $error = true;
    die(header("location:signin.php?loginFailed=true&reason=empty_field"));
  }
}
    //check email is address
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
           die(header("location:signin.php?loginFailed=true&reason=invalid_email"));
        }
        
        
    //verify with database
    include 'dbConnection.php';
    
     $stmt = mysqli_prepare($conn, "SELECT `password` ,`userName` FROM `seller` WHERE `email` = ?");
     $email = $_POST['email'];
     $passw  = $_POST['psw'];
    
    mysqli_stmt_bind_param($stmt, 's', $email);
//fix, should not have to loop through result    
    $pw = NULL;
    mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);
   while($row = mysqli_fetch_assoc($result)) {
   $pw = $row['password'];
   $uname = $row['userName'];
    }
    
    //check if passwords are the same
    if($passw == $pw){
        //successfully signed in!
        
         $_SESSION['user'] = $email;
         $_SESSION['loggedIn'] =1;
         $_SESSION['username'] = $uname;
         die(header("location:myAddedBooks.php?loginFailed=false"));
    }

    }
else{
    $_SESSION['loggedIn'] =0;
     die(header("location:signin.php?loginFailed=true&reason=error"));
}