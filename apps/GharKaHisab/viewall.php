<?php
include_once 'functions.php';
check_authentication ( 'index.php' );

// var_dump($_REQUEST);

// phpinfo();
$con = open_db_connection ();

$accyearmonth = get_open_acc_year_month ();
$cash_pay_users_arr = populate_cash_pay_users_arr ();
$statement_mode=$_REQUEST['statement_mode'];

$expense_types_arr = get_expense_types_arr ();

$ip_display_expense_type_flag = "FALSE";
$ip_display_delete_flag = "FALSE";
$ip_display_applicable_amount_flag = "FALSE";
$ip_view_all_flag = "TRUE";
$ip_display_user_name_flag = "TRUE";
?>

<html>
<head>
<meta charset="utf-8">
<title>Viewall</title>

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body>
	<script type='text/javascript' src="js/jquery-min.js"></script>
	<script type='text/javascript' src="js/bootstrap.min.js"></script>


	<div class="container">
	<?php 
	$accyear = substr($accyearmonth,0,4);
	$month_name_year= getMonthName(substr($accyearmonth,4)) ." ". $accyear;
	
	if($statement_mode=="off"){
		echo '	<h2 align="center">Unbilled items - '.$month_name_year.'</h2>';
		}
	else{
		echo '	<h2 align="center">Statement for the month - '.$month_name_year.'</h2>';
		}	
	
	?>

		<div class="row">
			<h3>Grand Summary</h3>
			<table class="table table-hover table-condensed">
		
		<?php
		
		$sql = "SELECT USERS.USER_ID,USERS.NAME,CASH_PAY
								FROM GHARKAHISAB_USERS USERS
								 ORDER BY USERS.NAME";
		// echo $sql;
		
		$rst_expenses = mysqli_query ( $con, $sql );
		
		$users = array ();
		
		echo '<tr><th/>';
		
		while ( $row_expenses = mysqli_fetch_array ( $rst_expenses ) ) {
			if ($row_expenses ['CASH_PAY'] == 'Y') {
				echo '<th>' . $row_expenses ['NAME'] . '</th>';
			}
			$users [$row_expenses ['USER_ID']] = array ($row_expenses ['USER_ID'],	$row_expenses ['NAME'] 
			);
		}
		echo '</tr>';
		
		
		// var_dump($users);
		
		foreach ( $users as $user ) {
			// var_dump($user);
			echo '<tr><td>' . $user [1] . '</td>';
			$reimb_user_id = $user [0];
			
			foreach ( array_keys($cash_pay_users_arr) as $cash_pay_user ) {
				echo '<td>' . get_final_due_amount_by_reiumb_user_and_cash_pay_user ( $accyearmonth, $cash_pay_user, $reimb_user_id ) . '</td>';
			}
			echo '</tr>';
		}
		
		?>	
		</table>
		</div>
		
		<div class="row">
		<?php 
		foreach ( $users as $user ) {
			echo "<h3>Expense wise break up - ". $user [1] ."</h3>";
			 
			$display_total_due_column = TRUE;
			$show_footer_total_flag = FALSE;
			$reimb_user_id = $user [0];
			//echo '$reimb_user_id'.$reimb_user_id;
			
			$expenses_summary_arr = ceate_expense_detail_arr_of_applicable_amt ( $accyearmonth,false, $reimb_user_id);
			$summary_payment_arr = populate_summary_payments_arr ( $accyearmonth, $cash_pay_users_arr,$reimb_user_id, FALSE );
			//var_dump($expenses_summary_arr);
			populate_summary_due_table($accyearmonth,$_SESSION ["userName"] ,$cash_pay_users_arr,$expenses_summary_arr,$summary_payment_arr,$display_total_due_column,$show_footer_total_flag);
			echo "<br/>";	
		}
		?>
		
		
		</div>
			
		<div class="row">
		<?php
		
		foreach ( array_keys ( $expense_types_arr ) as $expense_type_id ) {
			echo '<h3>' . get_expense_type_desc ( $expense_type_id ) . '</h3><br/>';
			display_expense_log_page ( $accyearmonth, $ip_display_expense_type_flag, $ip_display_delete_flag, $ip_display_applicable_amount_flag, $expense_type_id, $ip_view_all_flag, $ip_display_user_name_flag, $expense_user_id );
			
			// $expense_url = "displayExpenseLog.php?acc_year_month=" . $accyearmonth . "&expense_type_id=" . $expense_type_id . "&display_delete_flag=FALSE";
			// echo '<iframe id="viewall_expenses_details" width="100%" frameborder="0" src="' . $expense_url . '"></iframe>';
		}
		
		echo '<h3>Payments</h3><br/>';
			display_payment_log_page($accyearmonth, $ip_display_delete_flag, $ip_view_all_flag, $ip_display_user_name_flag)		
		
		
		?>
		
		
			
		
	
		
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