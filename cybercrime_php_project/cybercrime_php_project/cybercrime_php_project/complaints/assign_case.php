<?php
include '../db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cid = $_POST['complaint_id'];
    $oid = $_POST['officer_id'];
    $sql = "UPDATE complaints SET assigned_to='$oid', status='Assigned' WHERE id=$cid";
    if ($conn->query($sql)) echo "Assigned";
    else echo "Error: " . $conn->error;
}
?>
<form method="POST">
    Complaint ID: <input type="number" name="complaint_id"><br>
    Officer Username: <input type="text" name="officer_id"><br>
    <input type="submit" value="Assign">
</form>