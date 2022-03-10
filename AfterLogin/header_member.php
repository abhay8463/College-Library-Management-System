<html>
	<head>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700">
		<link rel="stylesheet" type="text/css" href="css/header_member_style.css" />
	</head>
	<body>
		<header>
			<div id="cd-logo">
				<a href="../AfterLogin/home.php">
					<img src="../assets/img/logo.png" alt="Logo" height="95%" />
					<p>VesLib</p>
				</a>
			</div>
			
			<div class="dropdown">
				<button class="dropbtn">
					<p id="librarian-name"><?php session_start(); echo $_SESSION['email'] ?></p>
				</button>
				<div class="dropdown-content">
					<a>
						<?php
							$query = $con->prepare("SELECT libCard FROM registered WHERE email = ?;");
							$query->bind_param("s", $_SESSION['email']);
							$query->execute();
							$balance = (int)$query->get_result()->fetch_array()[0];
							echo "Lib Card: ".$balance;
							
						?>
					</a>
					<a href="my_books.php">My books</a>
					<a href="../php/logout.php">Logout</a>
				</div>
			</div>
		</header>
	</body>
</html>