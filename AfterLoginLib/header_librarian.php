<html>
	<head>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700">
		<link rel="stylesheet" type="text/css" href="css/header_librarian_style.css" />
	</head>
	<body>
		<header>
			<div id="cd-logo">
				<a href="../AfterLoginLib/home.php">
					<img src="../assets/img/logo.png" alt="Logo" height="95%" />
					<p>VesLib</p>
				</a>
			</div>
			
			<div class="dropdown">
				<button class="dropbtn">
					<p id="librarian-name"><?php echo $_SESSION['email'] ?></p>
				</button>
				<div class="dropdown-content">
					<a href="../php/logout.php">Logout</a>
				</div>
			</div>
		</header>
	</body>
</html>