<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Home</title>
	<link rel="stylesheet" href="index.css" />
	<?php include('./UIKIT-CSS.php'); ?>
</head>

<body>
	<?php include('../Backend/dbConnection.php'); ?>
	<div class="uk-position-relative">
		<div class="uk-position-relative uk-visible-toggle uk-light uk-position-top" tabindex="-1" uk-slideshow="animation: push" autoplay="true">
			<ul class="uk-slideshow-items" uk-height-viewport="min-height: 100vh">
				<li>
					<div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-center-left">
						<img src="./index_img/1.jpg" alt="" uk-cover />
					</div>
				</li>
				<li>
					<div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-top-right">
						<img src="./index_img/0.jpg" alt="" uk-cover />
					</div>
				</li>
				<li>
					<div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-bottom-left">
						<img src="./index_img/22.jpg" alt="" uk-cover />
					</div>
				</li>
			</ul>
		</div>
		<div class="uk-position-top">
			<nav class="navbarTransparent" uk-navbar>
				<div class="uk-navbar-right">
					<ul class="uk-navbar-nav navText">
						<li class="nav-item">
							<a class="uk-text-emphasis navText uk-text-bold" href="#">About US</a>
						</li>
						<li class="nav-item">
							<a href="" class="navText"><button id="btnSignUp" class="uk-button uk-button-default" uk-toggle="target: #form">
									SIGNUP
								</button></a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<div class="uk-grid-width-larg-1-1 signinBack uk-grid-width-small-2-3 uk-padding uk-position-center uk-margin-remove-left" uk-grid>
		<form method="POST" action="../Backend/login.php" class="uk-padding-remove-left">
			<fieldset class="uk-fieldset">
				<legend class="uk-legend">SIGN IN</legend>
				<div class="uk-margin-small uk-inline uk-width-larg">
					<span class="uk-form-icon" uk-icon="icon: user"></span>
					<input name="email_login" class="uk-input" type="text" placeholder="Email" />
				</div>
				<div class="uk-margin-small uk-inline uk-width-larg">
					<span class="uk-form-icon" uk-icon="icon: lock"></span>
					<input name="password_login" class="uk-input" type="password" placeholder="password" />
				</div>
				<div class="uk-margin-small">
					<input class="uk-input" type="submit" value="connect" />
				</div>
			</fieldset>
		</form>
	</div>

	<div id="form" class="uk-modal-full" uk-modal>
		<div class="uk-modal-dialog">
			<button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
			<div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
				<div class="uk-background-cover" style="background-image: url('index_img/signup.png')" uk-height-viewport></div>
				<div class="uk-padding-large">
					<h1 class="uk-position-top-center">CREATE AN ACCOUNT</h1>
					<form action="../Backend/createAccount.php" method="post">
						<fieldset class="uk-fieldset">
							<div class="uk-margin-small uk-inline uk-width-1-1">
								<span class="uk-form-icon" uk-icon="icon: user"></span>
								<input name="first_name_signup" class="uk-input" type="text" placeholder="First Name" />
							</div>
							<div class="uk-margin-small uk-inline uk-width-1-1">
								<span class="uk-form-icon" uk-icon="icon: user"></span>
								<input name="last_name_signup" class="uk-input" type="text" placeholder="Last Name" />
							</div>
							<div class="uk-margin-small uk-inline uk-width-1-1">
								<span class="uk-form-icon" uk-icon="icon: user"></span>
								<input name="pseudo_signup" class="uk-input" type="text" placeholder="Pseudo" />
							</div>
							<div class="uk-margin-small uk-inline uk-width-1-1">
								<span class="uk-form-icon" uk-icon="icon: user"></span>
								<input name="age_signup" class="uk-input" type="date" placeholder="Age" />
							</div>
							<div class="uk-margin-small uk-inline uk-width-1-1">
								<select name="gender_signup" class="uk-select" id="form-stacked-select" require>
									<option value="">Please select the gender...</option>
									<option value="male">Male</option>
									<option value="famele">Famele</option>
								</select>
							</div>
							<div class="uk-margin-small uk-inline uk-width-1-1">
								<select name="section_signup" class="uk-select" id="form-stacked-select">
									<option value="">Please select the section...</option>
									<?php $rep = $bdd->query('SELECT * FROM section');
									while ($donnees = $rep->fetch()) { ?>
										<option value="<?php echo $donnees['id_section']; ?>"> <?php echo $donnees['section']; ?> </option>
									<?php
									}
									?>

								</select>
							</div>

							<div class="uk-margin-small uk-inline uk-width-1-1">
								<span class="uk-form-icon" uk-icon="icon: mail"></span>
								<input name="email_signup" class="uk-input" type="text" placeholder="Email" />
							</div>
							<div class="uk-margin-small uk-inline uk-width-1-1">
								<span class="uk-form-icon" uk-icon="icon: lock"></span>
								<input name="password_signup" class="uk-input" type="password" placeholder="password" />
							</div>
							<div class="uk-margin-small uk-inline uk-width-1-1">
								<span class="uk-form-icon" uk-icon="icon: phone"></span>
								<input name="phone_signup" class="uk-input" type="text" placeholder="Phone Number" />
							</div>
							<div class="uk-margin-small uk-width-1-1">
								<input name="create_account" class="uk-input uk-button
									uk-button-danger" type="submit" value="Create Account"" />
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
		$rep->closeCursor();
		include('./UIKIT-JS.php');
		?>

</body>

</html>