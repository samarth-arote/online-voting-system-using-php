<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "userdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $adminname = $_POST["adminname"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE adminname = ? AND password = ?");
    $stmt->bind_param("ss", $adminname, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["adminname"] = $adminname;
        header("Location: Awelcome.php");
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>
