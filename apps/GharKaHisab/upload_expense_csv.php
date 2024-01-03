
<?php
include_once 'functions.php';

$file_tmp =$_FILES['fileToUpload']['tmp_name'];
$target_dir = "data/csv_upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {


	move_uploaded_file($file_tmp,$target_file);

	$file = fopen($target_file,"r");
	$line_counter = 0;
	$csv_file_error =false;
	
	while(! feof($file))
	  {
		 $csv_cols = fgetcsv($file);

		if($line_counter==0){
			if($csv_cols[0]!="Date"){
			 echo "Date column missing";
			 $csv_file_error = true;
			}

			if($csv_cols[1]!="Grocery amount"){
			 echo "Grocery amount column missing";
			 $csv_file_error = true;
			}

			if($csv_cols[2]!="Grocery remarks"){
			 echo "Grocery remarks column missing";
			 $csv_file_error = true;
			}
			
			if($csv_cols[3]!="50/50 amount"){
			 echo "50/50 amount column missing";
			 $csv_file_error = true;
			}		

			if($csv_cols[4]!="50/50 remarks"){
			 echo "50/50 remarks column missing";
			 $csv_file_error = true;
			}
			
			if($csv_file_error){
			  break;
			}
			
		}else{
		
			$str_expense_date = trim($csv_cols[0]);
			if($str_expense_date == NULL){
			  $str_expense_date = $str_earlier_expense_date;
			}
			$date_arr = validate_date($str_expense_date);
			$str_earlier_expense_date = $str_expense_date;
			
			$expenseYear=$date_arr[2];
			$expenseMonth=$date_arr[1];
			$expenseDay=$date_arr[0];
			
			$con=null;
			$userId = 4;
			
			if(!(trim($csv_cols[1]) == NULL)){ //grocery
			  $expenseType = 1; 
			  $expenseAmount = trim($csv_cols[1]);
			  $expenseDesc = trim($csv_cols[2]);
			  
			   echo "Processing file - Grocery<br/>";
			  createExpenseEntry($expenseType, $expenseYear, $expenseMonth, $expenseDay, $expenseDesc, $expenseAmount, $userId,$con);
			}
			
			if(!(trim($csv_cols[3]) == NULL)){ //grocery
			  $expenseType = 2; 
			  $expenseAmount = trim($csv_cols[3]);
			  $expenseDesc = trim($csv_cols[4]);
			  
			  echo "Processing file - 50/50<br/>";
			  createExpenseEntry($expenseType, $expenseYear, $expenseMonth, $expenseDay, $expenseDesc, $expenseAmount, $userId,$con);
			}
			

		
		}
	
		

		
		
		//createExpenseEntry($expenseType, $expenseYear, $expenseMonth, $expenseDay, $expenseDesc, $expenseAmount, $userId,$con);


		$line_counter = $line_counter +1 ;


	  }




	fclose($file);
 	
}


function validate_date($str_date){
//date format = 01/12/2020
$date_arr = explode("/",$str_date); 
  if(checkdate($date_arr[1],$date_arr[0],$date_arr[2])){
     print_r($date_arr);
     return $date_arr;
  }else{
  	echo "<br>Invalid date - ". $str_date . "</br>" ;
  }
}
?>

