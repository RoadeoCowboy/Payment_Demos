<!DOCTYPE html>
<html>
<title>PayPal Marketplaces</title>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<h3>Submerchant Onboarding Form</h3>
			<form method="POST" action="onboard.php" id="onboard-form">
				<div class="form-group">
    				<label for="email">Email address:</label>
    				<input type="email" class="form-control" id="email" required placeholder="your_email@test.com">
  				</div>
  				<div class="form-group">
    				<label for="name">Name:</label>
    				<input type="text" class="form-control" id="name" required placeholder="David Chen">
  				</div>
          <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" class="form-control" id="phone" required pattern="\d{3}[\-]\d{3}[\-]\d{4}" placeholder="213-213-1231">
          </div>
          <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" required placeholder="123 Test St.">
          </div>
          <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="address" required placeholder="Test City">
          </div>
          <div class="form-group">
            <label for="state">City:</label>
            <input type="text" class="form-control" id="state" required placeholder="Test State">
          </div>
          <div class="form-group">
            <label for="zipcode">Zipcode:</label>
            <input type="text" class="form-control" id="zipcode" required placeholder="Test ZipCode">
          </div>
          
         
  					<div class="checkbox">
    				<label><input type="checkbox"> Remember me</label>
  				</div>
  					<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
</body>


</html>