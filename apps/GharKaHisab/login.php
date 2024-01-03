<?php
session_start();

include_once 'functions.php';


$logout = $_REQUEST["logout"];

if($logout=="true"){
	// destroy the session.
	session_destroy();
}

$userName = $_POST ["userName"];

//var_dump($_POST);

if ($_REQUEST ["redirectPage"] != '') {
	$redirectPage = $_REQUEST ["redirectPage"];
}

if($redirectPage==''){
	$redirectPage='index.php';
}

if ($userName != '') {
	$_SESSION["userName"] =$userName; 
	$_SESSION["user_full_name"] =get_user_full_name($userName);	
	//echo ('$_SESSION["userName"]'. $_SESSION["userName"]);
	//echo ('$redirectPage'. $redirectPage);
	header ( "Location: " . $redirectPage, TRUE, 307 );
}


?>

<html>
<head>
<meta charset="utf-8">
<title>Login</title>

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body>
	<script type='text/javascript' src="js/jquery-min.js"></script>
	<script type='text/javascript' src="js/bootstrap.min.js"></script>



	<div class="container">
		<h1>Ghar ka Hisab - Sherigar's</h1>
		<form role="form" method="post" action="login.php">
			<div class="form-group">
				<label for="expenseType">User Name</label> <select id="userName" name="userName"
					class="form-control">
					<option/>
					<?php populate_users_dropdown()?>		
		</select>
			</div>

			<button type="submit" class="btn btn-primary">Login</button>
			<input type="hidden" name="redirectPage"
				value="<?php echo($redirectPage) ?>" />

		</form>
	</div>

</body>
</html>