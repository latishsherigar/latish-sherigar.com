<?php
include_once 'functions.php';
check_authentication ( 'index.php' );

// var_dump($_REQUEST);

// phpinfo();

$command = $_REQUEST ["command"];

if ($command == "generate_statement") {
	$success_flag = generate_statment ();
	
}

$accyearmonth = get_open_acc_year_month ();
$month_name_year=get_month_name_of_acc_month_year($accyearmonth);

?>

<html>
<head>
<meta charset="utf-8">
<title>Statement</title>

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body>
	<script type='text/javascript' src="js/jquery-min.js"></script>
	<script type='text/javascript' src="js/bootstrap.min.js"></script>

	<script type="text/javascript">
function confirm_generateStatement(){
	confirm_sub_val = confirm("Are you sure you want to generate the statement?. This will bill everything till date and open up the next accounting month. ");
	if(confirm_sub_val){
		document.getElementById("statmentform").elements.namedItem("command").value="generate_statement";
		//document.getElementById("statement_generate_button").disabled
		//$('#myModal').modal('show')
		$('#statement_generate_button').prop('disabled', true);
	}
	else{
		return false;
	}
	//$('#myModal1').modal('show')
}

function viewStatement(){
	var_acc_year_month = document.getElementById("stmnt_acc_year_month_drpdwn").value;
	statement_url ="<?php echo get_statement_webpath()?>" + var_acc_year_month + ".html" ;
	//alert(statement_url);
	if(var_acc_year_month.length >0){
	    window.open(statement_url,"_blank","toolbar=no, location=no, scrollbars=yes, resizable=yes, top=500, left=500, width=400, height=400");
	
	}
    
}



</script>

	<div class="container">

	
<?php 
		if($success_flag){
			
			echo '<script type="text/javascript">';
			$acc_year_month_badge_html='<span  class=\"badge\">'. $month_name_year .'</span>';
			echo 'window.parent.document.getElementById("acc_year_month_badge").innerHTML="'.$acc_year_month_badge_html.'"';
			echo '</script>';
			echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Statement generated successfully.</div>';
		}

		?>


		<form id="statmentform" role="form" method="post"
			action="statement.php" onsubmit="return confirm_generateStatement()">

			
			<div class="row">

				<h4>Past statements</h4>
				<div class="form-group">
					<div class="col-xs-3">
						<label for="accountingYearMonth">Year Month</label> 
						<select
							id="stmnt_acc_year_month_drpdwn" name="accountingYearMonth"
							class="form-control">
							<option></option>
						<?php populate_acc_year_month_dropdown(false);?>
						</select>
					</div>
					<div class="col-xs-1">
						<label for="accountingYearMonth">&nbsp;</label> 
						<button type="button" class="btn btn-default" onclick="viewStatement()">View Statement</button>
						
					</div>
				</div>
			</div>
			<br />
			<div class="row">
				<h4>Current statement</h4>
				<button id="statement_generate_button" type="submit" class="btn btn-primary">Generate</button>

<!-- 				<div class="alert alert-success col-xs-3">sdsdsdsdsd</div> -->


			</div>
			<input type="hidden" name="command" />
		</form>


			<!-- Modal -->
	<div class="modal fade" id="statement_modal_popup" tabindex="-1" role="dialog"
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