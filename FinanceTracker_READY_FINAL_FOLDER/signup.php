<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Signup</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
<h2>Create Account</h2>
<form method="post">
<input name="name" placeholder="Name" required>
<input name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="signup">Signup</button>
</form>
</div>
<?php
if(isset($_POST['signup'])){
$name=$_POST['name'];
$email=$_POST['email'];
$pass=password_hash($_POST['password'],PASSWORD_DEFAULT);
$conn->query("INSERT INTO users(name,email,password) VALUES('$name','$email','$pass')");
echo "<p>Registered Successfully</p>";
}
?>
</body></html>
