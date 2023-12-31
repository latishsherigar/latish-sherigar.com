<?php
include_once 'functions.php';
check_authentication ( 'index.php' );

// var_dump($_GET);

$createEntry = $_POST ["createEntry"];

if ($createEntry == "true") {
	$expenseType = $_POST ["expenseType"];
	$expenseYear = $_POST ["expenseYear"];
	$expenseMonth = $_POST ["expenseMonth"];
	$expenseDay = $_POST ["expenseDay"];
	$expenseDesc = $_POST ["expenseDesc"];
	$expenseAmount = $_POST ["expenseAmount"];
	$userId = $_SESSION ["userName"];
	
	$con=null;
	createExpenseEntry($expenseType, $expenseYear, $expenseMonth, $expenseDay, $expenseDesc, $expenseAmount, $userId,$con);
}

$command = $_GET ["command"];
$expense_id = $_GET ["expense_id"];

if ($command == "delete" && $expense_id != "") {
	deleteExpenseEntry ( $expense_id );
}

// phpinfo();

$accyearmonth = get_open_acc_year_month ();

?>

<html>
<head>
<meta charset="utf-8">
<title>Expense log11</title>

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body>
	<script type='text/javascript' src="js/jquery-min.js"></script>
	<script type='text/javascript' src="js/bootstrap.min.js"></script>


	<div class="container">

		<form role="form" id="expense_form" method="post" action="expenseLog.php">
			<div class="form-group col-xs-5">
				<label for="expenseType">Expense Type</label> <select
					id="expenseType" name="expenseType" class="form-control">
					<option></option>
						<?php populate_expense_type_dropdown();?>
					</select>

			</div>

			<div>
				<div class="form-group  col-xs-2">
					<label for="expenseYear">Year</label> <select id="expenseYear"
						name="expenseYear" class="form-control">
						<?php populate_year_dropdown( $accyearmonth);?>
					</select>
				</div>
				<div class="form-group  col-xs-3">


					<label for="expenseMonth">Month</label> <select id="expenseMonth"
						name="expenseMonth" class="form-control">
						<?php populate_month_dropdown($accyearmonth ); ?>
					</select>
				</div>
				<div class="form-group  col-xs-2">
					<label for="expenseDay">Day</label> <select id="expenseDay"
						name="expenseDay" class="form-control">
						<?php populate_day_dropdown($accyearmonth); ?>
					</select>
				</div>
			</div>

			<div class="form-group col-xs-10">
				<label for="expenseDesc">Description</label> <input type="text"
					class="form-control" id="expenseDesc" name="expenseDesc"
					placeholder="Enter Description">
			</div>

			<div class="form-group col-xs-2">
				<label for="expenseAmount">Amount</label> <input type="text"
					class="form-control" id="expenseAmount" name="expenseAmount"
					placeholder="Enter Amount">
			</div>

			<!-- 			<div class="row"> -->
			<!-- 				<div class="col-xs-2"> -->
			<!-- 					<input type="text" class="form-control" placeholder="Year"> -->
			<!-- 				</div> -->
			<!-- 				<div class="col-xs-3"> -->
			<!-- 					<input type="text" class="form-control" placeholder=".col-xs-3"> -->
			<!-- 				</div> -->
			<!-- 				<div class="col-xs-4"> -->
			<!-- 					<input type="text" class="form-control" placeholder=".col-xs-4"> -->
			<!-- 				</div> -->
			<!-- 			</div> -->

			<div class="row">

				<div class="center-block" style="width: 200px;">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</div>
			<input type="hidden" name="createEntry" value="true" />

		</form>

		<iframe height="100%" width="100%" frameborder="0"
			src="displayExpenseLog.php?acc_year_month=<?php echo $accyearmonth?> "></iframe>
		<?php
		// include_once 'displayExpenseLog.php?acc_year_month='.$accyearmonth;
		?>
		
	</div>

</body>
</html>