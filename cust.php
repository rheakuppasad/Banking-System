<?php
    include 'database.php';
    session_start();

	if(isset($_POST['submit']))
	{
		$amount = floatval($_POST['amount']);
		$from_cust_id = $_POST['from_cust_id'];
		$to_cust_id = $_POST['to_cust'];
		
		$sql1 = "UPDATE customer SET cur_bal = cur_bal - $amount WHERE cust_id = $from_cust_id";
		$sql2 = "UPDATE customer SET cur_bal = cur_bal + $amount WHERE cust_id = $to_cust_id";
		$sql3 = "INSERT INTO transfer (from_cust, to_cust, amt_transferred) VALUES ($from_cust_id, $to_cust_id, $amount)";
		$result = mysqli_query($con, $sql1) or die('Error 1');
		$result = mysqli_query($con, $sql2) or die('Error 2');
		$result = mysqli_query($con, $sql3) or die('Error 3');
		header('Location:okay_pg.php');
		
	}

?>

<!--html-->

<!DOCTYPE html>

<html>
	<head>
		<style>
			body
			{
				background-image: url('https://www.ocbc.com/iwov-resources/sg/ocbc/personal/img/live/money2india-fund-transfer/masthead_money2indiafundtransfer.png');
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-size: cover;
			}
		</style>
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<title> Customer Page </title>
	</head>
	<body>
		<center>
			<br/>
			<h1 style=font-size:60px><center>Abc Bank</center></h1>
		</center>
		<br/>

<!--html-->
	
		<?php
			$cust_id = $_GET['cust_id'];
			$query = "SELECT * from customer where cust_id = $cust_id";
			$result = mysqli_query($con, $query) or die('Error-1');
			$row = mysqli_fetch_array($result);
			echo '
				<table class="table">
				  <thead>
					<tr>
					  <th scope="col">Customer ID</th>
					  <th scope="col" name="from_cust_id" value="'.$row['cust_id'].'">'.$row['cust_id'].'</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <th scope="row">Name</th>
					  <td>'.$row['cust_name'].'</td>
					</tr>
					<tr>
					  <th scope="row">E-mail</th>
					  <td>'.$row['email_id'].'</td>
					</tr>
					<tr>
					  <th scope="row">Current Balance</th>
					  <td>'.$row['cur_bal'].'</td>
					</tr>
				  </tbody>
				</table>';
		?>

<!--html-->

		<br/>
		<form method="post" action="cust.php">
			<div class="row mb-3">
				<label for="to_cust" class="col-sm-2 col-form-label"><center>Transfer money to:</center></label>
				<div class="col-md-3">
					<select id="to_cust" name="to_cust" class="form-select" id="validationCustom04" required>
						<option value='-'>Select name</option>

<!--html-->
					
						<?php
							$orig_cust_id = $_GET['cust_id'];
							$query = "SELECT * from customer where cust_id != $orig_cust_id";
							$result = mysqli_query($con, $query) or die('Error0');
							
							while($row = mysqli_fetch_array($result)) {
								$cust_id = $row['cust_id'];
								$cust_name = $row['cust_name'];
								echo '<option value="'.$cust_id.'">'.$cust_name.'</option>';
							}
							echo '
							<input type="hidden" id="from_cust_id" name="from_cust_id" value="'.$orig_cust_id.'" />'
						?>		
					</select>

<!--html-->
			
				</div>
			</div>
			<div class="row mb-3">
				<label for="to_cust" class="col-sm-2 col-form-label"><center>Enter amount:</center></label>
				<div class="col-md-3">
					<input type="number" class="form-control" id="amount" name="amount" min="100" max="10000" placeholder="Enter amount" required>
				</div>
			</div>
			<br/>
			<center><button type="submit" class="btn btn-primary " name="submit">Proceed</button></center>
		</form> 
		</br>
	</body>
</html>
