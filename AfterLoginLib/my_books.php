<?php
	require "../php/db_connect.php";
	require "../php/message_display.php";
	require "verify_librarian.php";
	require "header_librarian.php";
?>

<html>
	<head>
		<title>My books</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="../css/custom_checkbox_style.css">
		<link rel="stylesheet" type="text/css" href="css/my_books_style.css">
		<link rel="stylesheet" type="text/css" href="css/searchBar2.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
		<div class="srch">
			<form class="navbar-form" method="post" name="form1">
				<!--<input class="form-control mr-sm-8" type="search" name="search" placeholder="Search here" aria-label="Search">-->
				<input type="text" name="search" placeholder="Search books here..">
    			<button class="btn btn-outline-success my-2 my-sm-0" name="submit" type="submit">Search</button>
				<!-- <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">
  				<button class="btn aqua-gradient btn-rounded btn-sm my-0" type="submit" name="submit">Search</button> -->
				<!-- <input class="form-control" type="text" name="search" placeholder="search books.." required="">
				<button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-default">
					<span class="glyphicon glyphicon-search"></span>
				</button> -->
			</form>
		</div>
	
	<!--<div class="search__container">
		<p class="search__title">
			Go ahead, hover over search
		</p>
		<input class="search__input" type="text" placeholder="Search">
	</div>-->

		<?php
			//session_start();
			if(isset($_POST['submit']))
			{
				$query = $con->prepare("SELECT libCard, book_isbn, due_date, issue_id FROM book_issue_log where libCard like '%$_POST[search]%';");
				//$query->bind_param("is", $_SESSION['libCard']);
				$query->execute();
				$result = $query->get_result();
				//var_dump($query);
				$rows = mysqli_num_rows($result);
				if($rows == 0)
					echo "<h2 align='center'>No books currently issued for this libCard</h2>";
				else
				{
					echo "<form class='cd-form' method='POST' action='#'>";
					echo "<legend>Issued Books</legend>";
					echo "<div class='success-message' id='success-message'>
							<p id='success'></p>
						</div>";
					echo "<div class='error-message' id='error-message'>
							<p id='error'></p>
						</div>";
					echo"<table width='100%' cellpadding='10' cellspacing='10'>
							<tr>
								<th></th>
								<th>LibCard<hr></th>
								<th>ISBN<hr></th>
								<th>Title<hr></th>
								<th>Author<hr></th>
								<th>Category<hr></th>
								<th>Due Date<hr></th>
								<th>Fines Due<hr></th>
							</tr>";
					for($i=0; $i<$rows; $i++)
					{
						$row = mysqli_fetch_array($result);
						$isbn = $row[1];
						$libCard = $row[0];
						
						if($isbn != NULL)
						{
							$query = $con->prepare("SELECT title, author, category FROM book WHERE isbn = ?;");
							$query->bind_param("s", $isbn);
							$query->execute();
							$innerRow = mysqli_fetch_array($query->get_result());
							echo "<tr>
									<td>
										<label class='control control--checkbox'>
											<input type='checkbox' name='cb_book".$i."' value='".$isbn.",".$libCard."'>
											<div class='control__indicator'></div>
										</label>
									</td>";
							echo "<td>".$libCard."</td>";
							echo "<td>".$isbn."</td>";
							for($j=0; $j<3; $j++)
								echo "<td>".$innerRow[$j]."</td>";
							$query = $con->prepare("SELECT due_date FROM book_issue_log WHERE libCard = ? AND book_isbn = ?;");
							$query->bind_param("ss",$libCard, $isbn);
							$query->execute();
							$due_date = mysqli_fetch_array($query->get_result())[0];
							$DueDate=date_create($due_date);
							$CurrDate=date_create(date("Y/m/d"));
							$diff=date_diff($DueDate,$CurrDate);
							$days=(int)$diff->format("%R%a");
							if ($days>0)
							{
								echo '<td style="color:Red;"><b><center>'.$due_date.'</center></b></td>';
								echo '<td><center>₹'.($days*5).'</center></td>';
								echo "</tr>";
							}
							else if ($days==0)
							{
								echo '<td style="color:DarkOrange;"><b><center>'.$due_date.'</center></b></td>';
								echo '<td><center>₹0</center></td>';
								echo "</tr>";
							}
							else
							{
								echo "<td><center>".$due_date."</center></td>";
								echo '<td><center>₹0</center></td>';
								echo "</tr>";
							}
						}
					}
					echo "</table><br />";
					echo "<input type='submit' name='b_return' value='Return selected books' />";
					echo "</form>";
				}
				
			}
			else
			{
				$query = $con->prepare("SELECT libCard, book_isbn, due_date, issue_id FROM book_issue_log;");
				//$query->bind_param("is", $_SESSION['libCard']);
				$query->execute();
				$result = $query->get_result();
				//var_dump($query);
				$rows = mysqli_num_rows($result);
				if($rows == 0)
					echo "<h2 align='center'>No books currently issued</h2>";
				else
				{
					echo "<form class='cd-form' method='POST' action='#'>";
					echo "<legend>Issued Books</legend>";
					echo "<div class='success-message' id='success-message'>
							<p id='success'></p>
						</div>";
					echo "<div class='error-message' id='error-message'>
							<p id='error'></p>
						</div>";
					echo"<table width='100%' cellpadding='10' cellspacing='10'>
							<tr>
								<th></th>
								<th>LibCard<hr></th>
								<th>ISBN<hr></th>
								<th>Title<hr></th>
								<th>Author<hr></th>
								<th>Category<hr></th>
								<th>Due Date<hr></th>
								<th>Fines Due<hr></th>
							</tr>";
					for($i=0; $i<$rows; $i++)
					{
						$row = mysqli_fetch_array($result);
						$isbn = $row[1];
						$libCard = $row[0];
						
						if($isbn != NULL)
						{
							$query = $con->prepare("SELECT title, author, category FROM book WHERE isbn = ?;");
							$query->bind_param("s", $isbn);
							$query->execute();
							$innerRow = mysqli_fetch_array($query->get_result());
							echo "<tr>
									<td>
										<label class='control control--checkbox'>
											<input type='checkbox' name='cb_book".$i."' value='".$isbn.",".$libCard."'>
											<div class='control__indicator'></div>
										</label>
									</td>";
							echo "<td>".$libCard."</td>";
							echo "<td>".$isbn."</td>";
							for($j=0; $j<3; $j++)
								echo "<td>".$innerRow[$j]."</td>";
							$query = $con->prepare("SELECT due_date FROM book_issue_log WHERE libCard = ? AND book_isbn = ?;");
							$query->bind_param("ss",$libCard, $isbn);
							$query->execute();
							$due_date = mysqli_fetch_array($query->get_result())[0];
							$DueDate=date_create($due_date);
							$CurrDate=date_create(date("Y/m/d"));
							$diff=date_diff($DueDate,$CurrDate);
							$days=(int)$diff->format("%R%a");
							if ($days>0)
							{
								echo '<td style="color:Red;"><b><center>'.$due_date.'</center></b></td>';
								echo '<td><center>₹'.($days*5).'</center></td>';
								echo "</tr>";
							}
							else if ($days==0)
							{
								echo '<td style="color:DarkOrange;"><b><center>'.$due_date.'</center></b></td>';
								echo '<td><center>₹0</center></td>';
								echo "</tr>";
							}
							else
							{
								echo "<td><center>".$due_date."</center></td>";
								echo '<td><center>₹0</center></td>';
								echo "</tr>";
							}
						}
					}
					echo "</table><br />";
					echo "<input type='submit' name='b_return' value='Return selected books' />";
					echo "</form>";
				}
			}
			
			if(isset($_POST['b_return']))
			{
				$books = 0;
				for($i=0; $i<$rows; $i++)
				{
					//var_dump($row);
					if(isset($_POST['cb_book'.$i]))
					{
						/*$query = $con->prepare("SELECT due_date FROM book_issue_log WHERE libCard = ? AND book_isbn = ?;");
						$query->bind_param("ss", $_SESSION['libCard'], $_POST['cb_book'.$i]);
						$query->execute();
						$due_date = mysqli_fetch_array($query->get_result())[0];
						
						$query = $con->prepare("SELECT DATEDIFF(CURRENT_DATE, ?);");
						$query->bind_param("s", $due_date);
						$query->execute();
						$days = (int)mysqli_fetch_array($query->get_result())[0];*/
				
						$query = $con->prepare("DELETE FROM book_issue_log WHERE libCard = ? AND book_isbn = ?;");
						$keywords = preg_split("/[\s,]+/", $_POST['cb_book'.$i]);
						$query->bind_param("ss", $keywords[1],$keywords[0] );
						//var_dump($keywords);
						if(!$query->execute())
							die(error_without_field("ERROR: Couldn\'t return the books"));
						
						// if($days > 0)
						// {
						// 	$penalty = 5*$days;
						// 	$query = $con->prepare("SELECT price FROM book WHERE isbn = ?;");
						// 	$query->bind_param("s", $_POST['cb_book'.$i]);
						// 	$query->execute();
						// 	$price = mysqli_fetch_array($query->get_result())[0];
						// 	if($price < $penalty)
						// 		$penalty = $price;
						// 	$query = $con->prepare("UPDATE member SET balance = balance - ? WHERE username = ?;");
						// 	$query->bind_param("ds", $penalty, $_SESSION['username']);
						// 	$query->execute();
						// 	echo '<script>
						// 			document.getElementById("error").innerHTML += "A penalty of Rs. '.$penalty.' was charged for keeping book '.$_POST['cb_book'.$i].' for '.$days.' days after the due date.<br />";
						// 			document.getElementById("error-message").style.display = "block";
						// 		</script>';
						// }
						 $books++;
					}
				}
				if($books > 0)
				{
					//echo '<script>
					//		document.getElementById("success").innerHTML = "Successfully returned '.$books.' books";
					//		document.getElementById("success-message").style.display = "block";
					//	</script>';
					echo error_without_field("Successfully returned $books books");
					// $query = $con->prepare("SELECT balance FROM member WHERE username = ?;");
					// $query->bind_param("s", $_SESSION['username']);
					// $query->execute();
					
					// $balance = (int)mysqli_fetch_array($query->get_result())[0];
					// if($balance < 0)
					// 	header("Location: ../logout.php");
				}
				else
					echo error_without_field("Please select a book to return");
			}
		?>
		
	</body>
</html>