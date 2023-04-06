<?php
// Connect to the database
$conn = mysqli_connect("localhost", "sanjai", "sanjai19", "myDB");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get lead ID from query parameter
$id = $_GET['id'];


// Fetch lead data from database
$sqlSelect = "SELECT * FROM table1 WHERE id=?";
$stmt = mysqli_prepare($conn, $sqlSelect);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

// Check if lead exists
if (!$row) {
    die("table1 not found");
}

// Close prepared statement
mysqli_stmt_close($stmt);

// Update lead data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $leadName = $_POST['leadName'];
    $contactNumber = $_POST['contactNumber'];
    $address = $_POST['address'];
    $notes = $_POST['notes'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];

    // Update query with parameterized prepared statement
    $sqlUpdate = "UPDATE table1 SET lead_name=?, contact_number=?, address=?, notes=?, dob=?, email=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sqlUpdate);
    mysqli_stmt_bind_param($stmt, "sissssi", $leadName, $contactNumber, $address, $notes, $dob, $email, $id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_close($conn);
        header('Location: index.php'); // Redirect to index.php
        exit;
    } else {
        echo "Error: " . $sqlUpdate . "<br>" . mysqli_error($conn);
    }

    // Close prepared statement
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Lead</title>
</head>
<body>
<h1>Edit Lead</h1>
<form action="edit.php?id=<?php echo $row['id']; ?>" method="post">
    <label for="leadName">Lead Name:</label><br>
    <input type="text" id="leadName" name="leadName" maxlength="25" value="<?php echo $row['lead_name']; ?>"><br><br>
    <label for="contactNumber">Contact Number:</label><br>
    <input type="text" id="contactNumber" name="contactNumber" maxlength="10" value="<?php echo $row['contact_number']; ?>"><br><br>
    <label for="address">Address:</label><br>
    <textarea id="address" name="address" rows="5" cols="30" maxlength="250"><?php echo $row['address']; ?></textarea><br><br>
    <label for="notes">Notes:</label><br>
    <textarea id="notes" name="notes" rows="5" cols="30" maxlength="250"><?php echo $row['notes']; ?></textarea><br><br>
    <label for="dob">Date of Birth:</label><br>
    <input type="date" id="dob" name="dob" value="<?php echo $row['dob']; ?>"><br><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>"><br><br>
    <input type="submit" value="Update">
</form>
</body
