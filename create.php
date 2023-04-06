<?php

$conn = mysqli_connect("localhost", "sanjai", "sanjai19", "myDB");


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$leadName = $_POST['leadName'];
$contactNumber = $_POST['contactNumber'];
$address = $_POST['address'];
$notes = $_POST['notes'];
$dob = $_POST['dob'];
$email = $_POST['email'];

// Insert query with parameterized prepared statement
$sqlInsert = "INSERT INTO table1 (lead_name, contact_number, address, notes, dob, email) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sqlInsert);
mysqli_stmt_bind_param($stmt, "sissss", $leadName, $contactNumber, $address, $notes, $dob, $email);

if (mysqli_stmt_execute($stmt)) {
    mysqli_close($conn);
    header('Location: index.php');
    print "record";
    exit;
} else {
    echo "Error: " . $sqlInsert . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>

