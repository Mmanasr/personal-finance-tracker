<?php include 'config.php'; session_start(); ?>
<!DOCTYPE html>
<html>
<head><title>Login</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
<h2>Login</h2>
<form method="post">
<input name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>
<p>Don't have an account? 
<a href="signup.php">Sign Up</a>
</p>
</div>
</div>


<?php
if(isset($_POST['login'])){
$email=$_POST['email'];
$pass=$_POST['password'];
$res=$conn->query("SELECT * FROM users WHERE email='$email'");
if($res->num_rows>0){
$row=$res->fetch_assoc();
if(password_verify($pass,$row['password'])){
$_SESSION['user']=$email;
header("Location: dashboard.php");
}
else echo "Wrong Password";
}else echo "User Not Found";
}
?>
</body></html>
