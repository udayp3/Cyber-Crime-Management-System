<?php
session_start();
echo "<header><h1>Admin Dashboard</h1></header>";
echo "<nav>
<a href='../admin/manage_users.php'>Manage Users</a>
<a href='../admin/view_all_complaints.php'>View All Complaints</a>
<a href='../complaints/assign_case.php'>Assign Complaints</a>
<a href='../logout.php'>Logout</a>
</nav>
<div class='container'><p>Welcome Admin!</p></div>";
?>
<link rel='stylesheet' href='../assets/style.css'>
