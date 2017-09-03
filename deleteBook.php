<?php

 require 'dbConnection.php';
    $result = NULL;
if(!isset($_POST['seller_book_id'])){
    echo 'ERORR!!!!!';
    die();
}

$image = $_POST['imageurl'];

    //get selected books from the db
    $stmt = mysqli_prepare($conn, "Delete FROM `seller_book` WHERE `Seller_BookID` =?") or die(mysqli_error($conn));
   
    //for procedure call
//    mysqli_query($connection, 
//     "CALL StoreProcName") or die("Query fail: " . mysqli_error());
    
    mysqli_stmt_bind_param($stmt, 'i', $_POST['seller_book_id']);
    
    
   if(mysqli_stmt_execute($stmt)){
       //it worked!
     
       
       //delete img from server
       if(strpos($image, 'na.jpg')!== false){
    //the image is na.jpg DO NOT DELETE!
        }else{
            //delete the image
            unlink($image);
        }
          die(header("location:myAddedBooks.php?$image"));
       
   }
   else{
       //ERROR that id may not have existed? is that a failed query?
   die(mysqli_error($conn));

   }
   
   
 

