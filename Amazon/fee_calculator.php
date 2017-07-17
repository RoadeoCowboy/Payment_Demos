<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Sample Fee Calculator</title> 
</head>

<style>
	p {display: inline;}
</style>

<body>
	<form id="checkout" method="post">
		Transaction Amount:
		<input type="text" name="amount" value ="0">
		<select name="region">
			<option value="domestic">Domestic</option>
			<option value="international">International</option>
		</select>
		<input type="submit" value="Submit">
	</form>

	<?php

		if(isset($_POST['amount']) && isset($_POST['region'])){
			$amt = $_POST['amount'];
			$selectOption = $_POST['region'];
			$totAmt = "";
			$domRate = 0.029;
			$intlRate = 0.039;
			$fixRate = 0.30;

			error_log("amount is: " . $amt);
			error_log("selectOption is: " . $selectOption);

			if($selectOption == "domestic"){
				$totAmt = $amt * $domRate + $fixRate;
			}
			else{
				$totAmt = $amt *$intlRate + $fixRate;
			}
			error_log("totAmt is: " . $totAmt);
		}
	?>

	Total Transaction Fee: <p id="message"></p>

	<script type="text/javascript">
		var totalAmt = "<?php echo $totAmt ?>";
		document.getElementById("message").innerHTML = totalAmt;
	</script>	
	
</body>


</html>