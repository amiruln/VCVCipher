
<?php

// initialize variables
$message = "";
$secretMsg = "";
$type = "";
$text = "";
$error = "";
$valid = true;
$color = "#FF0000";

// if form was submit
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	// declare encrypt and decrypt functions
	require_once('encryption.php');
	$encryption = new VCVCipher();
	
	// set the variables
	$message = $_POST['message'];
	$secretMsg = $_POST['secretMsg'];
	
	
	// check if message is provided
	if (empty($_POST['message']))
	{
		$error = "Please enter a message!";
		$valid = false;
	}

	
	// check if secret password is provided
	else if (empty($_POST['secretMsg']))
	{
		$error = "Please enter secret message!";
		$valid = false;
	}
	
	// check if password is alphanumeric
	else if (isset($_POST['secretMsg']))
	{
		if (!ctype_alpha($_POST['secretMsg']))
		{
			$error = "Key or Secret Password should contain only alphabetical characters!";
			$valid = false;
		}
	}

	
	// inputs valid
	if ($valid)
	{

		// if encrypt button was clicked
		if (isset($_POST['encrypt']))
		{


			$text = $encryption->EncryptOrDecrypt($message, $secretMsg, $type="ENCRYPT");
			$error = "Plaintext encrypted successfully!";
			$color = "#526F35";
		}
			
		// if decrypt button was clicked
		if (isset($_POST['decrypt']))
		{
			$text = $encryption->EncryptOrDecrypt($message, $secretMsg, $type="DECRYPT");
			$error = "Ciphertext decrypted successfully!";
			$color = "#526F35";
		}
	}
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
<title>VCV Cipher</title>
	
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<script type="text/javascript" src="Script.js"></script>

	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--// Meta tag Keywords -->
    
	<!-- css files -->
	<link rel="stylesheet" href="css/bootstrap.css"> <!-- Bootstrap-Core-CSS -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 
	<link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->

	<!--web font-->
	<link href="//fonts.googleapis.com/css?family=Inconsolata:400,700&amp;subset=latin-ext,vietnamese" rel="stylesheet">
	<!--//web font-->

</head>

<body>


<!-- header -->
<header>
	<div class="container">
		<!-- nav -->
		<nav class="py-3">
        <div id="logo">
			<h1>
				<a class="navbar-brand" href="index.php"> <span class="fa fa-lock"></span>VCV<span><span class="line"></span>Cipher</span>
				</a>
			</h1>
		</div>
        </nav>
		<!-- //nav -->
	</div>
</header>
<!-- //header -->


<!-- banner -->
<section class="banner layer" id="home">
	<div class="container">
		<div class="banner-text">
			<div class="slider-info mb-10">
				<div class="banner-heading">
					<h3>
						VCV Cipher
					</h3>
				</div>
				<div class="primary-form">
				<form action="index.php" method="POST" class="px-3 pt-3 pb-0">
				<div class="form-group">
					<label for="message" class="col-form-label">Input Message</label>
					<input type="text" class="form-control" placeholder="Please input your message to be encrypted or decrypted" name="message" id="message" required="" value="<?php echo htmlspecialchars($message); ?>" >
					<label for="secretMsg" class="col-form-label">Key</label>
					<input type="text" class="form-control" placeholder="Please input key or secret password" name="secretMsg" id="secretMsg" required="" value="<?php echo htmlspecialchars($secretMsg); ?>" >
					
				</div>
				<div class="right-w3l">
				<input type="submit" name="encrypt" class="button" value="Encrypt" onclick="validate(1)">
				<input type="submit" name="decrypt" class="button" value="Decrypt" onclick="validate(2)">
				</div>
				<br>
				<div class="form-group">
					<label for="ciphertext" class="col-form-label">Ciphertext/Plaintext</label>
					<textarea class="form-control" placeholder="" name="ciphertext" id="ciphertext" readonly style="color: <?php echo htmlspecialchars($color) ?>"><?php echo htmlspecialchars($text) ?> </textarea>
				</div>
				<tr>
					<td>
  					<center><div  class="alert-secondary" style="color: <?php echo htmlspecialchars($color) ?>"><?php echo htmlspecialchars($error) ?></div></center></td></div>
				</tr>
			</form>
		</div>
		<br><br>
				
			</div>			
		</div>
	</div>
</section>
<!-- //banner -->

<!-- footer -->	
<footer>
	<div class="container">
		<div class="row footer-gap">
		
			<div class="">
				<h3 class="text-capitalize mb-2"> Follow Me</h3>
				
				<ul class="social mt-lg-0 mt-3">
					<li class="mr-1"><a href="https://web.facebook.com/amirul.naim.profile"><span class="fa fa-facebook"></span></a></li>
					<li class=""><a href="https://www.instagram.com/llllrma"><span class="fa fa-instagram"></span></a></li>
					<li class=""><a href="https://www.linkedin.com/in/amirul-naim-8ba419175/"><span class="fa fa-linkedin"></span></a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="copyright pb-2 text-center">
		<p>© 2019 VCV Cipher. All Rights Reserved | Design by Amirul Naim</p>
	</div>
</footer>
<!-- footer -->
</body>
</html>