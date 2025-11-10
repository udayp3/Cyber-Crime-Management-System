<?php
include '../db.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id");
    echo "<p class='success'>User deleted successfully.</p>";
}

$result = $conn->query("SELECT * FROM users");

echo "<header><h1>Manage Users</h1></header>";
echo "<nav>
<a href='../dashboard/admin.php'>Dashboard</a>
<a href='../logout.php'>Logout</a>
</nav><div class='container'>";

echo "<table>
<tr><th>ID</th><th>Username</th><th>Role</th><th>Action</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['username']}</td>
        <td>{$row['role']}</td>
        <td><a href='manage_users.php?delete={$row['id']}'>Delete</a></td>
    </tr>";
}
echo "</table></div>";
?>
<link rel='stylesheet' href='../assets/style.css'>
