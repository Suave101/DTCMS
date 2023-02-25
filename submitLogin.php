<?php
$myfile = fopen("pswrds.json", "r") or die("Unable to open file!");
$jsonFileString = fread($myfile, filesize("pswrds.json"));
fclose($myfile);
$jsonData = json_decode($jsonFileString, true);
if (array_key_exists($_POST["uname"], $jsonData) and $jsonData[$_POST["uname"]]["pswd"] === $_POST["psw"]) {
    $_SESSION["authenticated"] = true;
    $_SESSION["userData"] = $jsonData[$_POST["uname"]];
    $authenticated = true;
    $userData = $jsonData[$_POST["uname"]];
    session_start();
} else {
    header("Location: login.html");
    die();
}
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
    <h1>Welcome, <?php if ($authenticated) {if ($userData["role"] === 0){echo "Host";}}?> <?php if ($authenticated) {echo $userData["first_name"];}?></h1>
    
    
</body>
</html>