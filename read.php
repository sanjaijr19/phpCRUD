<?php

$conn = mysqli_connect("localhost", "sanjai", "sanjai19", "myDB");


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select all
$sqlSelect = "SELECT * FROM table1";
$result = mysqli_query($conn, $sqlSelect);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['lead_name'] . "</td>";
        echo "<td>" . $row['contact_number'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['notes'] . "</td>";
        echo "<td>" . $row['dob'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
        echo "</tr>";
    }

} else {
    echo "<tr><td colspan='8'>No leads found</td></tr>";
}



mysqli_close($conn);
?>
