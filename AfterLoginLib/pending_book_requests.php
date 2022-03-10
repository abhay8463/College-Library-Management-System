<?php
	require "../php/db_connect.php";
	require "../php/message_display.php";
	require "verify_librarian.php";
	require "header_librarian.php";
?>

<html>
	<head>
		<title>Pending Book Requests</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="../css/custom_checkbox_style.css">
		<link rel="stylesheet" type="text/css" href="css/pending_book_requests_style.css">
		<link rel="stylesheet" type="text/css" href="css/searchBar.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
		<!-- SEARCH -->
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
				$query1 = $con->prepare("SELECT * FROM pending_book_requests where libCard like '%$_POST[search]%' ");
				$query1->execute();
				$result1 = $query1->get_result();
				
				if(!$result1)
					die("ERROR: Couldn't fetch books");
				$rows = mysqli_num_rows($result1);
				if($rows == 0)
					echo "<h2 align='center'>No requests for this lib Card</h2>";
				else
				{
					echo "<form class='cd-form' method='POST' action='#'>";
					echo "<legend>Pending book requests</legend>";
					echo "<div class='error-message' id='error-message'>
							<p id='error'></p>
						</div>";
					echo "<table width='100%' cellpadding=10 cellspacing=10>
							<tr>
								<th></th>
								<th>LibCard<hr></th>
								<th>Book<hr></th>
								<th>Time<hr></th>
							</tr>";
					for($i=0; $i<$rows; $i++)
					{
						$row = mysqli_fetch_array($result1);
						echo "<tr>";
						echo "<td>
								<label class='control control--checkbox'>
									<input type='checkbox' name='cb_".$i."' value='".$row[0]."' />
									<div class='control__indicator'></div>
								</label>
							</td>";
						for($j=1; $j<4; $j++)
							echo "<td>".$row[$j]."</td>";
						echo "</tr>";
					}
					echo "</table>";
					echo "<br /><br /><div style='float: right;'>";
					echo "<input type='submit' value='Reject selected' name='l_reject' />&nbsp;&nbsp;&nbsp;&nbsp;";
					echo "<input type='submit' value='Grant selected' name='l_grant'/>";
					echo "</div>";
					echo "</form>";
				}
				
			}
			else
			{
				$query = $con->prepare("SELECT * FROM pending_book_requests;");
				$query->execute();
				$result = $query->get_result();;
				$rows = mysqli_num_rows($result);
				if($rows == 0)
					echo "<h2 align='center'>No requests pending</h2>";
				else
				{
					echo "<form class='cd-form' method='POST' action='#'>";
					echo "<legend>Pending book requests</legend>";
					echo "<div class='error-message' id='error-message'>
							<p id='error'></p>
						</div>";
					echo "<table width='100%' cellpadding=10 cellspacing=10>
							<tr>
								<th></th>
								<th>LibCard<hr></th>
								<th>Book<hr></th>
								<th>Time<hr></th>
							</tr>";
					for($i=0; $i<$rows; $i++)
					{
						$row = mysqli_fetch_array($result);
						echo "<tr>";
						echo "<td>
								<label class='control control--checkbox'>
									<input type='checkbox' name='cb_".$i."' value='".$row[0]."' />
									<div class='control__indicator'></div>
								</label>
							</td>";
						for($j=1; $j<4; $j++)
							echo "<td>".$row[$j]."</td>";
						echo "</tr>";
					}
					echo "</table>";
					echo "<br /><br /><div style='float: right;'>";
					echo "<input type='submit' value='Reject selected' name='l_reject' />&nbsp;&nbsp;&nbsp;&nbsp;";
					echo "<input type='submit' value='Grant selected' name='l_grant'/>";
					echo "</div>";
					echo "</form>";
				}
				// SEARCH and printing ENDS
				
				$header = 'From: <noreply@library.com>' . "\r\n";
				
				if(isset($_POST['l_grant']))
				{
					$requests = 0;
					for($i=0; $i<$rows; $i++)
					{
						if(isset($_POST['cb_'.$i]))
						{
							$request_id =  $_POST['cb_'.$i];
							$query = $con->prepare("SELECT libCard, book_isbn FROM pending_book_requests WHERE request_id = ?;");
							$query->bind_param("d", $request_id);
							$query->execute();
							$resultRow = mysqli_fetch_array($query->get_result());
							$libCard = $resultRow[0];
							$isbn = $resultRow[1];
							$query = $con->prepare("INSERT INTO book_issue_log(libCard, book_isbn) VALUES(?, ?);");
							$query->bind_param("is", $libCard, $isbn);
							if(!$query->execute())
								die(error_without_field("ERROR: Couldn\'t issue book"));
							$requests++;
							
							$query = $con->prepare("SELECT email FROM registered WHERE libCard = ?;");
							$query->bind_param("i", $libCard);
							$query->execute();
							$to = mysqli_fetch_array($query->get_result())[0];
							$subject = "Book successfully issued";
							
							$query = $con->prepare("SELECT title FROM book WHERE isbn = ?;");
							$query->bind_param("s", $isbn);
							$query->execute();
							$title = mysqli_fetch_array($query->get_result())[0];
							
							$query = $con->prepare("SELECT due_date FROM book_issue_log WHERE libCard = ? AND book_isbn = ?;");
							$query->bind_param("ss", $libCard, $isbn);
							$query->execute();
							$due_date = mysqli_fetch_array($query->get_result())[0];
							$message = "The book '".$title."' with ISBN ".$isbn." has been issued to your account. The due date to return the book is ".$due_date.".";
							
							mail($to, $subject, $message, $header);
						}
					}
					if($requests > 0)
						echo success("Successfully granted ".$requests." requests");
					else
						echo error_without_field("No request selected");
				}
				
				if(isset($_POST['l_reject']))
				{
					$requests = 0;
					for($i=0; $i<$rows; $i++)
					{
						if(isset($_POST['cb_'.$i]))
						{
							$requests++;
							$request_id =  $_POST['cb_'.$i];
							
							$query = $con->prepare("SELECT libCard, book_isbn FROM pending_book_requests WHERE request_id = ?;");
							$query->bind_param("d", $request_id);
							$query->execute();
							$resultRow = mysqli_fetch_array($query->get_result());
							$libCard = $resultRow[0];
							$isbn = $resultRow[1];
							//var_dump($libCard);
							$query = $con->prepare("SELECT email FROM registered WHERE libCard = ?;");
							$query->bind_param("i", $libCard);
							$query->execute();
							$to = mysqli_fetch_array($query->get_result())[0];
							$subject = "Book issue rejected";
							
							$query = $con->prepare("SELECT title FROM book WHERE isbn = ?;");
							$query->bind_param("s", $isbn);
							$query->execute();
							$title = mysqli_fetch_array($query->get_result())[0];
							$message = "Your request for issuing the book '".$title."' with ISBN ".$isbn." has been rejected. You can request the book again or visit a librarian for further information.";
							
							$query = $con->prepare("DELETE FROM pending_book_requests WHERE request_id = ?");
							$query->bind_param("d", $request_id);
							if(!$query->execute())
								die(error_without_field("ERROR: Couldn\'t delete values"));
							
							mail($to, $subject, $message, $header);
						}
					}
					if($requests > 0)
						echo success("Successfully deleted ".$requests." requests");
					else
						echo error_without_field("No request selected");
			}
			}