<?php
include '../db.php';

$result = $conn->query("SELECT * FROM complaints");

echo "<header><h1>All Complaints</h1></header>";
echo "<nav>
<a href='../dashboard/admin.php'>Dashboard</a>
<a href='../logout.php'>Logout</a>
</nav><div class='container'>";

echo "<table>
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Description</th>
    <th>Filed By</th>
    <th>Assigned To</th>
    <th>Status</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['title']}</td>
        <td>{$row['description']}</td>
        <td>{$row['username']}</td>
        <td>{$row['assigned_to']}</td>
        <td>{$row['status']}</td>
    </tr>";
}
echo "</table></div>";
?>
<link rel='stylesheet' href='../assets/style.css'>
