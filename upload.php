
<?php
session_start();

// check all required complete

if (!empty($_POST)) {

	// check if anything is incomplete

	$rqrd = array(
		'title',
		'author',
		'isbn'
	);
	foreach($rqrd as $field) {
		if (empty($_POST[$field])) {
			die(header("location:addBook.php?error=true&reason=empty_field"));
		}
	}

	// check isbn length (X is allowed as last char, so cant check for number)

	if (strlen((string)$_POST['isbn']) !== 10 && strlen((string)$_POST['isbn']) !== 13) {
		die(header("location:addBook.php?error=true&reason=invalid_isbn"));
	}
        
        if(!empty(($_POST['edition']))&& (!is_numeric($_POST['edition']) || !$_POST['edition'] > 0)){
        die(header("location:addBook.php?error=true&reason=editionnumeric"));
        }
            
        

	// $target_dir = ;

	/***************************************************************************/

	// check if uploaded file is reasonable
	// code modified from W3 schools https://www.w3schools.com/php/php_file_upload.asp

	$target_dir = "./images/books/";

	// $filepath = $target_dir.'na.jpg';

	$uploadOk = 1;
	$uploaded_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = pathinfo($uploaded_file, PATHINFO_EXTENSION); 
	$target_file = $target_dir . $_POST['isbn'].date("YmdHis").'.'. $imageFileType; //has file name as user sees it
        
        //user did not upload a file
	if (empty($_FILES['fileToUpload']["tmp_name"])) {
		$filepath = $target_dir . 'na.jpg';
          //  die(header("location:addBook.php?error=true&reason=issue"));

   	}
	else {

		// Check if image file is a actual image or fake image

		if (isset($_POST["submit"]) && isset($_FILES['fileToUpload'])) {
			if ($_FILES['fileToUpload']['error'] === UPLOAD_ERR_INI_SIZE) {

				// if(empty($_FILES['fileToUpload']["tmp_name"])){

				die(header("location:addBook.php?error=true&reason=file_too_large" . $filepath));
			}

			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if ($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			}
			else {
				echo "File is not an image.";
				die(header("location:addBook.php?error=true&reason=file_not_img" . $filepath));
				$uploadOk = 0;
			}

			// Check if file already exists

			if (file_exists($target_file)) {

				// dont upload new image just set filepath to that image

				/********************INCOMPLETE*************************/
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}

			// Check file size

			if ($_FILES["fileToUpload"]["size"] > 500000) {
				die(header("location:addBook.php?error=true&reason=file_too_large" . $filepath));
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}

			// Allow certain file formats

			if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
				die(header("location:addBook.php?error=true&reason=file_not_img" . $filepath));
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error

			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";

				// if everything is ok, try to upload file

			}
			else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
					$filepath = $target_file;
				}
				else {
					die(header("location:addBook.php?error=true&reason=error_move_file". $target_file));
					echo "Sorry, there was an error uploading your file.";
				}
			}
		}
	}


// ready to insert into database:

$author = $_POST['author'];
$title = $_POST['title'];
$edition = $_POST['edition'];
$notes = $_POST['notes'];
$isbn = $_POST['isbn'];
include 'dbConnection.php';

// mysqli_autocommit($conn, FALSE);

mysqli_begin_transaction($conn);

$email = $_SESSION['user'];
//what happens if seller with that email doesn't exist
$stmt = mysqli_prepare($conn, "select userID from `seller` where `email` = ?") or die(mysqli_error($conn));

mysqli_stmt_bind_param($stmt, 's', $email);

if (!mysqli_stmt_execute($stmt)) {
	mysqli_rollback($conn);
}

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result);
$sellerID = $row["userID"];


$stmt = mysqli_prepare($conn, "INSERT INTO `book` (`sellerID`,`ISBN`, `Title`, `Author`, `Edition`, `Notes`,`imageurl`)"
        . " VALUES (?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'issssss', $sellerID, $isbn, $title, $author, $edition, $notes, $filepath);

if (!mysqli_stmt_execute($stmt)) {
    die(mysqli_error($conn));
	mysqli_rollback($conn);
}
   //commit to db
mysqli_commit($conn);

die(header("location:confirmBookAdded.php?title=$title&author=$author&isbn=$isbn" . $filepath));


}

