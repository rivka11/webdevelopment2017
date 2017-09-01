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

    

//now we are ready to insert into database

$fname = $_POST['fname'];
$lname =$_POST['lname'];
$uname = $_POST['uname'];
$campus = $_POST['campus'];
$prefcontact = $_POST['prefcontact'];

$contactinfo = $_POST['contactinfo'];
$email = $_POST['email'];
$password  = $_POST['psw'];


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
mysqli_stmt_bind_param($sql, 'ssiisisss',$fname, $lname, $one, $one, $email, $one, $contactinfo, $uname, $password);


if(mysqli_stmt_execute($sql)){
    
          die(header("location:confirmBookAdded.php?title=$title&author=$author&isbn=$isbn".$filepath));

        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

//    if (mysqli_query($conn, $sql)) {
//    echo "New record created successfully";
//} else {
//    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//}

}

?>
