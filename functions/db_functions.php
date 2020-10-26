<?php
	$db = mysqli_connect("localhost", "root", "", "sh_bookstore");
	
	function getUserId($name){
		global $db;
		$result = mysqli_query($db, "SELECT id FROM users WHERE username = '$name'");

		if($result){
			$row = mysqli_fetch_assoc($result);
			return $row["id"];
		} else {
			return null;
		}
	}
	
	function getOrderId($user_id, $date){
		global $db;
			$result = mysqli_query($db, "SELECT order_id FROM orders WHERE user_id = '$user_id' AND date = '$date';");
			if(!$result){
				echo "retrieve data failed!" . mysqli_error($db);
				exit;
			}
			$row = mysqli_fetch_assoc($result);
			return $row["order_id"];
	}

	function insertIntoOrder($user_id, $total, $date){
		global $db;
		$result = mysqli_query($db, "INSERT INTO orders (user_id, total, date) VALUES ('$user_id', '$total', '$date');");
		if(!$result){
			echo "Insert order failed" . mysqli_error($db);
			exit;
		}
	}

	function getBookPrice($isbn){
		global $db;
		$result = mysqli_query($db, "SELECT book_price FROM books WHERE book_isbn = '$isbn';");
		if(!$result){
			echo "get book price failed! " . mysqli_error($db);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row["book_price"];
	}

	function uploadImage(){
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validExtension = ['jpg', 'png', 'jpeg'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    if(!in_array($fileExtension, $validExtension)) {
      header('Location: ./admin_books_add.php?error=ext');
      exit;
    }

    if($fileSize > 1000000) {
      header('Location: ./admin_books_add.php?error=size');
      exit;
    }

    $newName = $_POST["isbn"];
    $newName .= ".";
    $newName .= $fileExtension;
    move_uploaded_file($tmpName, './images/' . $newName);

    return $newName;
  }

?>