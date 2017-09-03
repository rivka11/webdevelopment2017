<!DOCTYPE html>
<?php include("navigator.php"); ?>
<body>
      <div id ="space"> </div>
    <div style="width:100%;">
        <div id="inner" class="inner">
            <br>
            <div id="inner">
                <form action="sendEmail.php" method="post">
            <label>Full Name:</label>
            <input type ="text" name = "name" required="true"/>*
            <br>
            <br>
            <label>Email address:</label>
            <input type ="text" name = "email" required="true"/>*
            <br>
            <br>
            <label>Reason for contact:</label>
            <select name="questions">
                <option>Seller Question</option>
                <option>Buyer Question</option>
                <option>Other Question</option>
            </select>
            <br>
            <br>
            <textarea rows ="4" cols="50" required="true" name = "content" placeholder="enter question here"></textarea>
            <br>
            <br>
                <input type ="submit" value = "send"/>
                <label class ="info"> your name and email will not be  shared.</label>
        </form>
            </div>
            
            <br>
    </div>
    </div>
 
</body>
<footer>
 <?php include 'footer2.php';?>
</footer>