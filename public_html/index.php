<html>
	<head>	
	<title> Account Registration </title>
	<style>
	h1 {
		font-size: 50px; 
		text-align: center;
	}
	h2 {
		text-align: center;
	}
	table {
		margin: 0 auto;
	}
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	</style>
	</head>
	<body>
	<img src= " C:\Users\Rae\Pictures\Red Rock Logo.jpg" style= "float:left;"/>
		<h1> Account Registration </h1>
		<h2> Customer Information </h2>
		<form action="Customer_Registration.php" method="post">
		<table>
			<tr> 
				<td> Username </td>
				<td> <input type="text" name="username" required> </td>
			</tr>	
			<tr>
				<td> Password: </td>
				<td> <input type="password" name="password" minlength="8" required> </td>
			</tr>
			<tr>
				<td> Password Confirm: </td>
				<td> <input type="password" name="passwordconfirm" minlength="8" required> </td>
			</tr>
			<tr>
				<td> Reseller Name: </td>
				<td> <input type="text" name="resellername" required>  </td>
			</tr>
			<tr>
				<td> Reseller Billing Address 1: </td>
				<td> <input type="text" name="resellerba1" required> </td>
			</tr>
			<tr>
				<td> Reseller Billing Address 2: </td>
				<td> <input type="text" name="resellerba2"> </td>
			</tr>
			<tr>
				<td> City: </td>
				<td> <input type="text" name="city" required> </td>
			</tr>
			<tr>
				<td> State: </td>
				<td> <select name="state" required>
						<option value= "Alabama">AL</option>
						<option value= "Alaska">AK</option>
						<option value= "Arizona">AZ</option>
						<option value= "Arkansas">AR</option>
						<option value= "California">CA</option>
						<option value= "Colorado">CO</option>
						<option value= "Connecticut">CT</option>
						<option value= "Delaware">AL</option>
						<option value= "District of Columbia">DC</option>
						<option value= "Florida">FL</option>
						<option value= "Georgia">GA</option>
						<option value= "Hawaii">HI</option>
						<option value= "Idaho">ID</option>
						<option value= "Illinois">IL</option>
						<option value= "Indiana">IN</option>
						<option value= "Iowa">IA</option>
						<option value= "Kansas">KS</option>
						<option value= "Kentucky">KY</option>
						<option value= "Louisiana">LA</option>
						<option value= "Maine">ME</option>
						<option value= "Maryland">MD</option>
						<option value= "Massachusetts">MA</option>
						<option value= "Michigan">MI</option>
						<option value= "Minnesota">MN</option>
						<option value= "Mississippi">MS</option>
						<option value= "Missouri">MO</option>
						<option value= "Montana">MT</option>
						<option value= "Nebraska">NE</option>
						<option value= "Nevada">NV</option>
						<option value= "New Hampshire">NH</option>
						<option value= "New Jersey">NJ</option>
						<option value= "New Mexico">NM</option>
						<option value= "New York">NY</option>
						<option value= "North Carolina">NC</option>
						<option value= "North Dakota">ND</option>
						<option value= "Ohio">OH</option>
						<option value= "Oklahoma">OK</option>
						<option value= "Oregon">OR</option>
						<option value= "Pennsylvania">PA</option>
						<option value= "Rhode Island">RI</option>
						<option value= "South Carolina">SC</option>
						<option value= "South Dakota">SD</option>
						<option value= "Tennessee">TN</option>
						<option value= "Texas">TX</option>
						<option value= "Utah">UT</option>
						<option value= "Vermont">VT</option>
						<option value= "Virginia">VA</option>
						<option value= "Washington">WA</option>
						<option value= "West Virginia">WV</option>
						<option value= "Wisconsin">WI</option>
						<option value= "Wyoming">WY</option>
				</select> </td>
			</tr>
			<tr> 
				<td> Zip Code: </td>
				<td> <input type="text" name="zipcode" required> </td>
			</tr>	
			<tr> 
				<td> Telephone Number: </td>
				<td> <input type="text" name="telephonenumber" required> </td>
			</tr>
			<tr>
				<td> Email Address: </td>
				<td> <input type="text" name= "emailaddress" required>  </td>
			</tr>
			<tr> 
				<td> Service Provider Code: </td>
				<td> <input type="text" name= "spcode"> </td>
			</tr>
		</table>
		<input type="submit" value="Submit">
		</form>
	</body>
</html>
