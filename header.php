<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?> - Buy 4m Me</title>
	<link rel="stylesheet" href="css/style.css" type="text/css"> 	
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700" type="text/css">
	<link rel="shortcut icon" href="favicon.ico">
	<script type="text/javascript" src="js/validation.js"></script>

    
</head>
<body>

	<div class="header">

		<div class="wrapper">

			<h1 class="branding-title"><a href="index.php">Buy 4m Me</a></h1>

			<ul class="nav">
				<li class="shirts <?php if($title==='Stuff') {echo 'on';} ?>"><a href="stuff.php">Stuff</a></li>
				<li class="contact <?php if($title==='Contact') {echo 'on';} ?>"><a href="contact.php">Contact</a></li>
				<li class="cart"><a href="cart.php">Shopping Cart</a></li>
			</ul>

		</div>

	</div>

	
