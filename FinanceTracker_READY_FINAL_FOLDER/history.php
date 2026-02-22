<?php
session_start();
include 'config.php';
if(isset($_GET['delete_exp'])){
$id = $_GET['delete_exp'];
$conn->query("DELETE FROM expenses WHERE id='$id'");
header("Location: history.php");
}

if(isset($_GET['delete_inc'])){
$id = $_GET['delete_inc'];
$conn->query("DELETE FROM income WHERE id='$id'");
header("Location: history.php");
}

$user=$_SESSION['user'];
$idRes=$conn->query("SELECT id FROM users WHERE email='$user'");
$uid=$idRes->fetch_assoc()['id'];
?>
<!DOCTYPE html>
<html>
<head><title>History</title><link rel="stylesheet" href="style.css"></head>
<body>

<h2>Transaction History</h2>
<input id="search" placeholder="Search..." onkeyup="filter()">

<h3>Expenses</h3>
<table border="1" cellpadding="8" cellspacing="0" style="margin:auto;">
<tr>
<th>Amount</th>
<th>Category</th>
<th>Date</th>
<th>Delete</th>
</tr>

<?php
$res=$conn->query("SELECT * FROM expenses WHERE user_id='$uid' ORDER BY date DESC");
while($row=$res->fetch_assoc()){
echo "<tr>
<td>".$row['amount']."</td>
<td>".$row['category']."</td>
<td>".$row['date']."</td>
<td>
<a href='history.php?delete_exp=".$row['id']."'
onclick=\"return confirm('Delete this expense?')\">
 Delete
</a>
</td></tr>";
}
?>
</table>

<h3>Income</h3>
<table border="1" cellpadding="8" cellspacing="0" style="margin:auto;">
<tr>
<th>Amount</th>
<th>Source</th>
<th>Frequency</th>
<th>Delete</th>
</tr>

<?php
$res=$conn->query("SELECT * FROM income WHERE user_id='$uid' ORDER BY id DESC");
while($row=$res->fetch_assoc()){
echo "<tr>
<td>".$row['amount']."</td>
<td>".$row['source']."</td>
<td>".$row['frequency']."</td>
<td>
<a href='history.php?delete_inc=".$row['id']."'
onclick=\"return confirm('Delete this income?')\">
 Delete
</a>
</td>
</tr>";
}
?>
</table>

<script>
function filter(){
let s=document.getElementById("search").value.toLowerCase();

document.querySelectorAll("table tr").forEach((row, index)=>{
if(index===0) return; // header row skip

let text=row.innerText.toLowerCase();
row.style.display=text.includes(s) ? "" : "none";
});
}
</script>

</body></html>
