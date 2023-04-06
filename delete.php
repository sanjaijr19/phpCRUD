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


if (!$row) {
    die("not found");
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
    $sqlUpdate = "DELETE from table1 WHERE id=$id";
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
<h1>Are you want to delete?</h1>
<form action="delete.php?id=<?php echo $row['id']; ?>" method="post">

    <input type="submit" value="delete">
    <a href="index.php"> cancel </a>
</form>
</body
