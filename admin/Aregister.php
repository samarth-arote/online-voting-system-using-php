<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $adminname = $_POST["adminname"];
    $password = $_POST["password"];
    $p_no = $_POST["p_no"];
    $addr = $_POST["addr"];

    $sql = "INSERT INTO admin (adminname, password, p_no, addr) VALUES ('$adminname', '$password', '$p_no', '$addr')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful. Click on 'Login' button to go on login page <a href='Alogin.html'>Login here</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
