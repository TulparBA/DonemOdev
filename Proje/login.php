<?php
    session_start();
    include "db_conn.php";

    if(isset($_POST['uname']) && isset($_POST['password'])) {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return data;   
        }
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if(empty($uname)) {
        header("Location: index.php?error=User Name is Required");
        exit();
    }
    else if(empty($pass)) {
        header("Location: index.php?error=Şifre Bekleniyor");
        exit();
    }

    $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if($row['user_name'] === $uname && $row['password'] === $pass) {
            echo "Başarıyla Giriş Yapıldı!";
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            header("Location: home.php");
            exit();
        }
        else {
            header("Location: index.php?error=Yanlış kullanıcı adı veya şifre");
            exit(); 
        }
    }
    else {
        header("Location: index.php");
        exit();
    }

    
	/*session_start();
	
	// Connect to the database
	$servername = "localhost";
	$username = "user_name";
	$password = "password";
	$dbname = "users";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	// Check if the user has submitted the form
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Get the username and password from the form
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		// Validate the input
		$username = mysqli_real_escape_string($conn, $username);
		$password = mysqli_real_escape_string($conn, $password);
		$password = md5($password); // Hash the password

		// Check if the username and password are correct
		$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) == 1) {
			// Start a session and redirect to the home page
			$_SESSION['username'] = $username;
			header("Location: home.php");
			exit();
		} else {
			// If the username or password is incorrect, show an error message
			$error_msg = "Invalid username or password";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h2>Login</h2>
	<form action="login.php" method="post">
		<label>Username:</label><br>
		<input type="text" name="username" required><br>
		<label>Password:</label><br>
		<input type="password" name="password" required><br><br>
		<input type="submit" value="Login">
	</form>
	
	<?php if(isset($error_msg)) { ?>
		<p><?php echo $error_msg; ?></p>
	<?php } ?>
</body>
</html>*/
?>