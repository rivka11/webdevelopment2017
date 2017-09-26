<!DOCTYPE html>
<?php  
session_start();
if(isset($_SESSION['loggedIn'])){
    //already signed in Cant sign up!
    
    //redirect to give user option
     //  die(header("location:signOutRedirect.php"));
    
       //sign out user
     
session_unset();
session_destroy();

}

include("navigator.php");

?>
<body>
      <div id ="space"> </div>   
      <div id="inner" class="inner">
          <div id="inner">
            <br>
            <?php
            $possibleReasons = array("empty_field" => "all field must be completed", "password"=>"invalid sign in", "userexists"=>"A user with that email already exists", "invalid_phone" => "Phone should be 10 digits", "invalid_email" => "Invalid email address");
            if(isset($_GET['loginFailed'])){
                  $myreason = $possibleReasons[$_GET['reason']];      
               echo '<div style=color:red;"> error: '.$myreason."<div>";
            }
            
            ?>
            <form action="validateNewUser.php" method = "post">
            <label>First Name:</label>
            <input name = "fname" type ="text" required/>*
            <br>
            <br>
            <label>Last Name:</label>
            <input name = "lname" type ="text" required/>*
            <br>
            <br>
            <label>Site user name:</label>
            <input type ="text" name = "uname" required/>* (this will be public)
            <br>
            <br>
            <label>Email address:</label>
            <input type ="text" name = "email" required/>*
            <br>
            <br>
            <label>Preferred contact method:</label>
            <select name="prefcontact" style="width:150px">*
         <option selected disabled hidden>select one</option>
        <?php
        require 'dbConnection.php';

        $result=mysqli_query($conn, "select methodDesc FROM contactmethods");
     
        
        // Add options to the drop down
        while($row = mysqli_fetch_array($result))
        {
          $menu ="<option>" . $row['methodDesc'] . "</option>";
          echo $menu;
        }

        ?>
        </select>
            <br>
            <br>
             <label>Contact Info:</label>
              <input type ="text" name = "contactinfo" required/>*
       
            <br>
            <br>
            
               <label>Campus</label>
        <select class="form-dropdown" style="width:150px" id="input_5" name="campus">*
             <option selected disabled hidden>choose</option>
            <?php
            require 'dbConnection.php';

            $result=mysqli_query($conn, "select campusName FROM campus");
         
            // Add options to the drop down
            while($row = mysqli_fetch_array($result))
            {
              $menu ="<option>" . $row['campusName'] . "</option>";
              echo $menu;
            }

            ?>
      </select>
               <br>
               <br>  
               <label>Password</label>
      <input type="password" placeholder="Enter Password" name="psw" required>*
      <br>
      <br>
      <label>Repeat Password</label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>*
      <br>
      
      
      <p><label>By creating an account you agree to our <a href="termsprivacy.php">Terms & Privacy</a>.</label></p>
      
      
      
      
      <input type ="submit" required value="sign up!"/>
            
        </form>
            <br>
    </div>
    </div>

</body>