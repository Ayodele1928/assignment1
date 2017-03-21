<?php
 $db = mysqli_connect("localhost", "root", "@@yodele", "o_banking") or die(mysqli_error());

?>
<!DOCTYPE html>

<html>
<head>
	<title> Admin </title>
</head>
<body>
<h3> Add Users </h3>
<?php
	if (array_key_exists('login', $_POST)){
		$error = array();

		if (empty($_POST['admin_name'])){ //if Username column is empty
		$error[] = "Enter a new admin name";
		} else{
			$admin_name = mysqli_real_escape_string($db, $_POST['admin_name']);
		}

		if (empty($_POST['password'])) { //if password column is empty
			$error[] = "Enter admin password";
		} else{
			$pword = md5(mysqli_real_escape_string($db, $_POST['password']));
		}
		
		if(empty($error)){
			$insert = mysqli_query($db, "INSERT INTO admin

									VALUES(NULL, 
											'".$admin_name."',
											'".$pword."'
											)") or die(mysqli_error($db));
											
											

			$success = "Admin successfully created";
		header("Location:admin_register.php?success=$success");
		}
		else{
			foreach ($error as $error) {
				echo '<p><strong>'.$error.'</strong></p>';
			}

		}
	}

if(isset($_GET['success'])){
	echo '<p><em>'.$_GET['success'].'</em></p>';
}
?>
 	<form action="" method="post">
 		<legend>
 			<fieldset>
 			<legend> Add Admin </legend>
 				<p> Admin Name: <input type="text" name="admin_name"/></p>
 				<p> Password: <input type="password" name="password"/></p>
 				<input type="submit" name="login" value="Add Admin" /></p>
 			
 			</fieldset>
 		</legend>
 	</form>
 	

</body>
</html>