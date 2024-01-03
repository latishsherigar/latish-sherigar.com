<?php
error_reporting ( E_ALL ^ E_NOTICE );
ini_set ( 'display_errors', '1' );

//if (session_status () == PHP_SESSION_NONE) {
	session_start ();
//}

// session_start ();

global $con;

function check_authentication($redirectPage) {
	if ($_SESSION ["userName"] == '') {
		header ( "Location: login.php?redirectPage=" . $redirectPage, TRUE, 307 );
	}
}
function getMonthName($i) {
	switch ($i) {
		case 1 :
			$month = "January";
			break;
		case 2 :
			$month = "February";
			break;
		case 3 :
			$month = "March";
			break;
		case 4 :
			$month = "April";
			break;
		case 5 :
			$month = "May";
			break;
		case 6 :
			$month = "June";
			break;
		case 7 :
			$month = "July";
			break;
		case 8 :
			$month = "August";
			break;
		case 9 :
			$month = "September";
			break;
		case 10 :
			$month = "October";
			break;
		case 11 :
			$month = "November";
			break;
		case 12 :
			$month = "December";
			break;
	}
	
	return $month;
}
function populate_month_dropdown($accyearmonth) {
    
    $month = ltrim(substr($accyearmonth, 4,2),'0');
    
	for($i = 1; $i <= 12; $i ++) {
		
	    if($i == $month)
		{
			$selected_flag ="selected";
		}else{
			$selected_flag ="";
		}
		echo '<option '. $selected_flag .' value=' . $i . '>' . getMonthName ( $i ) . '</option>';
	}
}
function populate_day_dropdown($accyearmonth) {
    
    
    for($i = 1; $i <= 31; $i ++) {
		
		if($i ==date('j')){
			$selected_flag ="selected";
		}else{
			$selected_flag ="";
		}
		
		echo '<option '. $selected_flag .' value=' . $i . '>' . $i . '</option>';
	}
}
function populate_acc_year_month_dropdown($show_open_year_acc_month_flag) {
	$con = open_db_connection ();
	
	if(!$show_open_year_acc_month_flag){
		$sql1= " WHERE CLOSED_DATE IS NOT NULL";
	}

	
	
	$sql = "SELECT ACCOUNTING_YEAR_MONTH FROM GHARKAHISAB_ACC_YEAR_MONTHS ".$sql1 ." ORDER BY ACCOUNTING_YEAR_MONTH DESC LIMIT 12";
	
	$rstaccYearMonth = mysqli_query ( $con,  $sql );
	
	while ( $rowaccYearMonth = mysqli_fetch_array ( $rstaccYearMonth ) ) {
		echo '<option value="' . $rowaccYearMonth ['ACCOUNTING_YEAR_MONTH'] . '">' . $rowaccYearMonth ['ACCOUNTING_YEAR_MONTH'] . '</option>';
	}
	mysqli_close ( $con );
}
function populate_year_dropdown($accyearmonth) {

    $year = ltrim(substr($accyearmonth, 0,4),'0');
    
//     for($i = $start_year; $i <= $start_year + 2 ; $i ++) {
		
// 		if($i == date('Y')){
// 			$selected_flag="selected";			
// 		}
// 		else{
// 			$selected_flag="";
// 		}
		
// 		echo '<option '.$selected_flag.' value=' . $i . '>' . $i . '</option>';
		
// 	}
	
    $prevyear = $year -1;
    $nextyear = $year + 1;
    
    echo '<option  value=' . $prevyear . '>' . $prevyear . '</option>';
    echo '<option selected value=' . $year . '>' . $year . '</option>';
    echo '<option  value=' . $nextyear . '>' . $nextyear . '</option>';
    
}
function open_db_connection() {
	//$ini_array = parse_ini_file ( "db.ini" );
	$ini_array = parse_ini_string (file_get_contents( "db.ini" ));
	// print_r($ini_array);
	
	// Create connection
	$con = mysqli_connect ( 'p:' . $ini_array ['machine'], $ini_array ['dbUser'], $ini_array ['dbPassword'], $ini_array ['db'] );
	
	// Check connection
	if (mysqli_connect_errno ()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error ();
	}
	
	return $con;
}
function get_open_acc_year_month() {
	$con = open_db_connection ();
	
	$result = mysqli_query ( $con, "SELECT * FROM GHARKAHISAB_ACC_YEAR_MONTHS WHERE CLOSED_DATE IS NULL" );
	$row = mysqli_fetch_array ( $result );
	$acc_year_month = $row ['ACCOUNTING_YEAR_MONTH'];
	mysqli_close ( $con );
	
	return $acc_year_month;
}

function get_next_accounting_year_month_value($acc_year_month){
	
	$month = substr($acc_year_month,4,2);
	$year = substr($acc_year_month,0,4);
	
	//echo '$month- '.$month.'<br/>';
	//echo '$year- '.$year.'<br/>';
	
	
	
	if($month + 1  > 12){
		$month_str="01";
		$year_str = $year + 1;
	}
	else{
		$month_str= str_pad($month + 1,2,'0',STR_PAD_LEFT);
		$year_str = $year;
	}
	
	//echo '$month_str- '.$month_str.'<br/>';
	//echo '$year_str- '.$year_str.'<br/>';
	
	return $year_str.$month_str;
	
}

function open_next_acc_year_month($con) {
	
	$accyearmonth = get_open_acc_year_month ();
	$result = mysqli_query ( $con, "UPDATE GHARKAHISAB_ACC_YEAR_MONTHS SET CLOSED_DATE= SYSDATE() WHERE ACCOUNTING_YEAR_MONTH =" .$accyearmonth);
	$next_accyearmonth = get_next_accounting_year_month_value($accyearmonth);
	$result = mysqli_query ( $con, "INSERT INTO GHARKAHISAB_ACC_YEAR_MONTHS(ACCOUNTING_YEAR_MONTH) VALUES(".$next_accyearmonth.")");
	

	return $acc_year_month;
}


