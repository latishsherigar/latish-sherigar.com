<?php
include_once 'functions.php';
check_authentication ( 'index.php' );
$accyearmonth = get_open_acc_year_month ();
$month_name_year=get_month_name_of_acc_month_year($accyearmonth);

// var_dump($_SESSION)
?>


<html>
<head>
<meta charset="utf-8">
<title>Home</title>

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body>
	<script>
function logoutSession(){
	window.location.href="login.php?logout=true";
}

function refreshTab(tabName){

	if(tabName=="summary"){
		document.getElementById('summary_frame').src = "summary.php";
	}
		
	if(tabName=="expenses"){
		document.getElementById('expense_log_frame').src = "expenseLog.php";
	}
	
	if(tabName=="payments"){
		document.getElementById('payment_log_frame').src = "paymentLog.php";
	}
	
	if(tabName=="viewall"){
		document.getElementById('view_all_data_frame').src = "viewall.php?statement_mode=off";
	}
	
	if(tabName=="statement"){
		document.getElementById('statement_frame').src = "statement.php";
	}
	
	
}



</script>

	<div class="container">

		<table width="100%">
			<tr>
				<td><h2>Dashboard</h2></td>
				<td id="acc_year_month_badge" align="right">***Accounting year month badge**</td>
				<td align="right"><h4><span class="label label-default"><?php echo $_SESSION["user_full_name"] ?></span></h4></td>
				<td align="right">
					<button class="btn btn-primary" onclick="logoutSession()">Logout</button>
				</td>
			</tr>
		</table>
		
<script type="text/javascript">
	//update account year month badge
	window.parent.document.getElementById("acc_year_month_badge").innerHTML="<span  class=\"badge\"><?php echo $month_name_year?></span>";		
</script>

		<div id="content">
			<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
				<li class="active"><a href="#summary" data-toggle="tab" onclick="javascript:refreshTab('summary')">Summary</a></li>
				<li><a href="#expenses" data-toggle="tab" onclick="javascript:refreshTab('expenses')">Expenses</a></li>
				<li><a href="#payments" data-toggle="tab" onclick="javascript:refreshTab('payments')">Payments</a></li>
				<li><a href="#viewall" data-toggle="tab" onclick="javascript:refreshTab('viewall')" >View All</a></li>
				<li><a href="#statement" data-toggle="tab" onclick="javascript:refreshTab('statement')">Statement</a></li>
			</ul>
			<div id="my-tab-content" class="tab-content">
				<div class="tab-pane active" id="summary">
					<br />
					<iframe id="summary_frame" height="80%" width="100%" frameborder="0"
						src="summary.php"></iframe>
				</div>
			<div class="tab-pane" id="expenses">
					<br />
					<iframe id="expense_log_frame" height="80%" width="100%" frameborder="0"
						src="blank.html"></iframe>
				</div>
				<div class="tab-pane" id="payments">
					<br />
					<iframe id="payment_log_frame" height="80%" width="100%" frameborder="0"
						src="blank.html"></iframe>
				</div>
				<div class="tab-pane" id="viewall">
					<br />
					<iframe id="view_all_data_frame" height="80%" width="100%" frameborder="0"
						src="blank.html"></iframe>
				</div>
				<div class="tab-pane" id="statement">
					<br />
					<iframe id="statement_frame" height="80%" width="100%" frameborder="0"
						src="blank.html"></iframe>
				</div>
			</div>
		</div>



	</div>

	<script type='text/javascript' src="js/jquery-min.js"></script>
	<script type='text/javascript' src="js/bootstrap.min.js"></script>

</body>
</html>