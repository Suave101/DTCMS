<?php
session_start();
$myfile = fopen("scores.json", "r") or die("Unable to open file!");
$jsonFileString = fread($myfile, filesize("scores.json"));
fclose($myfile);
if (isset($_SESSION["authenticated"]) and isset($_SESSION["userData"])) {
    if ($_SESSION["authenticated"] == true and $_SESSION["userData"]["role"] < 2) {
        $authenticated = true;
    } else {
        header("Location: login.php");
        die();
    }
} else {
    header("Location: login.php");
    die();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Page</title>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="form.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body>
    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="currentScores.php">Current Scores</a>
        <a href="login.php"><?php if (isset($_SESSION["authenticated"]) and $_SESSION["authenticated"] === true) {echo "Account Menu";} else {echo "Login";}?></a>
        <a href="#about">About</a>
    </div>
    <?php
    if ($authenticated) {echo "hello";}?>
</body>
</html>