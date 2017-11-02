<?php 
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
   if(mysqli_num_rows($result)==0){
         die(header("location:signin.php?loginFailed=true&reason=invalidsignin"));
   }
   while($row = mysqli_fetch_assoc($result)) {
   $pw = $row['password'];
   $uname = $row['userName'];
    }
    $remember = $_POST['rememberMe'];
    //check if passwords are the same
    if(password_verify($passw, $pw)){
        //successfully signed in!
        session_start(); 
         $_SESSION['user'] = $email;
         $_SESSION['loggedIn'] =1;
         $_SESSION['username'] = $uname;
         if($remember == "remember"){
        setcookie('userNameCookie', $email, time() + (86400), "/"); //remember for a day
        }
         die(header("location:myAddedBooks.php?loginFailed=false"));
    } 
    
    else{
       die(header("location:signin.php?loginFailed=true&reason=invalid_pw"));
    }

    }
else{
   // session_start(); 
    $_SESSION['loggedIn'] = 0;
     die(header("location:signin.php?loginFailed=true&reason=error"));
}