<!DOCTYPE html>
<?php include("navigator.php"); ?>

  
  <div id ="space"> </div>
  
 

<div style="width:100%">
<!--  <div id="inner">
      <input class="bigsearch" type="text" placeholder="enter book title or ISBN"  />
      <a href="#">
        <img border="0" alt="Search" src="searchIcon.png" width=".5%" height="25">
     </a>
  </div>
</div>-->
<ul class="main">
      
    <a  href = "addBook.php" 
        <li style="width: 30%; display: inline-block;"> 
            <div class ="circle">
            <img style="display: inline-block; padding: 25%;" src="images/upload-2-128.png"/> 
           ADD BOOK
            </div>
     
    </a>
    
    <a  href = "searchBooks.php" 
        <li style="width: 30%; display: inline-block;">
            <div class ="circle">
            <img style="display: inline-block; padding:25%;" src="images/search-9-128 (1).png"/>
             FIND BOOK
            </div> 
    </a>
    
    
    <a  href = "contact.php" 
        <li  style="width: 30%; display: inline-block;" >
            <div class ="circle">
            <img  style="display: inline-block; padding: 25%;" src="images/email-2-128.png"/>
            GET IN TOUCH
            </div>
    </a>
    <br>
    <br>
    <br>
  
      <div style="width:100%;">
        <div id="inner" class="index">
            <br/>
            <div id="inner">
                <h1>Who are we?</h1>
                <label> We match those who have books with those who do not. It's simple!<br/> 
                    You find a book you need and contact the owner. <br/>
                    <a href="searchBooks.php">Start browsing now!</a></label>
            </div>
            <br/>
    </div>
    </div>




   <?php include("basicFooter.php"); 


