<?php
session_start();
include 'config.php';

if(isset($_GET['delete_budget'])){
$id = $_GET['delete_budget'];
$conn->query("DELETE FROM budgets WHERE id='$id'");
header("Location: dashboard.php");
exit();
}
if(!isset($_SESSION['user'])) header("Location: login.php");
$user=$_SESSION['user'];
$idRes=$conn->query("SELECT id FROM users WHERE email='$user'");
$uid=$idRes->fetch_assoc()['id'];

if(isset($_POST['expense'])){
$conn->query("INSERT INTO expenses(user_id,amount,category,date,description)
VALUES('$uid','".$_POST['amount']."','".$_POST['category']."','".$_POST['date']."','".$_POST['desc']."')");
}

if(isset($_POST['income'])){
$conn->query("INSERT INTO income(user_id,source,amount,frequency)
VALUES('$uid','".$_POST['source']."','".$_POST['amount']."','".$_POST['frequency']."')");
}

if(isset($_POST['budget'])){
$conn->query("INSERT INTO budgets(user_id,category,monthly_limit)
VALUES('$uid','".$_POST['category']."','".$_POST['limit']."')");
}
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title><link rel="stylesheet" href="style.css"></head>
<body>
<h1>Finance Dashboard</h1>

<div class="flex">
<form method="post">
<h3>Add Expense</h3>
<input name="amount" placeholder="Amount">
<input name="category" placeholder="Category">
<input type="date" name="date">
<input name="desc" placeholder="Description">
<button name="expense">Add</button>
</form>

<form method="post">
<h3>Add Income</h3>
<input name="source" placeholder="Source">
<input name="amount" placeholder="Amount">
<select name="frequency">
<option>Monthly</option>
<option>Weekly</option>
<option>One-Time</option>
</select>
<button name="income">Add</button>
</form>

<form method="post">
<h3>Set Budget</h3>
<input name="category" placeholder="Category">
<input name="limit" placeholder="Monthly Limit">
<button name="budget">Set</button>
</form>
</div>

<h2>Budget Status</h2>


<?php
$res=$conn->query("SELECT * FROM budgets WHERE user_id='$uid'");
while($row=$res->fetch_assoc()){
$cat=$row['category'];
$limit=$row['monthly_limit'];
$spent=$conn->query("SELECT SUM(amount) AS total FROM expenses WHERE category='$cat' AND user_id='$uid'")->fetch_assoc()['total'];
$spent=$spent ?: 0;
$percent=min(100,($spent/$limit)*100);
echo "<p>$cat: ₹$spent / ₹$limit
<a href='dashboard.php?delete_budget=".$row['id']."' 
style='color:red;margin-left:10px;'>❌ Delete</a>
</p>
<div class='progress'>
<div class='bar' style='width:$percent%'></div>
</div>";
}
?>

<br>
<a href="history.php">Transaction History</a> |
<a href="logout.php">Logout</a>
</body></html>
