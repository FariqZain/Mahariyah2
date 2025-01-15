<?php
// simpan_data.php
$jumlah_pushup = $_POST['jumlah_pushup'];

// Simpan data ke database
$servername = "localhost";
$username = "eprw3676_pc";
$password = "5i(*76u(wAu9";
$dbname = "eprw3676_pc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO pushup (jumlah_pushup) VALUES ('$jumlah_pushup')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