function createExpenseEntry($expenseType,$expenseYear,$expenseMonth,$expenseDay,$expenseDesc,$expenseAmount,$userId,$con) {
	
	
	
	//$accyearmonth = get_open_acc_year_month ();
	
	if(is_null($con)){
		echo 'new conn';
		$con = open_db_connection ();
		$new_conn_flag = TRUE;
	}

	$result = mysqli_query ( $con, "SELECT * FROM GHARKAHISAB_ACC_YEAR_MONTHS WHERE CLOSED_DATE IS NULL" );
	$row = mysqli_fetch_array ( $result );
	$accyearmonth = $row ['ACCOUNTING_YEAR_MONTH'];
	
	$sql = 'INSERT INTO GHARKAHISAB_EXPENSES(EXPENSE_TYPE_ID,EXPENSE_DATE,DESCRIPTION,AMOUNT,USER_ID,ACCOUNTING_YEAR_MONTH)
			 VALUES(' . $expenseType . ',str_to_date(\'' . $expenseYear . '-' . $expenseMonth . '-' . $expenseDay . '\',\'%Y-%m-%d\'),\'' . $expenseDesc . '\',' . $expenseAmount . ',\'' . $userId . '\',' . $accyearmonth . ')';
	
	//echo $sql;
	//var_dump($con) ;
	
// 	if ($result = mysqli_query($con, "SELECT @@autocommit")) {
// 		$row = mysqli_fetch_row($result);
// 		printf("Autocommit is %s\n", $row[0]);
// 		mysqli_free_result($result);
// 	}
	
	
	mysqli_query ( $con, $sql );
	
	if($new_conn_flag){
		mysqli_close ( $con );
	}
}
function createPaymentEntry($paymentFrom,$paymentYear,$paymentMonth,$paymentDay,$paymentDesc,$paymentAmount,$userId) {
	$accyearmonth = get_open_acc_year_month ();
	
	$con = open_db_connection ();
	
	$sql = 'INSERT INTO GHARKAHISAB_PAYMENTS(PAYMENT_FROM,PAYMENT_DATE,DESCRIPTION,AMOUNT,USER_ID,ACCOUNTING_YEAR_MONTH)
			 VALUES(' . $paymentFrom . ',str_to_date(\'' . $paymentYear . '-' . $paymentMonth . '-' . $paymentDay . '\',\'%Y-%m-%d\'),\'' . $paymentDesc . '\',' . $paymentAmount . ',\'' . $userId . '\',' . $accyearmonth . ')';
	
	// echo $sql;
	
	mysqli_query ( $con, $sql );
	mysqli_close ( $con );
}
function deleteExpenseEntry($expense_id) {
	$con = open_db_connection ();
	
	$sql = 'DELETE FROM GHARKAHISAB_EXPENSES WHERE EXPENSE_ID = ' . $expense_id;
	
	 //echo $sql;
	
	mysqli_query ( $con, $sql );
	mysqli_close ( $con );
}
function deletePaymentEntry($payment_id) {
	$con = open_db_connection ();
	
	$sql = 'DELETE FROM GHARKAHISAB_PAYMENTS WHERE PAYMENT_ID = ' . $payment_id;
	
	 //echo $sql;
	
	mysqli_query ( $con, $sql );
	mysqli_close ( $con );
}
function display_expenses($acc_year_month, $display_expense_type_flag, $display_delete_flag, $expense_type_id, $display_applicable_amount_flag,$view_all_flag,$display_expense_user_name_flag, $expense_user_id) {
	$con = open_db_connection ();
	
	$open_acc_year_moth = get_open_acc_year_month ();
	
	if ($open_acc_year_moth != $acc_year_month) {
		$read_only_flag = TRUE;
	}
	
	// $rstDates = mysqli_query ( $con, "SELECT DISTINCT DATE_FORMAT(EXPENSE_DATE,'%d/%m/%Y') as EXPENSE_DATE FROM GHARKAHISAB_EXPENSES WHERE ACCOUNTING_YEAR_MONTH =" . $acc_year_month . " and USER_ID ='" . $_SESSION ["userName"] . "' ORDER BY EXPENSE_DATE DESC" );
	
	// // echo "SELECT DISTINCT EXPENSE_DATE as EXPENSE_DATE FROM GHARKAHISAB_EXPENSES WHERE ACCOUNTING_YEAR_MONTH =".$acc_year_month." and USER_ID ='".$_SESSION["userName"]."'";
	
	// while ( $row_dates = mysqli_fetch_array ( $rstDates ) ) {
	// echo '<b>' . $row_dates ['EXPENSE_DATE'] . '</b>';
	// echo "<br>";
	echo '<table class="table table-hover table-condensed  table-bordered "   ><tr><th class="col-sm-1">Date</th><th class="col-sm-2">Description</th><th class="col-sm-1">Amount</th>';
	
	if ($display_applicable_amount_flag) {
		echo '<th  class="col-sm-2">Applicable Amount</th>';
	}
	
	if ($display_expense_type_flag) {
		echo '<th class="col-sm-1">Type</th>';
	}
	
	if ($display_expense_user_name_flag) {
		echo '<th class="col-sm-1">User</th>';
	}
		
	if ($display_delete_flag) {
		echo '<th class="col-sm-1">Delete</th>';
	}
	
	echo '</tr>';
	
	$sql1 = "SELECT EXPENSES.EXPENSE_ID,EXPENSE_TYPES.DESCRIPTION as EXPENSE_TYPE,EXPENSES.DESCRIPTION,
				ROUND(EXPENSES.AMOUNT,0) as AMOUNT,DATE_FORMAT(EXPENSE_DATE,'%d/%m/%Y')  as EXPENSE_DATE,
				EXPENSES.USER_ID ,USERS.NAME as USER_NAME
				FROM GHARKAHISAB_EXPENSES EXPENSES
			    INNER JOIN GHARKAHISAB_EXPENSE_TYPES EXPENSE_TYPES
				ON 	EXPENSES.EXPENSE_TYPE_ID = EXPENSE_TYPES.EXPENSE_ID
				INNER JOIN GHARKAHISAB_USERS USERS
				ON USERS.USER_ID = EXPENSES.USER_ID
				WHERE ACCOUNTING_YEAR_MONTH =" . $acc_year_month  ;
	
	
	if ($expense_type_id != '') {
		$sql2 = " AND EXPENSES.EXPENSE_TYPE_ID = " . $expense_type_id;
	}

	if(!$view_all_flag){
		$sql3= " and EXPENSES.USER_ID ='" . $_SESSION ["userName"] . "' ";
	}
	
	
	$sql4 = "   ORDER BY EXPENSE_DATE, EXPENSES.EXPENSE_TYPE_ID,EXPENSES.USER_ID  DESC";
	
	$sql = $sql1 . $sql2 . $sql3.$sql4;
	//echo $sql;
	
	$rst_expenses = mysqli_query ( $con, $sql );
	$total_expense_amount =0;
	//Secho $rst_expenses;
	
	while ( $row_expenses = mysqli_fetch_array ( $rst_expenses ) ) {
		echo '<tr><td >' . $row_expenses ['EXPENSE_DATE'] . '</td><td >' . $row_expenses ['DESCRIPTION'] . '</td><td align="right">' . $row_expenses ['AMOUNT'] ;
		
		if ($display_applicable_amount_flag) {
			$expenses_summary_arr = array ();
			$expenses_summary_arr [$expense_type_id] = $row_expenses ['AMOUNT'];
			$applicable_amount = get_summary_due_amount_by_user_expense ( $acc_year_month, $expense_user_id, $expense_type_id, $expenses_summary_arr );
			
			echo '<td >' . $applicable_amount . '</td>';
		}
		
		if ($display_expense_type_flag) {
			echo '<td >' . $row_expenses ['EXPENSE_TYPE'] . '</td>';
		}

		if ($display_expense_user_name_flag) {
			echo '<td >' . $row_expenses ['USER_NAME'] . '</td>';
		}
		
		if ($display_delete_flag) {
			//echo '<td><a href="expenseLog.php?command=delete&expense_id=' . $row_expenses ["EXPENSE_ID"] . '">Delete</a></td>';
			echo '<td><a href="javascript:delete_expense_entry(' . $row_expenses ["EXPENSE_ID"] . ')">Delete</a></td>';
			
		}

		$total_expense_amount = $total_expense_amount + $row_expenses ['AMOUNT'];
		
		
		echo '</tr>';
		
	}
	echo '<tr><td></td><td><b>Total</b></td><td align="right"><b>'.$total_expense_amount.'</b></td></tr>';
	echo '</table>';
	// }
	
	// $acc_year_month = $row['ACCOUNTING_YEAR_MONTH'] ;
	mysqli_close ( $con );
}
//
function display_payments($acc_year_month, $display_delete_flag,$view_all_flag,$display_user_name_flag) {
	$con = open_db_connection ();

	echo '<table class="table table-hover table-condensed  table-bordered "   ><tr><th class="col-sm-1">Date</th><th class="col-sm-2">Description</th><th class="col-sm-1">Amount</th><th class="col-sm-1">From</th>';


	if ($display_user_name_flag) {
		echo '<th class="col-sm-1">User</th>';
	}

	if ($display_delete_flag) {
		echo '<th class="col-sm-1">Delete</th>';
	}

	echo '</tr>';

	$sql1= "SELECT PAYMENT_ID,DESCRIPTION,ROUND(AMOUNT,0) as AMOUNT ,
			FROMUSERS.NAME as PAYMENT_FROM,
			DATE_FORMAT(PAYMENT_DATE,'%d/%m/%Y')  as PAYMENT_DATE,
			PAID_USERS.NAME as PAID_USER
			FROM GHARKAHISAB_PAYMENTS PAYMENTS
			INNER JOIN GHARKAHISAB_USERS FROMUSERS
			ON FROMUSERS.USER_ID = PAYMENTS.PAYMENT_FROM
			INNER JOIN GHARKAHISAB_USERS PAID_USERS
			ON PAID_USERS.USER_ID = PAYMENTS.USER_ID
			WHERE ACCOUNTING_YEAR_MONTH =" . $acc_year_month ;
			

	if(!$view_all_flag){
		$sql2= " and PAYMENTS.USER_ID ='" . $_SESSION ["userName"] . "' ";
	}


	$sql3 = " ORDER BY PAYMENT_DATE DESC,PAYMENT_FROM ASC,PAID_USER ASC";

	$sql = $sql1 . $sql2 . $sql3;

	
	$rst_payments = mysqli_query ( $con, $sql );
	$total_payment_amount =0;

	while ( $row_payments = mysqli_fetch_array ( $rst_payments ) ) {
		echo '<tr><td >' . $row_payments ['PAYMENT_DATE'] . '</td><td >' . $row_payments ['DESCRIPTION'] . '</td><td align="right">' . $row_payments ['AMOUNT'] .'</td><td>' . $row_payments ['PAYMENT_FROM'] .'</td>';


		if ($display_user_name_flag) {
			echo '<td >' . $row_payments ['PAID_USER'] . '</td>';
		}

		if ($display_delete_flag) {
			echo '<td><a href="javascript:delete_payment_entry(' . $row_payments ["PAYMENT_ID"] . ')">Delete</a></td>';
				
		}

		$total_payment_amount = $total_payment_amount + $row_payments ['AMOUNT'];


		echo '</tr>';

	}
	echo '<tr><td></td><td><b>Total</b></td><td align="right"><b>'.$total_payment_amount.'</b></td></tr>';
	echo '</table>';

	mysqli_close ( $con );
}
//


function populate_summary_due_table($accyearmonth,$reimb_user,$cash_pay_users_arr,$expenses_summary_arr,$summary_payment_arr,$display_total_due_column,$show_footer_total_flag){

	echo'<table class="table table-hover table-condensed">
			<tr>';
			display_summary_dues_header($expenses_summary_arr,$display_total_due_column);
	echo ' </tr>';
			display_summary_dues_rows($accyearmonth,$reimb_user,$cash_pay_users_arr,$expenses_summary_arr,$summary_payment_arr,$display_total_due_column);
	echo' <tr><td></td></tr>';
	if($show_footer_total_flag == TRUE){
		echo '<tr><td><b>Total</b></td>';
			display_summary_dues_footer_total($expenses_summary_arr,$summary_payment_arr,$display_total_due_column);						
		echo '</tr>';
	}
	echo '	</table>';	
}


function checkForZEROArray(){
	
}

//




// function display_payments($acc_year_month) {
// 	$con = open_db_connection ();
	
// 	$rstDates = mysqli_query ( $con, "SELECT DISTINCT DATE_FORMAT(PAYMENT_DATE,'%d/%m/%Y')  as PAYMENT_DATE FROM GHARKAHISAB_PAYMENTS WHERE ACCOUNTING_YEAR_MONTH =" . $acc_year_month . " and USER_ID ='" . $_SESSION ["userName"] . "' ORDER BY PAYMENT_DATE DESC" );
	
// 	// echo "SELECT DISTINCT EXPENSE_DATE as EXPENSE_DATE FROM GHARKAHISAB_EXPENSES WHERE ACCOUNTING_YEAR_MONTH =".$acc_year_month." and USER_ID ='".$_SESSION["userName"]."'";
	
// 	while ( $row_dates = mysqli_fetch_array ( $rstDates ) ) {
// 		echo '<b>' . $row_dates ['PAYMENT_DATE'] . '</b>';
// 		echo "<br>";
// 		echo '<table class="table table-hover table-condensed">';
		
// 		$rst_expenses = mysqli_query ( $con, "SELECT PAYMENT_ID,DESCRIPTION,ROUND(AMOUNT,0) as AMOUNT FROM GHARKAHISAB_PAYMENTS WHERE ACCOUNTING_YEAR_MONTH =" . $acc_year_month . " and USER_ID ='" . $_SESSION ["userName"] . "' AND payment_date=str_to_date('" . $row_dates ['PAYMENT_DATE'] . "','%d/%m/%Y')  ORDER BY PAYMENT_DATE DESC" );
// 		// echo "SELECT * FROM GHARKAHISAB_EXPENSES WHERE ACCOUNTING_YEAR_MONTH =".$acc_year_month." and USER_ID ='".$_SESSION["userName"]."' AND expense_date=str_to_date('".$row_dates['EXPENSE_DATE']."','%d/%m/%Y') ORDER BY EXPENSE_DATE DESC";
// 		while ( $row_expenses = mysqli_fetch_array ( $rst_expenses ) ) {
// 			echo '<tr><td width="10%" >&nbsp;</td><td width="80%" >' . $row_expenses ['DESCRIPTION'] . '  --  ' . $row_expenses ['AMOUNT'] . '</td><td><a href="?command=delete&payment_id=' . $row_expenses ["PAYMENT_ID"] . '">Delete</a></td></tr>';
// 		}
// 		echo '</table>';
// 	}
	
// 	// $acc_year_month = $row['ACCOUNTING_YEAR_MONTH'] ;
// 	mysqli_close ( $con );
// }

function get_user_full_name($user_id) {
	$con = open_db_connection ();

	$rstUsers = mysqli_query ( $con, "SELECT NAME FROM GHARKAHISAB_USERS WHERE USER_ID=".$user_id );

	while ( $row_users = mysqli_fetch_array ( $rstUsers ) ) {
		return $row_users ['NAME'] ;
	}

	mysqli_close ( $con );
}


function display_summary_users() {
	$con = open_db_connection ();
	
	$rstUsers = mysqli_query ( $con, "SELECT NAME FROM GHARKAHISAB_USERS ORDER BY NAME ASC" );
	echo '<table class="table table-hover table-condensed"><tr>';
	
	while ( $row_users = mysqli_fetch_array ( $rstUsers ) ) {
		echo '<td>' . $row_users ['NAME'] . '</td>';
	}
	
	echo '</tr>';
	
	while ( $row_users = mysqli_fetch_array ( $rstUsers ) ) {
		echo '<td>' . $row_users ['NAME'] . '</td>';
	}
	mysqli_close ( $con );
}
// ----
function populate_users_dropdown() {
	$con = open_db_connection ();
	
	$rstUsers = mysqli_query ( $con, "SELECT USER_ID,NAME FROM GHARKAHISAB_USERS ORDER BY NAME ASC" );
	
	while ( $row_users = mysqli_fetch_array ( $rstUsers ) ) {
		echo '<option value=' . $row_users ['USER_ID'] . '>' . $row_users ['NAME'] . '</option>';
	}
	mysqli_close ( $con );
}
// ----
function populate_expense_type_dropdown() {
	$con = open_db_connection ();
	
	$rstUsers = mysqli_query ( $con, "SELECT EXPENSE_ID,DESCRIPTION FROM GHARKAHISAB_EXPENSE_TYPES ORDER BY SORT_ORDER ASC" );
	
	while ( $row_users = mysqli_fetch_array ( $rstUsers ) ) {
		echo '<option value=' . $row_users ['EXPENSE_ID'] . '>' . $row_users ['DESCRIPTION'] . '</option>';
	}
	mysqli_close ( $con );
}
function ceate_expense_detail_arr_of_applicable_amt($acc_year_month,$view_all_flag, $reiumb_user_id) {
	$con = open_db_connection ();
	
	$sql1 = "SELECT EXPENSE_TYPES.DESCRIPTION as EXPENSE_TYPE,ROUND(SUM(EXPENSES.AMOUNT),0) as AMOUNT, EXPENSES.EXPENSE_TYPE_ID
				FROM GHARKAHISAB_EXPENSES EXPENSES
			    INNER JOIN GHARKAHISAB_EXPENSE_TYPES EXPENSE_TYPES
				ON 	EXPENSES.EXPENSE_TYPE_ID = EXPENSE_TYPES.EXPENSE_ID
				WHERE ACCOUNTING_YEAR_MONTH =" . $acc_year_month ;
	// echo $sql;
	
	if(!$view_all_flag){
		$sql2 = " and USER_ID ='" . $reiumb_user_id . "'";
	}
	
	$sql3=" GROUP BY EXPENSE_TYPES.DESCRIPTION";
	
	$sql=$sql1.$sql2.$sql3;
	
	//echo $sql ."<br/>";
	
	$rst_expenses = mysqli_query ( $con, $sql );
	$expenses_summary_arr = array ();
	
	while ( $row_expenses = mysqli_fetch_array ( $rst_expenses ) ) {
		// echo '<tr><td >' . $row_expenses ['EXPENSE_TYPE'] . '</td><td align="right">' . $row_expenses ['AMOUNT'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';
		$expenses_summary_arr [$row_expenses ['EXPENSE_TYPE_ID']] = $row_expenses ['AMOUNT'];
		//echo 'EXPENSE_TYPE_ID - ' .$row_expenses ['EXPENSE_TYPE_ID'];
	}
	
	mysqli_close ( $con );
	
	return $expenses_summary_arr;
}
function display_summary_payments($acc_year_month) {
	$con = open_db_connection ();
	
	$sql = "SELECT USERS.NAME ,ROUND(SUM(PAYMENTS.AMOUNT),0) as AMOUNT
				FROM GHARKAHISAB_PAYMENTS PAYMENTS
			    INNER JOIN GHARKAHISAB_USERS USERS
				ON 	PAYMENTS.PAYMENT_FROM = USERS.USER_ID
				WHERE ACCOUNTING_YEAR_MONTH =" . $acc_year_month . " and PAYMENTS.USER_ID ='" . $_SESSION ["userName"] . "' GROUP BY USERS.NAME";
	// echo $sql;
	
	$rst_expenses = mysqli_query ( $con, $sql );
	
	while ( $row_expenses = mysqli_fetch_array ( $rst_expenses ) ) {
		echo '<tr><td >' . $row_expenses ['NAME'] . '</td><td align="right">' . $row_expenses ['AMOUNT'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';
	}
	
	mysqli_close ( $con );
}
function display_summary_dues_header($expenses_summary_arr,$display_total_due_column) {
	echo '<th  class="col-sm-1">Name</th>';
	foreach ( array_keys ( $expenses_summary_arr ) as $expense_type ) {
		
		echo '<th  class="col-sm-2">' . get_expense_type_desc ( $expense_type ) . '</th>';
	}

	echo '<th class="col-sm-2">Payment Received</th>';
	
	if($display_total_due_column){
		echo '<th class="col-sm-2">Total Due</th>';
	}
	
}
function display_all_expenses() {
}
function get_expense_type_desc($expense_type_id) {
	$con = open_db_connection ();
	
	$sql = "SELECT DESCRIPTION
				FROM GHARKAHISAB_EXPENSE_TYPES EXPENSE_TYPES
				WHERE EXPENSE_ID =" . $expense_type_id;
	// echo $sql;
	
	$rst_expense_type = mysqli_query ( $con, $sql );
	$row_expense_type = mysqli_fetch_array ( $rst_expense_type );
	
	mysqli_close ( $con );
	return $row_expense_type ['DESCRIPTION'];
}
function populate_summary_payments_arr($acc_year_month, $cash_pay_users_arr, $reiumb_user_id,$view_all_flag) {
	$summary_payments_arr = array ();
	
	foreach ( array_keys($cash_pay_users_arr) as $cash_pay_user_id ) {
		$total_payment_received = get_summary_payment_by_user ( $acc_year_month, $cash_pay_user_id, $reiumb_user_id,$view_all_flag );
		$summary_payments_arr [$cash_pay_user_id] = $total_payment_received;
		
	}
	
	return $summary_payments_arr;
}
function populate_cash_pay_users_arr() {
	$con = open_db_connection ();
	
	$sql = "SELECT USERS.USER_ID,USERS.NAME
						FROM GHARKAHISAB_USERS USERS
						WHERE CASH_PAY ='Y' ORDER BY USERS.NAME";
	// echo $sql;
	
	$rst_cash_pay_users = mysqli_query ( $con, $sql );
	$cash_pay_users_arr = array ();
	while ( $row_cash_pay_users = mysqli_fetch_array ( $rst_cash_pay_users ) ) {
		$cash_pay_users_arr [$row_cash_pay_users ['USER_ID']] = $row_cash_pay_users ['NAME'];
	}
	
	return $cash_pay_users_arr;
}



function display_summary_dues_rows($acc_year_month, $reiumb_user_id, $cash_pay_users_arr, $expenses_summary_arr,$summary_payment_arr,$display_total_due_column) {
	$con = open_db_connection ();
	
	// $sql = "SELECT USERS.USER_ID,USERS.NAME
	// FROM GHARKAHISAB_USERS USERS
	// WHERE CASH_PAY ='Y' and USERS.USER_ID !=".$reiumb_user_id." ORDER BY USERS.NAME";
	// // echo $sql;
	
	// $rst_cash_pay_users = mysqli_query ( $con, $sql );
	
	// while ( $row_cash_pay_users = mysqli_fetch_array ( $rst_cash_pay_users ) ) {
	
	foreach ( array_keys ( $cash_pay_users_arr ) as $cash_pay_user_id ) {
		
		//echo '<tr><td >' . $row_cash_pay_users ['NAME'] . '</td>';
		echo '<tr><td >' .$cash_pay_users_arr [$cash_pay_user_id] . '</td>';
		
		
		
		// display expenses for user
		$total_expense_amount = 0;
		foreach ( array_keys ( $expenses_summary_arr ) as $expense_type ) {
			$due_amount = get_summary_due_amount_by_user_expense ( $acc_year_month, $cash_pay_user_id, $expense_type, $expenses_summary_arr );
			$total_expense_amount = $total_expense_amount + $due_amount;
			if ($due_amount != 0) {
				echo '<td ><font color="blue"><a href="javascript:open_expenses_detail_window(' . $acc_year_month . ',' . $expense_type . ',' . $cash_pay_user_id . ')">' . $due_amount . '</a></font></td>';
			} else {
				echo '<td >' . $due_amount . '</td>';
			}
		}
		
		
		// display payments for user
		$total_payment_received = $summary_payment_arr[$cash_pay_user_id];
		
		if ($total_payment_received > 0) {
			echo '<td><font color="red">(' . $total_payment_received . ')</font></td>';
		} else {
			echo '<td>&nbsp;</td>';
		}
		
		// display total due
		if($reiumb_user_id== $cash_pay_user_id){
			$total_due = 0;
		}else{
			$total_due = $total_expense_amount - $total_payment_received;
				
		}
		
		if($display_total_due_column){
			if ($total_due >= 0) {
				echo '<td><font color="blue">' . $total_due . '</font></td>';
			} else {
				echo '<td><font color="red">' . $total_due . '</font></td>';
			}
		}
		
		echo '</tr>';
	}
	
	// }
	
	mysqli_close ( $con );
}
function get_summary_payment_by_user($acc_year_month, $cash_pay_user_id, $reiumb_user_id,$view_all_flag) {
	$con = open_db_connection ();
	
	$sql1 = "SELECT ROUND(SUM(PAYMENTS.AMOUNT),0) as AMOUNT
				FROM GHARKAHISAB_PAYMENTS PAYMENTS
				WHERE ACCOUNTING_YEAR_MONTH =" . $acc_year_month . " and PAYMENTS.PAYMENT_FROM =" . $cash_pay_user_id  ;
	
	if(!$view_all_flag){
		$sql2= "  AND PAYMENTS.USER_ID=" . $reiumb_user_id ;
	}
	
	
	$sql = $sql1.$sql2;
	
	
	// echo $sql;
	
	$rst_payment = mysqli_query ( $con, $sql );
	$row_payment = mysqli_fetch_array ( $rst_payment );
	
	mysqli_close ( $con );
	return $row_payment ['AMOUNT'];
}


function display_expense_log_page($accyearmonth,$ip_display_expense_type_flag,$ip_display_delete_flag,$ip_display_applicable_amount_flag,$expense_type_id,$ip_view_all_flag,$ip_display_expense_user_name_flag,$expense_user_id){
	if($ip_display_expense_type_flag=="TRUE" || $ip_display_expense_type_flag==""){
		$display_expense_type_flag = TRUE;
	}
		
	if($ip_display_delete_flag=="TRUE" || $ip_display_delete_flag==""){
		$display_delete_flag = TRUE;
	}
	
	if($ip_display_applicable_amount_flag =="TRUE"){
		$display_applicable_amount_flag=TRUE;
	}
	
	if($ip_view_all_flag=="TRUE"){
		$view_all_flag = TRUE;
	}

	if($ip_display_expense_user_name_flag=="TRUE"){
		$display_expense_user_name_flag = TRUE;
	}
	
	
	
	display_expenses($accyearmonth,$display_expense_type_flag,$display_delete_flag,$expense_type_id,$display_applicable_amount_flag,$view_all_flag,$display_expense_user_name_flag,$expense_user_id);
	
}

function display_payment_log_page($accyearmonth,$ip_display_delete_flag,$ip_view_all_flag,$ip_display_user_name_flag){

	if($ip_display_delete_flag=="TRUE" || $ip_display_delete_flag==""){
		$display_delete_flag = TRUE;
	}


	if($ip_view_all_flag=="TRUE"){
		$view_all_flag = TRUE;
	}

	if($ip_display_user_name_flag=="TRUE"){
		$display_user_name_flag = TRUE;
	}


	display_payments($accyearmonth,$display_delete_flag,$view_all_flag,$display_user_name_flag);
}


//
function get_expense_types_arr() {
	$con = open_db_connection ();
	
	$sql = "SELECT EXPENSE_ID,DESCRIPTION,SORT_ORDER
						FROM GHARKAHISAB_EXPENSE_TYPES EXPENSE_TYPES
						ORDER BY SORT_ORDER";
	// echo $sql;
	
	$rst_expense_types = mysqli_query ( $con, $sql );
	$expense_type_arr= array();
	while ( $row_expense_types = mysqli_fetch_array ( $rst_expense_types ) ) {
		$expense_type_arr[$row_expense_types['EXPENSE_ID']] = $row_expense_types['DESCRIPTION'];
	}
	
	return $expense_type_arr;
}
//

function get_final_due_amount_by_reiumb_user_and_cash_pay_user($acc_year_month, $cash_pay_user_id, $reiumb_user_id) {

	$view_all_flag = FALSE;
	
	if ($cash_pay_user_id != $reiumb_user_id) {
		
		$expenses_summary_arr = ceate_expense_detail_arr_of_applicable_amt ( $acc_year_month,false, $reiumb_user_id );
		// var_dump($expenses_summary_arr) ;
		// echo '<br/>';
		$total_expense_amt = 0;
		
		// display expenses for user
		$total_expense_amount = 0;
		foreach ( array_keys ( $expenses_summary_arr ) as $expense_type ) {
			$due_amount = get_summary_due_amount_by_user_expense ( $acc_year_month, $cash_pay_user_id, $expense_type, $expenses_summary_arr );
			$total_expense_amount = $total_expense_amount + $due_amount;
			
			// echo '-----$due_amount-'.$due_amount.'<br/>';
		}
		
		$payment_amt = get_summary_payment_by_user ( $acc_year_month, $cash_pay_user_id, $reiumb_user_id,$view_all_flag );
		
		return $total_expense_amount - $payment_amt;
	} else {
		return 0;
	}
}
function get_summary_due_amount_by_user_expense($acc_year_month, $user_id, $expense_type_id, $expenses_summary_arr) {
	$con = open_db_connection ();
	
	 //echo 'userid - '. $user_id. '<br/>';
	 //echo 'expense_type_id - '.$expense_type_id. '<br/>';
	 //echo 'expenses_summary_arr - '.var_dump($expenses_summary_arr). '<br/>';
	
	$sql = "SELECT EXPENSE_RULES.CHARGE_TYPE,USER_ID
						FROM GHARKAHISAB_EXPENSE_RULES EXPENSE_RULES
						WHERE EXPENSE_TYPE_ID =" . $expense_type_id;
	// echo $sql;
	
	$rst_expenses_rule = mysqli_query ( $con, $sql );
	
	$row_expense_rule = mysqli_fetch_array ( $rst_expenses_rule );
	
	$charge_type = $row_expense_rule ['CHARGE_TYPE'];
	$allocate_user_id = $row_expense_rule ['USER_ID'];
	
	// echo $sql;
	
	if ($charge_type == 'CHARGE_EQUAL') {
		
		$sql = "SELECT COUNT(*) TOTAL_CASH_PAY_USER_COUNT 
						FROM GHARKAHISAB_USERS USERS
						WHERE CASH_PAY ='Y'";
		// echo $sql;
		
		$rst_user_count = mysqli_query ( $con, $sql );
		
		$row_user_count = mysqli_fetch_array ( $rst_user_count );
		
		$total_cash_pay_user_count = $row_user_count ['TOTAL_CASH_PAY_USER_COUNT'];
		
		return round ( $expenses_summary_arr [$expense_type_id] / $total_cash_pay_user_count );
	}
	
	if ($charge_type == 'CHARGE_AS_RATIO') {
		
		$sql = "SELECT TOTAL_COUNT,ALLOCATED_COUNT
						FROM GHARKAHISAB_USERS_EXPENSE_RATIO EXPENSE_RATIO
						WHERE ACC_YEAR_MONTH =" . $acc_year_month . " AND user_id=" . $user_id;
		// echo $sql;
		
		$rst_expense_ratio = mysqli_query ( $con, $sql );
		
		$row_expense_ratio = mysqli_fetch_array ( $rst_expense_ratio );
		
		$total_user_count = $row_expense_ratio ['TOTAL_COUNT'];
		$allocated_user_count = $row_expense_ratio ['ALLOCATED_COUNT'];
		
		$ratio_amount = ($expenses_summary_arr [$expense_type_id] * $allocated_user_count) / $total_user_count;
			
		
		
		return round ( $ratio_amount );
	}
	
	if ($charge_type == 'CHARGE_FULL') {
		
		if ($allocate_user_id == $user_id) {
			return round ( $expenses_summary_arr [$expense_type_id] );
		} else {
			return 0;
		}
	}
	
	// echo $user_id .' -- ',$expense_type_id;
	// return 10;
}
function viewall_display_users_column() {
	$con = open_db_connection ();
	
	$sql = "SELECT USERS.USER_ID,USERS.NAME
						FROM GHARKAHISAB_USERS USERS
						 ORDER BY USERS.NAME";
	// echo $sql;
	
	$rst_expenses = mysqli_query ( $con, $sql );
	
	while ( $row_expenses = mysqli_fetch_array ( $rst_expenses ) ) {
		echo '<tr><td >' . $row_expenses ['NAME'] . '</td>';
	}
}
function view_all_get_total_due_amount($cash_pay_user, $user) {
	return 0;
}
function display_summary_dues_footer_total($expenses_summary_arr,$summary_payment_arr,$display_total_due_column) {
	//var_dump ( $expenses_summary_arr );
	$total_expense_amt =0;
	foreach ( $expenses_summary_arr as $expense ) {
		$total_expense_amt = $total_expense_amt + $expense;
		echo '<td>' . $expense . '</td>';
	}
	
	$total_payment_amt = 0;
	foreach ($summary_payment_arr as $payment_per_user){
		$total_payment_amt =  $total_payment_amt  + $payment_per_user;
	}
	echo '<td>' . $total_payment_amt . '</td>';
	
	if($display_total_due_column){
		$total_due_amt = $total_expense_amt - $total_payment_amt;
		echo '<td>' . $total_due_amt . '</td>';
	}
	
	
}

function populate_personal_exp_mapping_for_cash_pay_user($cash_pay_users_arr){
	$con = open_db_connection ();

	foreach ( array_keys($cash_pay_users_arr) as $cash_pay_user ) {
	
	
	
	$sql = "SELECT MIN(EXPENSE_TYPE_ID) as EXPENSE_TYPE_ID
						FROM GHARKAHISAB_EXPENSE_RULES EXPENSE_RULES WHERE CHARGE_TYPE = 'CHARGE_FULL'
						AND EXPENSE_RULES.USER_ID=".$cash_pay_user;
	// echo $sql.'<br/>';
	
	$rst_expenses = mysqli_query ( $con, $sql );
	
	$row_expenses = mysqli_fetch_array ( $rst_expenses ) ;
	$personal_exp_type_cash_user_arr[$cash_pay_user]=  $row_expenses ['EXPENSE_TYPE_ID'] ;
	//echo '$cash_pay_user'.$cash_pay_user;
	//echo 'EXPENSE_TYPE_ID'.$row_expenses ['EXPENSE_TYPE_ID'];
	
	}
	
	return $personal_exp_type_cash_user_arr;
	
}

function create_past_dues_for_next_acc_month($con,$personal_exp_type_cash_user_arr,$past_due_amt, $cash_pay_user, $reimb_user_id,$users_arr){

	$accyearmonth=get_open_acc_year_month();
	
	if($past_due_amt !=0){
		$expense_type = $personal_exp_type_cash_user_arr[$cash_pay_user];
		
		$accyear = substr($accyearmonth,0,4);
		$expenseDesc ="Past due for ".getMonthName(substr($accyearmonth,4)) ." ". $accyear ." - ".$users_arr[$reimb_user_id] ." (".$users_arr[$cash_pay_user] .")" ;
		$expenseYear = date("Y");
		$expenseMonth = date("m");
		$expenseDay = date("d");
		
		//var_dump($personal_exp_type_cash_user_arr).'<br/>';
		//echo '$cash_pay_user-'.$cash_pay_user.'<br/>';
		
		createExpenseEntry($expense_type, $expenseYear, $expenseMonth, $expenseDay, $expenseDesc, $past_due_amt, $reimb_user_id,$con);
		
	}	
}



function populate_all_users_arr(){
	$con = open_db_connection ();
	
	$sql = "SELECT USERS.USER_ID,USERS.NAME,CASH_PAY
								FROM GHARKAHISAB_USERS USERS
								 ORDER BY USERS.NAME";
	// echo $sql;
	
	$rst_expenses = mysqli_query ( $con, $sql );
	
	$users = array ();
	
	
	while ( $row_expenses = mysqli_fetch_array ( $rst_expenses ) ) {
		$users [$row_expenses ['USER_ID']] = $row_expenses ['NAME'];
	}
	mysqli_close ( $con );
	
	return $users;
	
}

function save_current_statement_html($acc_year_month){
	$ini_array = parse_ini_file ( "config.ini" );
	$statement_dir=$ini_array['statements_path'];
	
	$current_script_path = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$running_stmnt_script_path = "http://".$_SERVER['HTTP_HOST'].'/'.$ini_array['running_stmnt_script_path'];
	//echo 'running_stmnt_script_path'.$running_stmnt_script_path;
	$returned_content = get_data($running_stmnt_script_path);

	$filename = $statement_dir.'/'.$acc_year_month.'.html';
	//echo $filename;
	$file_handle = fopen($filename, 'w') or die('Cannot open file:  '.$filename);
	fwrite($file_handle, $returned_content);
	
}

function get_statement_webpath(){
	$ini_array = parse_ini_file ( "config.ini" );

	$statements_web_path = "http://".$_SERVER['HTTP_HOST'].'/'.$ini_array['statements_web_path'];
	
	return $statements_web_path;
	
}


function generate_statment(){
	
	$statement_generated_flag = false;
	
	$con = open_db_connection ();
	
	// Set autocommit to off
	mysqli_autocommit($con,FALSE);
	
	$accyearmonth = get_open_acc_year_month ();
	$users = populate_all_users_arr();
	$cash_pay_users_arr = populate_cash_pay_users_arr ();
	
	$personal_exp_type_cash_user_arr = populate_personal_exp_mapping_for_cash_pay_user($cash_pay_users_arr);
	//var_dump($personal_exp_type_cash_user_arr);
	
	
	save_current_statement_html($accyearmonth);
	
	open_next_acc_year_month($con);
	
	foreach ( array_keys($users) as $user ) {
		$reimb_user_id = $user;
			
		foreach ( array_keys($cash_pay_users_arr) as $cash_pay_user ) {
			$past_due_amt = get_final_due_amount_by_reiumb_user_and_cash_pay_user ( $accyearmonth, $cash_pay_user, $reimb_user_id );
			//echo '$past_due_amt'.$past_due_amt.'<br/>';
			create_past_dues_for_next_acc_month($con,$personal_exp_type_cash_user_arr,$past_due_amt, $cash_pay_user, $reimb_user_id,$users );
			
			
			
		}
	}
	
	
	// Commit transaction
	mysqli_commit($con);
	
	mysqli_close ( $con );
	
	$statement_generated_flag = true;
	
	
	return $statement_generated_flag;
	
}


/* gets the data from a URL */
function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

function get_month_name_of_acc_month_year($accyearmonth){
	$accyear = substr($accyearmonth,0,4);
	$month_name_year= getMonthName(substr($accyearmonth,4)) ." ". $accyear;
	return 	$month_name_year;
}

?>