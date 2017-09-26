<?php if(!empty($_POST)){
    //check if anything is incomplete
    $rqrd = array('fname', 'lname', 'uname', 'contactinfo', 'psw', 'psw-repeat', 'prefcontact', 'email', 'campus');
  $error = false;
foreach($rqrd as $field) {
  if (empty($_POST[$field])) {
    $error = true;
    die(header("location:signUp.php?loginFailed=true&reason=empty_field"));
  }
}
    //check email is address
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
           die(header("location:signUp.php?loginFailed=true&reason=invalid_email"));
        }

    //if contactmethod is phone check for 10 digits contact info 
         if ($_POST['prefcontact'] === 'Phone') {
             if(!preg_match('/^\d{10}$/',$_POST['contactinfo'])){
                 die(header("location:signUp.php?loginFailed=true&reason=invalid_phone"));
             }
         }
         
     //if contactmethod is email check that it's valid
    elseif ($_POST['prefcontact'] === 'Email') {
         if (!filter_var($_POST['contactinfo'], FILTER_VALIDATE_EMAIL)){
                 die(header("location:signUp.php?loginFailed=true&reason=invalid_email"));
             }
            }
         
         
    
    
    //check passwords match
    if($_POST['psw'] != $_POST['psw-repeat']){
    die(header("location:signUp.php?loginFailed=true&reason=password"));
    }
   
/*********
 * user already exists with given email --not unique error!
 * *****************/
    //Check if user exists with that email address
    require 'dbConnection.php';
$useremail = $_POST['email'];
 $stmt = mysqli_prepare($conn, "SELECT `email` FROM `seller` WHERE `email` = ?");

 mysqli_stmt_bind_param($stmt, 's', $useremail);

 mysqli_stmt_execute($stmt);
 
 $result = mysqli_stmt_get_result($stmt); //we know there can only be one result looping is weird
 
 if(mysqli_num_rows($result)!=0){
     //user with that email already signed up 
      die(header("location:signUp.php?loginFailed=true&reason=userexists"));
 }
    

//now we are ready to insert into database

$fname = $_POST['fname'];
$lname =$_POST['lname'];
$uname = $_POST['uname'];
$campus = $_POST['campus'];
$prefcontact = $_POST['prefcontact'];

$contactinfo = $_POST['contactinfo'];
$email = $_POST['email'];
$password  = password_hash($_POST['psw'], PASSWORD_DEFAULT);



//get campus id
$sql = 'select CampusID from campus where campusName = "$campus"';
$campusId = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($campusId)) {
   $id = $row['CampusID'];
    echo $id;
}
//$campusId = $campusId->mysqli_fetch_assoc()['CampusID'];
//echo 'campusid is:'.$campusId;
//get pref contact id
$sql = 'select ContactID from contactmethods where methodDesc = "$prefcontact"';
$contactID = mysqli_query($conn, $sql);
//$contactID = $contactID ->mysqli_fetch_assoc()['ContactID'];

//insert that value --> add new user
$sql = mysqli_prepare($conn,"INSERT INTO `seller` (`firstName`, `lastName`, `campus`, `userType`, `email`, `prefContact`, `contactInfo`, `userName`, `password`) 
        VALUES (?,?,?,?,?,?,?,?,?)");
$one =1;
$campusint = (int)$campus;
$prefcint = (int)$prefcontact;

mysqli_stmt_bind_param($sql, 'ssiisisss',$fname, $lname, $campusint, $one, $email, $prefcint, $contactinfo, $uname, $password);


if(mysqli_stmt_execute($sql)){
        session_start(); 
         $_SESSION['user'] = $email;
         $_SESSION['loggedIn'] =1;
         $_SESSION['username'] = $uname;
          die(header("location:myAddedBooks.php?"));

        }else{
            echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
        }

//    if (mysqli_query($conn, $sql)) {
//    echo "New record created successfully";
//} else {
//    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//}

}


