<?php 
include_once 'functions.php';
check_authentication ( 'index.php' );

//var_dump($_REQUEST);


     
 //phpinfo();    
     
$accyearmonth=$_REQUEST["acc_year_month"];
$ip_display_delete_flag = $_REQUEST["display_delete_flag"];
$view_all_flag="FALSE";
$ip_display_user_name_flag="FALSE";
		

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
	
	<script type="text/javascript">
		function delete_payment_entry(payment_id){
			if(confirm("Are you sure you want to delete this entry ?")){
				parent.document.location = "paymentLog.php?command=delete&payment_id="+payment_id;
			}
		}

	</script>
	

	<div class="container">

<h3>Payments</h3>

		<form role="form" method="post" action="expenseLog.php">
			
		</form>
		
		<?php  
			$accyearmonth=get_open_acc_year_month(); 
			display_payment_log_page($accyearmonth, $ip_display_delete_flag, $ip_view_all_flag, $ip_display_user_name_flag)
		?>
		
	</div>

</body>
</html>