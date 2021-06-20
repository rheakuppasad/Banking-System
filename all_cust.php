<?php
    include_once 'database.php';
    session_start();
?>

<!--html-->

<!DOCTYPE html>
	
	<head>
		<style>
			body
			{
				background-image: url('https://www.ocbc.com/iwov-resources/sg/ocbc/personal/img/live/money2india-fund-transfer/masthead_money2indiafundtransfer.png');
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-size: cover;
			}
			td 
			{
				text-align: center;
			}
			thead
			{
				text-align: center;
			}
		</style>
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>		
		
		<title>All Customers</title>
	</head>
	<body>
		<center>
			<br/>
			<h1 style=font-size:60px>Abc Bank</h1>
			<br/>
			<hr/>
			<br/>
			<h3>Customer Details</h3>
			<br/>
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">Customer ID</th>
						<th scope="col">Name</th>
						<th scope="col">E-mail ID</th>
						<th scope="col">Current Balance</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>

	  
<!--html-->

			<?php
				$query = "SELECT * FROM customer";
				$result = mysqli_query($con, $query) or die('Error');
				while($row = mysqli_fetch_array($result)) 
				{
					$cust_id = $row['cust_id'];
					$cust_name = $row['cust_name'];
					$email_id = $row['email_id'];
					$cur_bal = $row['cur_bal'];
					
					echo '<tr>
							<td>'.$cust_id.'</td>
							<td>'.$cust_name.'</td>
							<td>'.$email_id.'</td>
							<td>'.$cur_bal.'</td>
							<td><button type="button" class="btn btn-light"><a href="cust.php?cust_id='.$cust_id.'">View Customer</a></button></td>
							</tr>';
				}
			?>
		
<!--html-->

				</tbody>
			</table>
		</center>
	</body>
</html>