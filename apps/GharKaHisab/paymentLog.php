<?php
include_once 'functions.php';
check_authentication ( 'index.php' );

// var_dump($_REQUEST);

$command = $_REQUEST ["command"];
$payment_id = $_GET ["payment_id"];
$paymentFrom = $_POST ["paymentFrom"];
$paymentYear = $_POST ["paymentYear"];
$paymentMonth = $_POST ["paymentMonth"];
$paymentDay = $_POST ["paymentDay"];
$paymentDesc = $_POST ["paymentDesc"];
$paymentAmount = $_POST ["paymentAmount"];
$userId = $_SESSION ["userName"];


if ($command == "create") {
	createPaymentEntry($paymentFrom, $paymentYear, $paymentMonth, $paymentDay, $paymentDesc, $paymentAmount, $userId);
}

if ($command == "delete" && $payment_id != "") {
	deletepaymentEntry ( $payment_id );
}

$accyearmonth = get_open_acc_year_month ();

// phpinfo();

?>
<html>
<head>
<meta charset="utf-8">
<title>Payment log</title>

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body>
	<script type='text/javascript' src="js/jquery-min.js"></script>
	<script type='text/javascript' src="js/bootstrap.min.js"></script>



	<div class="container">


		<form role="form" method="post" action="paymentLog.php">

			<div class="form-group col-xs-5">
				<label for="paymentFrom">Payment from</label> <select
					id="paymentFrom" name="paymentFrom" class="form-control">
					<option></option>
					<?php populate_users_dropdown();?>
				</select>

			</div>
			<div>
				<div class="form-group  col-xs-2">
					<label for="paymentYear">Year</label> <select id="paymentYear"
						name="paymentYear" class="form-control">
						<?php populate_year_dropdown($accyearmonth);?>
					</select>
				</div>
				<div class="form-group  col-xs-3">


					<label for="paymentMonth">Month</label> <select id="paymentMonth"
						name="paymentMonth" class="form-control">
						<?php populate_month_dropdown($accyearmonth); ?>
					</select>
				</div>
				<div class="form-group  col-xs-2">
					<label for="paymentDay">Day</label> <select id="paymentDay"
						name="paymentDay" class="form-control">
						<?php populate_day_dropdown($accyearmonth); ?>
					</select>
				</div>
			</div>


			<div class="form-group col-xs-10">
				<label for="paymentDesc">Description</label> <input type="text"
					class="form-control" id="paymentDesc" name="paymentDesc"
					placeholder="Enter Description">
			</div>

			<div class="form-group col-xs-2">
				<label for="paymentAmount">Amount</label> <input type="text"
					class="form-control" id="paymentAmount" name="paymentAmount" placeholder="Enter Amount">
			</div>
			
			<div class="row">
				<div class="center-block" style="width: 200px;">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</div>
			<input type="hidden" name="command" value="create"/>
			
		</form>
		<iframe height="100%" width="100%" frameborder="0"
			src="displayPaymentLog.php?acc_year_month=<?php echo $accyearmonth?> "></iframe>
		
	</div>

</body>
</html>