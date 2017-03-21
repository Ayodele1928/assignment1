<?php
 $db = mysqli_connect("localhost", "root", "@@yodele", "o_banking") or die(mysqli_error());

?>
<!DOCTYPE html>
<html>
<head>
	<title> Admin Login</title>
	<meta charset="utf-8">
</head>
<body>

 	<?php
 		if(array_key_exists('login', $_POST)){ //for login authentication
 			$error = array();

 			if(empty($_POST['admin_name'])){ //If user name is empty
 				$error[] = "Please enter your Username";
 			} else {
 				$uname = (mysqli_real_escape_string($db, $_POST['admin_name']));
 			}

 			if(empty($_POST['password'])){ // if password is empty
 				$error[] = "Please enter your Password";
 			} else {
 				$pword = md5(mysqli_real_escape_string($db, $_POST['password']));
 			}

 			if (empty($error)) { //IF NO ERRORS on login
 				$query = mysqli_query($db, "SELECT * FROM admin WHERE
											admin_name = '".$uname."' AND
 											password = '".$pword."'")
											or die(mysqli_error($db));
				
				
				
				if(mysqli_num_rows($query) == 1){ //if record returned = 1
					while ($admin_detail = mysqli_fetch_array($query)) {
						//establish session for user
						$_SESSION['id'] = $admin_detail['admin_id'];
						$_SESSION['admin_name'] = $admin_detail['admin_name'];
						header("Location:admin_home.php"); //Log user in (Access Granted)
					}
				} else { //If record returned is not = 1
					$login_error = "Invalid Username and/or Password";
					header("Location: admin_login.php?login_error=$login_error");
				}
				
				} 	else{
 					foreach ($error as $error) {

 					echo '<p>'.$error.'</p>';
 				}
 			}
 		}


 		if(isset($_GET['login_error'])){
 		echo $_GET['login_error'];
 		}

 	?>
 	<h3> Welcome Admin </h3>
 	<form action="" method="post">
 		<legend>
 			<fieldset>
 			<legend> Login </legend>
 				<p> Username: <input type="text" name="admin_name"/></p>
 				<p> Password: <input type="password" name="password"/></p>
 				<input type="submit" name="login" value="Login" /></p>
 			
 			</fieldset>
 		</legend>
 	</form>
 	



</body>
</html>