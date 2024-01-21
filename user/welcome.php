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

if (!isset($_SESSION['username'])) {
    echo "Error: 'username' not set in the session.";
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM admin";
$result = mysqli_query($conn, $sql);
echo "<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
}

header {
    background-color: #333;
    color: white;
    padding: 1em;
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

nav li {
    display: inline;
    margin-right: 10px;
}

form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #333;
    color: white;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

header {
    background-color: #333;
    color: white;
    padding: 1em;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 1.5em;
    font-weight: bold;
}

nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

nav li {
    margin-right: 20px;
}

nav a {
    text-decoration: none;
    color: white;
    font-weight: bold;
    font-size: 1.2em;
    transition: color 0.3s ease;
}

nav a:hover {
    color: #ffc107; /* Change the color on hover */
}


    </style>";
    echo "
        <header>
        <div class='logo'>Welcome $username!</div>
        <nav>
            <ul>
                <li><a href='/samarth/home.html'>Home</a></li>
                <li><a href='#'>About</a></li>
                <li><a href='#'>Contact</a></li>
                <li><a href='logout.php'>Logout</a></li>
            </ul>
        </nav>
    </header>
    ";

echo "<table border='1'>";
echo "<tr><th>Admin Name</th><th>Votes</th><th>Vote</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["adminname"] . "</td>";
    echo "<td>" . $row["votes"] . "</td>";

    $check_voted = "SELECT * FROM users WHERE username = '$username' AND voted = 1";
    $resultCheckVoted = $conn->query($check_voted);

    if ($resultCheckVoted->num_rows > 0) {
        echo "<td>You have already voted.</td>";
    } else {
        echo "<td><form method='post' action='vote.php'>";
        echo "<input type='hidden' name='admin_id' value='" . $row["id"] . "'>";
        echo "<button type='submit'>Vote</button>";
        echo "</form></td>";
    }

    echo "</tr>";
}

echo "</table>";

$conn->close();
?>
