<?php
        require_once("navigator.php");
        ?>
<html>
    <head>
       
        <link rel="stylesheet" href= "styles/searchbooksStyles.css">
    </head>


    <div id ="space"> </div>



    <div style="width:100%">
        <div id="inner">
            <form action="searchBooks.php" method="post">
                <input class="bigsearch" name = "search" type="text" placeholder="enter book title or ISBN"  /> 
                <input type="image"  src="images/search-9-64.png" width="25" height="25" alt="Submit">

                <br/>

                <?php
                require_once 'dbConnection.php';

                $result = mysqli_query($conn, "select campusName FROM campus");



                // Add checkbox options
                while ($row = mysqli_fetch_array($result)) {
                    $cn = $row["campusName"];
                    $options = '<input type="checkbox" name = "campus[]" value="' . $cn . '"/>' . $cn;
                    echo $options;
                }
                ?>

            </form>
        </div>

        <br/>      
        <br/>
        <ul class="books">
            <?php
            require_once 'dbConnection.php';
            $result = NULL;
//if campus or search bar filled in
            if ((isset($_POST['search']) && $_POST['search'] != "") || (isset($_POST['campus']) && $_POST['campus'] != "")) {
                
//if campus and search bar completed
                if ((isset($_POST['search']) && $_POST['search'] != "") && (isset($_POST['campus']) && $_POST['campus'] != "")) {

                    $selected_campuses = implode(",", $_POST['campus']);


                    $stmt = mysqli_prepare($conn, "SELECT `sellerID`, `ISBN`,`Title`,`Author`,`Edition`,`Notes`,`imageurl` 
                                                    FROM
                                                    (SELECT `sellerID`, `ISBN`,`Title`,`Author`,`Edition`,`Notes`,`imageurl`, `campusID`
                                                            FROM `book` 
                                                                    INNER join seller 
                                                                        on book.SellerID = seller.userID
                                                                            INNER join campus 
                                                                                on campus.CampusID = seller.campus
                                                                 WHERE `Title` like CONCAT('%',?,'%') or  `ISBN` like CONCAT('%',?,'%') ) as t1

                                                                 INNER join campus 
                                                                        on campus.CampusID = t1.campusID
                                                                 where CampusName in (?)") or die(mysqli_error($conn));


                    $search = $_POST['search'];



                    mysqli_stmt_bind_param($stmt, 'sss', $search, $search, $selected_campuses);

//                    }
                }
//only campus set
                else if (isset($_POST['campus']) && $_POST['campus'] != "") {

                    $selected_campuses = implode(",", $_POST['campus']);

                    $stmt = mysqli_prepare($conn, "SELECT `sellerID`, `ISBN`,`Title`,`Author`,`Edition`,`Notes`,`imageurl` 
                                                    FROM
                                                    (SELECT `sellerID`, `ISBN`,`Title`,`Author`,`Edition`,`Notes`,`imageurl`, `campusID`
                                                            FROM `book` 
                                                                    INNER join seller 
                                                                        on book.SellerID = seller.userID
                                                                            INNER join campus 
                                                                                on campus.CampusID = seller.campus)
                                                                as t1

                                                                 INNER join campus 
                                                                        on campus.CampusID = t1.campusID
                                                                 where CampusName in (?)") or die(mysqli_error($conn));


                    mysqli_stmt_bind_param($stmt, 's', $selected_campuses);
                }
//only search set
                else if (isset($_POST['search'])) {
                    $search = $_POST['search'];

                    $stmt = mysqli_prepare($conn, "SELECT `sellerID`, `ISBN`,`Title`,`Author`,`Edition`,`Notes`,`imageurl` FROM `book` "
                            . " WHERE `Title` like CONCAT('%',?,'%') or  `ISBN` like CONCAT('%',?,'%')") or die(mysqli_error($conn));

                    mysqli_stmt_bind_param($stmt, 'ss', $search, $search);
                }

                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_array($result)) {
                    if ($row['Edition'] == 0) {
                        $edition = "N/A";
                    } else {
                        $edition = $row['Edition'];
                    }
                    echo '<li>
         
          <figure>
         <img src="' . $row['imageurl'] . '" height =200px; width=200px;>
              <figcaption>Edition: ' . $edition .
                    '<br>' . $row['Notes'] . '</figcaption>
             </figure>
            <h4> Title:' . $row['Title'] . '</h4>
          <p> ISBN: ' . $row['ISBN'] . '</p>
        
          <form method="post" action="buyBook.php">
         <input type="hidden" name="seller" value=' . $row["sellerID"] . '>
         <input type="submit" value="Connect!" />
        </form>
      </li>';
                }
            } //none are set view all books
            else {
                $sql = "SELECT `sellerID`, `ISBN`, `Title`, `Author`, `Edition`, `Notes`, `imageurl` "
                        . "FROM `book` ";
                $result = mysqli_query($conn, $sql);


                if (mysqli_num_rows($result) > 0) {

                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['Edition'] == 0) {
                            $edition = "N/A";
                        } else {
                            $edition = $row['Edition'];
                        }

                        echo '<li>
         <figure>
         <img src="' . $row['imageurl'] . '" height =200px; width=200px;>
              <figcaption>Edition: ' . $edition .
                        '<br>' . $row['Notes'] . '</figcaption>
             </figure>
            <h4> Title:' . $row['Title'] . '</h4>
          <p> ISBN: ' . $row['ISBN'] . '</p>
        
          <form method="post" action="buyBook.php">
         <input type="hidden" name="seller" value=' . $row["sellerID"] . '>
         <input type="submit" value="Connect!" />
        </form>
      </li>';
                    }
                }
                else {
                    echo "0 results";
                }
            }
            ?>
        </ul>

    </div>


<?php include 'basicFooter.php'; ?>



