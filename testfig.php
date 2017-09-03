    <!DOCTYPE html>
<html>
<head> 
    <title>Touro Textbook Gemach</title>

<link rel="stylesheet" href= "styles/themeStyle.css"/>

</head>
<body>
    <div> <ul>
   
      <li>
        
        <figure>
            <img src="images/books/pppppppppp20170901183806.jpg" height =200px; width=200px;>
             <figcaption><strong>Nam libero tempore.</strong> ssumendagfffffffffffffffffffffffff fffffffffgdfgdfghfdhfdhfdh fhfdhfdhfdhfdhfdhdfhfdhfd</figcaption>
         </figure>
            <h4> Title: Hwllo</h4>
          <p> ISBN: 12112131</p>
       
          <form method="post" action="deleteBook.php">
         <input type="hidden" name="seller" value='.$row["sellerID"].'>
         <input type="hidden" name="bookisbn" value='.$row["ISBN"].'>
         <input type="hidden" name="seller_book_id" value='.$row["Seller_BookID"].'>
          <input type="submit" value="Remove" />
        </form>
      </li>
        </ul> </div>
    