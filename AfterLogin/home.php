<?php
	require "../php/db_connect.php";
	require "../php/message_display.php";
	// require "verify_member.php";
	require "header_member.php";
	//var_dump($_SESSION);
?>

<html>
	<head>
		<title>Welcome</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="css/home_style.css">
		<link rel="stylesheet" type="text/css" href="css/searchBar.css">
		<link rel="stylesheet" type="text/css" href="../css/custom_radio_button_style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
	<!--___________________search bar________________________-->

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
				$query1 = $con->prepare("SELECT * from book where title like '%$_POST[search]%' OR author LIKE '%$_POST[search]%' OR category LIKE '%$_POST[search]%' OR isbn LIKE '%$_POST[search]%' ");
				$query1->execute();
				$result1 = $query1->get_result();
				
				if(!$result1)
					die("ERROR: Couldn't fetch books");
				$rows = mysqli_num_rows($result1);
				if($rows == 0)
					echo "<h2 align='center'>No books available</h2>";
				else
				{
					echo "<form class='cd-form' method='POST' action='#'>";
					echo "<legend>Available books</legend>";
					echo "<div class='error-message' id='error-message'>
							<p id='error'></p>
						</div>";
					echo "<table width='100%' cellpadding=10 cellspacing=10>";
					echo "<tr>
							<th></th>
							<th>ISBN<hr></th>
							<th>Title<hr></th>
							<th>Author<hr></th>
							<th>Category<hr></th>
							<!--<th>Price<hr></th>-->
							<th>Copies available<hr></th>
						</tr>";
					for($i=0; $i<$rows; $i++)
					{
						$row = mysqli_fetch_array($result1);
						echo "<tr>
								<td>
									<label class='control control--radio'>
										<input type='radio' name='rd_book' value=".$row[0]." />
									<div class='control__indicator'></div>
								</td>";
						for($j=0; $j<5; $j++)
							if($j == 4)
								echo "<td>".$row[$j]."</td>";
							else
								echo "<td>".$row[$j]."</td>";
						echo "</tr>";
					}
					echo "</table>";
					echo "<br /><br /><input type='submit' name='m_request' value='Request book' />";
					echo "</form>";
				}
			}
			else
			{
				$query = $con->prepare("SELECT * FROM book ORDER BY title");
				$query->execute();
				$result = $query->get_result();
				//var_dump($result);
				if(!$result)
					die("ERROR: Couldn't fetch books");
				$rows = mysqli_num_rows($result);
				if($rows == 0)
					echo "<h2 align='center'>No books available</h2>";
				else
				{
					echo "<form class='cd-form' method='POST' action='#'>";
					echo "<legend>Available books</legend>";
					echo "<div class='error-message' id='error-message'>
							<p id='error'></p>
						</div>";
					echo "<table width='100%' cellpadding=10 cellspacing=10>";
					echo "<tr>
							<th></th>
							<th>ISBN<hr></th>
							<th>Title<hr></th>
							<th>Author<hr></th>
							<th>Category<hr></th>
							<!--<th>Price<hr></th>-->
							<th>Copies available<hr></th>
						</tr>";
					for($i=0; $i<$rows; $i++)
					{
						$row = mysqli_fetch_array($result);
						echo "<tr>
								<td>
									<label class='control control--radio'>
										<input type='radio' name='rd_book' value=".$row[0]." />
									<div class='control__indicator'></div>
								</td>";
						for($j=0; $j<5; $j++)
							if($j == 4)
								echo "<td>".$row[$j]."</td>";
							else
								echo "<td>".$row[$j]."</td>";
						echo "</tr>";
					}
					echo "</table>";
					echo "<br /><br /><input type='submit' name='m_request' value='Request book' />";
					echo "</form>";
				}
			}
																// SEARCH END 
			if(isset($_POST['m_request']))
			{
				if(empty($_POST['rd_book']))
					echo error_without_field("Please select a book to issue");
				else
				{
					$query = $con->prepare("SELECT copies FROM book WHERE isbn = ?;");
					$query->bind_param("s", $_POST['rd_book']);
					$query->execute();
					$copies = mysqli_fetch_array($query->get_result())[0];
					if($copies == 0)
						echo error_without_field("No copies of the selected book are available");
					else
					{
						$query = $con->prepare("SELECT request_id FROM pending_book_requests WHERE libCard = ?;");
						$query->bind_param("i", $_SESSION['libCard']);
						$query->execute();
						if(mysqli_num_rows($query->get_result()) == 1)
							echo error_without_field("You can only request one book at a time");
						else
						{
							$query = $con->prepare("SELECT book_isbn FROM book_issue_log WHERE libCard = ?;");
							$query->bind_param("i", $_SESSION['libCard']);
							$query->execute();
							$result = $query->get_result();
							if(mysqli_num_rows($result) >= 2)
								echo error_without_field("You cannot issue more than 2 books at a time");
							else
							{
								$rows = mysqli_num_rows($result);
								for($i=0; $i<$rows; $i++)
									if(strcmp(mysqli_fetch_array($result)[0], $_POST['rd_book']) == 0)
										break;
								if($i < $rows)
									echo error_without_field("You have already issued a copy of this book");
								else
								{
									//$query = $con->prepare("SELECT balance FROM member WHERE username = ?;");
									//$query->bind_param("s", $_SESSION['username']);
									//$query->execute();
									//$memberBalance = mysqli_fetch_array($query->get_result())[0];
									
									//$query = $con->prepare("SELECT price FROM book WHERE isbn = ?;");
									//$query->bind_param("s", $_POST['rd_book']);
									//$query->execute();
									//$bookPrice = mysqli_fetch_array($query->get_result())[0];
									//if($memberBalance < $bookPrice)
									//	echo error_without_field("You do not have sufficient balance to issue this book");
									//else
									//{
										$query = $con->prepare("INSERT INTO pending_book_requests(libCard, book_isbn) VALUES(?, ?);");
										$query->bind_param("is", $_SESSION['libCard'], $_POST['rd_book']);
										//var_dump($_SESSION);
										if(!$query->execute())
											echo error_without_field("ERROR: Couldn\'t request book");
										else
											echo success("Book successfully requested. You will be notified by email when the book is issued to your account");
									//}
								}
							}
						}
					}
				}
			}
		?>
	</body>
</html>