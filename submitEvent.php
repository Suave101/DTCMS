<?php
session_start();
$myfile = fopen("scores.json", "r") or die("Unable to open file!");
$jsonFileString = fread($myfile, filesize("scores.json"));
fclose($myfile);
if (isset($_SESSION["authenticated"])) {
    if ($_SESSION["authenticated"] == true) {
        echo "Authenticated User";
    } else {
        header("Location: login.html");
        die();
    }
} else {
    header("Location: login.html");
    die();
}
// $_POST["uname"]
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Page</title>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="loginForm.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body>
<div class="topnav">
        <a href="index.php">Home</a>
        <a href="currentScores.php">Current Scores</a>
        <a href="login.html">Login</a>
        <a href="#about">About</a>
    </div>
</body>
</html>