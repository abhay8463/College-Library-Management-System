<?php
	require "php/db_connect.php";
	require "php/message_display.php";
?>


<!DOCTYPE html>
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
</head>

<body style="background: url(&quot;assets/img/bgLib.png&quot;);">
    <nav class="navbar navbar-light navbar-expand-md" style="background: linear-gradient(180deg, white, #772f1a 50%);opacity: 0.72;color: rgb(28,120,213);">
        <div class="container-fluid"><img id="logoNav" src="assets/img/logo.png" width="50px" height="100px" style="margin-top: 1%;opacity: 1;"><button data-toggle="collapse" class="navbar-toggler border-warning" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon justify-content-center" style="color: rgb(251,251,251);"></span></button>
            <div
                class="collapse navbar-collapse justify-content-end" id="navcol-1" style="color: rgb(197,22,11);">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a class="nav-link active text-white" href="about.html" style="background: #5b1010;font-size: 18px;border-radius: 42px;padding: 8px;">About Us</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php" style="font-size: 18px;background: #5b1010;border-radius: 42px;padding: 8px;">Login</a></li>
                    <li class="nav-item"></li>
                </ul>
        </div>
        </div>
    </nav>
    <div style="justify-content: center;" width="auto">
        <div class="container-fluid">
            <hr>
            <form id="contactForm" name="contact" action="#" method="POST" style="background: rgba(28,27,27,0.84);color: rgb(255,255,255);width:auto">
                <input class="form-control" type="hidden" name="Introduction" value="This email was sent from www.awebsite.com">
                <input class="form-control" type="hidden" name="subject" value="Awebsite.com Contact Form">
                <input class="form-control" type="hidden" name="to" value="email@awebsite.com">
                <div class="form-row">
                    <div class="col-md-6">
                        <div id="successfail"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 col-md-6" id="message">
                        <h2 class="h4"><i class="fa fa-envelope"></i> Contact Us<small></small></h2>
                        <div class="form-group">
                            <label for="from-name">Name</label>
                            <span class="required-input">*</span>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user-o"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" id="from-name" name="name" placeholder="Full Name">
                                <small></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="from-email">Email</label>
                            <span class="required-input">*</span>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope-o"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" id="from-email" name="email" placeholder="Email Address">
                                <small></small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="from-phone">Phone</label>
                                    <span class="required-input">*</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" type="text" id="from-phone" name="phone" placeholder="Primary Phone">
                                        <small></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                <div class="form-group"><label for="from-calltime">Best Time to Call</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></div>
                                        <select class="form-control" id="from-calltime" name="calltime" style="margin-top: 8px;">
                                        <optgroup label="Best Time to Call">
                                        <option value="Morning" selected="">Morning</option>
                                        <option value="Afternoon">Afternoon</option>
                                        <option value="Evening">Evening
                                        </option></optgroup></select></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label for="from-comments">Comments</label><textarea class="form-control" id="from-comments" name="comments" placeholder="Enter Comments" rows="5"></textarea></div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col"><button class="btn btn-primary btn-block" type="reset"><i class="fa fa-undo"></i> Reset</button></div>
                                <div class="col"><button class="btn btn-primary btn-block" type="submit" name="submit">Submit <i class="fa fa-chevron-circle-right"></i></button></div>
                            </div>
                        </div>
                        <hr class="d-flex d-md-none">
                    </div>
                    <div class="col-12 col-md-6" style="color: rgb(255,255,255);">
                        <h2 class="h4"><i class="fa fa-location-arrow"></i> Locate Us</h2>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="static-map">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2333.6401942750585!2d72.88792115801394!3d19.046092357457265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c8add9569a29%3A0xb7ad04bf9a389df7!2sVivekanand%20Education%20Society&#39;s%20Institute%20Of%20Technology!5e0!3m2!1sen!2sin!4v1600003802747!5m2!1sen!2sin"
									width="100%" height="360px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
								</div>
                            </div>
                            <div class="col-sm-6 col-md-12 col-lg-6">
                                <h2 class="h4"><i class="fa fa-user"></i> Our Info</h2>
                                <div><span><strong>Group 3</strong></span></div><span>Prem Chhabria</span>
                                <div><span>Abhay Gupta</span></div>
                                <div><span>Jay Jhaveri</span></div>
                                <hr class="d-sm-none d-md-block d-lg-none">
                            </div>
                            <div class="col-sm-6 col-md-12 col-lg-6">
                                <h2 class="h4"><i class="fa fa-location-arrow"></i> Our Address</h2>
                                <div><span><strong>Vesit Library</strong></span></div>
                                <div><span>Vesit main gate sae right</span></div>
                                <div><span>chembur- pincode</span></div>
                                <div><abbr data-toggle="tooltip" data-placement="top" title="Office Phone: 555-867-5309">O:</abbr> 555-867-5309</div>
                                <hr class="d-sm-none">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <?php
			if(isset($_POST['submit']))
			{
                $query = $con->prepare("INSERT INTO contactus(name, email, phone, timeOfCall, comments) VALUES(?, ?, ?, ?, ?);");
                $timeCall = $_POST['calltime'];
                $query->bind_param("ssiss", $_POST['name'], $_POST['email'], $_POST['phone'], $timeCall, $_POST['comments']);
                if($query->execute())
                    echo success("Details recorded. You will be contacted on the email ID soon!");
                else
                    echo error_without_field("Couldn\'t record details. Please try again later");
        
			}
		?>
        
    
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Contact-Form-v2-Modal--Full-with-Google-Map.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    
</body>

</html>