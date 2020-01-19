<html lang="en">
	<head>
		<title>Registration</title>
	</head>
	
	<body>
		<form action = "register" method = "POST">
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token()?>"/>
			<h2>Registration</h2>
			<table>
				<tr>
					<td>First Name: </td>
					<td><input type = "text" name = "firstname" /></td>
				</tr>
				
				<tr>
					<td>Last Name: </td>
					<td><input type = "text" name = "lastname" /></td>
				</tr>
				
				<tr>
					<td>Username: </td>
					<td><input type = "text" name = "username" /></td>
				</tr>
				
				<tr>
					<td>Password: </td>
					<td><input type = "password" name = "password" /></td>
				</tr>
				
				<tr>
					<td>Email: </td>
					<td><input type = "text" name = "email" /></td>
				</tr>
				
				<tr>
					<td>Phone: </td>
					<td><input type = "text" name = "phone" /></td>
				</tr>
				
				<tr>
					<td>Role: </td>
					<td><input type = "text" name = "role" /></td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Register" />
					</td>
				</tr>
			</table>
		</form>
		<a href="login">Click here for the Login Page.</a>
	</body>
</html>