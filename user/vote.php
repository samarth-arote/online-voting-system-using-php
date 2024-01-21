<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : null;

if ($username !== null) {
    $sqlCheckVote = "SELECT voted FROM users WHERE username = '$username'";
    $resultCheckVote = $conn->query($sqlCheckVote);

    if ($resultCheckVote === false) {
        die("Error in SQL query: " . $conn->error);
    }

    $rowCheckVote = $resultCheckVote->fetch_assoc();
    $userHasVoted = ($rowCheckVote["voted"] == 1);

    if (!$userHasVoted) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $admin_id = $_POST["admin_id"];

            $sqlUpdateVotes = "UPDATE admin SET votes = votes + 1 WHERE id = $admin_id";
            $conn->query($sqlUpdateVotes);

            $sqlUpdateUser = "UPDATE users SET voted = 1 WHERE username = '$username'";
            $conn->query($sqlUpdateUser);

            echo "Vote submitted successfully.";
        } else {
            echo "Invalid request.";
        }
    } else {
        echo "You have already voted.";
    }
} else {
    echo "You are not logged in.";
}

$conn->close();
?>
