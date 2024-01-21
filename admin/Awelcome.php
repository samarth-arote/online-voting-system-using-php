
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$adminIdToDisplay = 1; 
$sqlRightSide = "SELECT adminname, votes FROM admin WHERE id = $adminIdToDisplay";
$resultRightSide = $conn->query($sqlRightSide);

if ($resultRightSide->num_rows > 0) {
    $rowRightSide = $resultRightSide->fetch_assoc();
    $adminName = $rowRightSide["adminname"];
    $adminVotes = $rowRightSide["votes"];
} else {
    $adminName = "No Admin";
    $adminVotes = 0;
}

$sqlLeftSide = "SELECT adminname, votes FROM admin WHERE id != $adminIdToDisplay";
$resultLeftSide = $conn->query($sqlLeftSide);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Details</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    display: flex;
    justify-content: space-around;
    padding: 20px;
}

.left-side, .right-side {
    width: 45%;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 10px;
}

h1, h2, h4, p {
    margin: 0;
}

h1 {
    color: #333;
}

.left-side h2, .right-side h2 {
    color: #555;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

.left-side h4 {
    color: #008000;
}

.left-side p, .right-side p {
    margin-bottom: 10px;
}

.right-side p {
    color: #555;
}

.right-side p:last-child {
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .left-side, .right-side {
        width: 100%;
    }
}

header {
    background-color: #333333;
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
    color: #ffc107; 
}
    </style>
</head>
<body>
<header>
<div class='logo'></div>

        <nav>
            <ul>
                <li><a href="/samarth/home.html">Home</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">About</a></li>
                <li><a href="Alogout.php">Logout</a></li>
                
            </ul>
        </nav>
    </header>
  <h1>Hello <?php echo $adminName; ?>! Welcome To Admin Page</h1>
<div class="left-side">
        <h2>Admin Details</h2>
        <p>Admin Name: <?php echo $adminName; ?></p>
        <p>Votes: <?php echo $adminVotes; ?></p>
        <h4>Your Registration is done. now your details is display on voter page, !! All The Best !!</h4>
    </div>
    <div class="right-side">
        <h2>Other Admins</h2>
        <?php
        if ($resultLeftSide->num_rows > 0) {
            while ($rowLeftSide = $resultLeftSide->fetch_assoc()) {
                echo "<p>{$rowLeftSide['adminname']} - Votes: {$rowLeftSide['votes']}</p>";
            }
        } else {
            echo "<p>No other admins found.</p>";
        }
        ?>
    </div>

   
</body>
</html>

<?php
$conn->close();
?>