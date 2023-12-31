<?php 
include_once 'functions.php';
check_authentication ( 'index.php' );

//var_dump($_REQUEST);


     
 //phpinfo();    
     
$accyearmonth=$_REQUEST["acc_year_month"];
$ip_display_expense_type_flag = $_REQUEST["display_expense_type_flag"];
$ip_display_delete_flag = $_REQUEST["display_delete_flag"];
$ip_display_applicable_amount_flag=$_REQUEST["display_applicable_amount_flag"];
$expense_type_id= $_REQUEST["expense_type_id"];
$expense_user_id= $_REQUEST["expense_user_id"];
$view_all_flag="FALSE";
$ip_display_expense_user_name_flag="FALSE"
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

	<script type="text/javascript">
		function delete_expense_entry(expense_id){
			if(confirm("Are you sure you want to delete this entry ?")){
				//alert(parent.document.location);
				parent.document.location = "expenseLog.php?command=delete&expense_id="+expense_id;
			}
		}

	</script>

	<div class="container">

<h3>Expenses
<?php 
if($expense_type_id!=''){
	echo ' - ' .get_expense_type_desc($expense_type_id);
}

?></h3>

		<form role="form" method="post" action="expenseLog.php">
			
		</form>
		
		<?php  
		display_expense_log_page($accyearmonth, $ip_display_expense_type_flag, $ip_display_delete_flag, $ip_display_applicable_amount_flag, $expense_type_id,$view_all_flag,$ip_display_expense_user_name_flag, $expense_user_id);
		?>
		
	</div>

</body>
</html>