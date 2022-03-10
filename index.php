<?php
	require "php/db_connect.php";
	require "php/message_display.php";
	require "php/logoutHomePg.php";
	require "php/verify_logged_out.php";
	ob_start();

?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<title>SlidinLogin</title>
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/Contact-Form-v2-Modal--Full-with-Google-Map.css">
		<link rel="stylesheet" href="assets/css/styles-1.css">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body style="background: url(&quot;assets/img/bgLib.png&quot;);">
		<nav class="navbar navbar-light navbar-expand-md" style="background: linear-gradient(180deg, white, #772f1a 50%);opacity: 0.72;color: rgb(28,120,213);">
			<div class="container-fluid"><img id="logoNav" src="assets/img/logo.png" width="50px" height="100px" style="margin-top: 1%;opacity: 1;"><button data-toggle="collapse" class="navbar-toggler border-warning" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon justify-content-center" style="color: rgb(251,251,251);"></span></button>
				<div
					class="collapse navbar-collapse justify-content-end" id="navcol-1" style="color: rgb(197,22,11);">
					<ul class="nav navbar-nav">
						<li class="nav-item"><a class="nav-link active text-white" href="about.html" style="background: #5b1010;font-size: 18px;border-radius: 42px;padding: 8px;">About Us</a></li>
						<li class="nav-item"><a class="nav-link text-white" href="Contact.php" style="font-size: 18px;background: #5b1010;border-radius: 42px;padding: 8px;">Contact</a></li>
						<li class="nav-item"></li>
					</ul>
			</div>
			</div>
		</nav><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Domine">
	<div id="middleKeLiye" style="margin-top:10%;">
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form name="registration" id="signUpForm" method="POST" action="#">
				<h3>Create Account</h3>
				<span>and enjoy the feaures of this online library!!</span>
				<section class="error_selector">
				<input type="text" placeholder="Name" id="name" name="name" required>
				<small></small>
				</section>
				<section class="error_selector">
				<input tpye="text" placeholder="Library Card No." id="lid" name="lid" required minlength="6" maxlength="6">
				<small></small>
				</section>
				<section class="error_selector">
				<input type="email" placeholder="Email" id="email" name="email" required>
				<small></small>
				</section>
				<section class="error_selector" id="passSec" >
				<!-- <input type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" id="password">  -->
				<input onkeyup="trigger()" type="password" placeholder="Type password" id="password" name="password" required>
				<div class="indicator">
					<span class="weak"></span>
					<span class="medium"></span>
					<span class="strong"></span>
					
				</div>
				<div class="text m-2">
					
				</div>
				
				<small></small>
				
				</section>
				<script>
					const indicator = document.querySelector(".indicator");
					const input = document.getElementById('password');
					const weak = document.querySelector(".weak");
					const medium = document.querySelector(".medium");
					const strong = document.querySelector(".strong");
					const text = document.querySelector(".text");
					// const showBtn = document.querySelector(".showBtn");
					let regExpWeak = /[a-z]/;
					let regExpMedium = /\d+/;
					let regExpStrong = /.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/;
					function trigger(){
						console.log("neeraj mofo")
						console.log(input)
						if(input.value != ""){
						indicator.style.display = "block";
						indicator.style.display = "flex";
						if(input.value.length <= 3 && (input.value.match(regExpWeak) || input.value.match(regExpMedium) || input.value.match(regExpStrong)))no=1;
						if(input.value.length >= 6 && ((input.value.match(regExpWeak) && input.value.match(regExpMedium)) || (input.value.match(regExpMedium) && input.value.match(regExpStrong)) || (input.value.match(regExpWeak) && input.value.match(regExpStrong))))no=2;
						if(input.value.length >= 6 && input.value.match(regExpWeak) && input.value.match(regExpMedium) && input.value.match(regExpStrong))no=3;
						if(no==1){
							weak.classList.add("active");
							text.style.display = "block";
							text.textContent = "Your password is too week";
							text.classList.add("weak");
						}
						if(no==2){
							medium.classList.add("active");
							text.textContent = "Your password is medium";
							text.classList.add("medium");
						}else{
							medium.classList.remove("active");
							text.classList.remove("medium");
						}
						if(no==3){
							weak.classList.add("active");
							medium.classList.add("active");
							strong.classList.add("active");
							text.textContent = "Your password is strong";
							text.classList.add("strong");
						}else{
							strong.classList.remove("active");
							text.classList.remove("strong");
						}
						// showBtn.style.display = "block";
						// showBtn.onclick = function(){
							// if(input.type == "password"){
							// input.type = "text";
							// showBtn.textContent = "HIDE";
							// showBtn.style.color = "#23ad5c";
							// }else{
							// input.type = "password";
							// showBtn.textContent = "SHOW";
							// showBtn.style.color = "#000";
							// }
						// }
						}else{
						indicator.style.display = "none";
						text.style.display = "none";
						// showBtn.style.display = "none";
						}
					}
				</script>
				
				
				<button type="submit" name="signUP">Sign Up</button>
			</form>
		</div>
															<!-- SIGN UP ENDS -->
		<div class="form-container sign-in-container">
			<form action="#" id="signInForm" method="post">
				<h2 style="font-family:Domine; color:#8b0000"><b>VESIT LIBRARY</b></h2>
				
				<h3>Sign in</h3>
				<section class="error_selector">
				<input type="email" placeholder="Email" id="email2" name="email2">
				<small></small>
				</section>
				<section class="error_selector">
				<input type="password" placeholder="Password" id="password2" name="password2">
				<small></small>
				</section>
				<a href="#">Forgot your password?</a>
				<button type="submit" name="signIn" >Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<div><img src="assets/img/logo.png"></div>
					<h1>Hello, Reader!</h1>
					<p>Enter your personal details and start journey with us</p>
					<button class="ghost" id="signIn">Existing User?</button>
				</div>
				<div class="overlay-panel overlay-right">
					<span><img src="assets/img/logo.png"></span>
					<h1>Welcome Back!</h1>
					<p>To keep connected with us please login with your personal info</p>
					<button class="ghost" id="signUp">New User?</button>
				</div>
			</div>
		</div>
		</div></div>
		
		
		<!--<footer>
			<p>
				Created with <i class="fa fa-heart"></i> by
				<a target="_blank" href="https://florin-pop.com">Florin Pop</a>
				- Read how I created this and how you can join the challenge
				<a target="_blank" href="https://www.florin-pop.com/blog/2019/03/double-slider-sign-in-up-form/">here</a>.
			</p>
		</footer>-->



		<?php
		
			

			if(isset($_POST['signUP']))
			{
				$query = $con->prepare("(SELECT email FROM registered WHERE email = ?);");
				$query->bind_param("s", $_POST['email']);
				$query->execute();
				if(mysqli_num_rows($query->get_result()) != 0)
					echo error_with_field("The email you entered is already taken", "m_user");
				else
				{
					$query = $con->prepare("(SELECT libCard FROM registered WHERE libCard = ?);");
					$query->bind_param("i", $_POST['lid']);
					$query->execute();
					if(mysqli_num_rows($query->get_result()) != 0)
						echo error_with_field("An account is already registered with that Library Card", "lid");
					else
					{
						$query = $con->prepare("INSERT INTO registered(name, libCard, email, password) VALUES(?, ?, ?, ?);");
						$passwrd = sha1($_POST['password']);
						$query->bind_param("siss", $_POST['name'], $_POST['lid'], $_POST['email'], $passwrd);
						if($query->execute())
							echo success("Details recorded. You will be notified on the email ID provided when your details have been verified");
						else
							echo error_without_field("Couldn\'t record details. Please try again later");
					}
				}
			}
		?>


		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/js/Contact-Form-v2-Modal--Full-with-Google-Map.js"></script>
		<script src="assets/js/myScript.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
		
	</body>


