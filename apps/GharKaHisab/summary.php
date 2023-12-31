<?php
include_once 'functions.php';
check_authentication ( 'index.php' );

// var_dump($_REQUEST);

// phpinfo();

$view_all_flag = FALSE;
$accyearmonth = get_open_acc_year_month ();
$cash_pay_users_arr = populate_cash_pay_users_arr ();
$expenses_summary_arr = ceate_expense_detail_arr_of_applicable_amt ( $accyearmonth,false, $_SESSION ["userName"] );
$summary_payment_arr = populate_summary_payments_arr ( $accyearmonth, $cash_pay_users_arr, $_SESSION ["userName"],$view_all_flag );

?>

<html>
<head>
<meta charset="utf-8">
<title>Expense log</title>

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body>
	<script type='text/javascript' src="js/jquery-min.js"></script>
	<script type='text/javascript' src="js/bootstrap.min.js"></script>

	<script type='text/javascript'>
	var acc_year_month;
	var expense_type;
	
	function open_expenses_detail_window(accyearmonth,expense_type,expense_user_id){

		this.acc_year_month=accyearmonth;
		this.expense_type = expense_type;
		//alert("displayExpenseLog.php?acc_year_month=" + this.acc_year_month + "&expense_type="+ this.expense_type + "&display_expense_type_flag=FALSE&display_delete_flag=FALSE");
		document.getElementById('expense_details_frame').src="displayExpenseLog.php?acc_year_month=" + this.acc_year_month + "&expense_type_id="+ this.expense_type + "&expense_user_id="+ expense_user_id + "&display_expense_type_flag=FALSE&display_delete_flag=FALSE&display_applicable_amount_flag=TRUE";
		$('#myModal').modal('show')

		}
			
	</script>

	<div class="container">

		<div class="row">

			<div class="row">
				<?php 
				$display_total_due_column = TRUE;
				$show_footer_total_flag = TRUE;
				populate_summary_due_table($accyearmonth,$_SESSION ["userName"] ,$cash_pay_users_arr,$expenses_summary_arr,$summary_payment_arr,$display_total_due_column,$show_footer_total_flag);?>
			</div>
		</div>

<!-- 		</form> -->


	</div>



	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<!--       <div class="modal-header"> -->
				<!--         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
				<!--         <h4 class="modal-title" id="myModalLabel">Expense details</h4> -->
				<!--       </div> -->
				<div class="modal-body">

					<iframe id="expense_details_frame" height="100%" width="100%"
						frameborder="0" src="blank.html"></iframe>
				</div>
				<!--       <div class="modal-footer"> -->
				<!--         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
				<!--         <button type="button" class="btn btn-primary">Save changes</button> -->
				<!--       </div> -->
			</div>
		</div>
	</div>

	</div>

</body>
</html>