<?php
		
		if(isset($_POST['signIn']))
		{
			$query = $con->prepare("SELECT email, libCard FROM registered WHERE email = ? AND password = ?;");
			$temp2 = sha1($_POST['password2']);
			$query->bind_param("ss", $_POST['email2'], $temp2);
			$query->execute();
			$result = $query->get_result();
			$resultRow2 = mysqli_fetch_array($result);
			var_dump($resultRow2);
			
			if(mysqli_num_rows($result) != 1)
				echo error_without_field("Invalid username/password combination");
			else if ( $resultRow2[0]=="neerajTheOP@admin.com")
			{
				//var_dump("hi");
				$_SESSION['type'] = "librarian";
				// $_SESSION['libCard'] = $resultRow[1];
				$_SESSION['email'] = $_POST['email2'];
				
				//var_dump($_SESSION);
				//var_dump($resultRow);
				//var_dump("HELP");
				header('Location: AfterLoginLib/home.php');
			}
			else 
			{
				//$resultRow = mysqli_fetch_array($result);
				//var_dump($resultRow);
				// $balance = $resultRow[1];
				// if($balance < 0)
					// echo error_without_field("Your account has been suspended. Please contact a librarian for further information");
				// else
				//{
					
					$_SESSION['type'] = "member";
					//var_dump($resultRow[1]);
					$_SESSION['libCard'] = $resultRow2[1];
					$_SESSION['email'] = $_POST['email2'];
					
					//var_dump($_SESSION["libCard"]);
					//var_dump($resultRow);
					//var_dump("HELP");
					header('Location: AfterLogin/home.php');
					
					//echo "<script>window.location.href='AfterLogin/home.php'</script>";
				//}
			}
		}
		ob_end_flush();
?>
</html>